<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Book;
use App\Http\Traits\FileUploadTrait;

class AdminAjaxController extends AdminController
{
    use FileUploadTrait;

    public function uploadGalleryImage(Request $request)
    {
        dd($request->all());
    }

    public function uploadImageTinymce(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        /***************************************************
         * Only these origins are allowed to upload images *
         ***************************************************/
        $accepted_origins = ["http://localhost", "http://192.168.1.1", "http://127.0.0.1:8000", env('APP_URL')];

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // same-origin requests won't set an origin. If the origin is set, it must be valid.
            if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            } else {
                header("HTTP/1.1 403 Origin Denied");
                return;
            }
        }

        // Don't attempt to process the upload on an OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header("Access-Control-Allow-Methods: POST, OPTIONS");
            return;
        }

        $json = DB::transaction(function () use ($request) {
            return $this->uploadTinymceImage($request->file('file'));
        });

        return json_encode($json);
    }

    public function uploadImageTinymceORIGINAL(Request $request)
    {
        /***************************************************
         * Only these origins are allowed to upload images *
         ***************************************************/
        $accepted_origins = ["http://localhost", "http://192.168.1.1", "http://127.0.0.1:8000", env('APP_URL')];

        /*********************************************
         * Change this line to set the upload folder *
         *********************************************/
        $imageFolder = public_path('uploads/images/');
        $imageLink = '/uploads/images/';

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // same-origin requests won't set an origin. If the origin is set, it must be valid.
            if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            } else {
                header("HTTP/1.1 403 Origin Denied");
                return;
            }
        }

        // Don't attempt to process the upload on an OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header("Access-Control-Allow-Methods: POST, OPTIONS");
            return;
        }

        reset($_FILES);
        $temp = current($_FILES);

        if (is_uploaded_file($temp['tmp_name'])) {
            /*
            If your script needs to receive cookies, set images_upload_credentials : true in
            the configuration and enable the following two headers.
             */
            // header('Access-Control-Allow-Credentials: true');
            // header('P3P: CP="There is no P3P policy."');

            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }

            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }

            // Accept upload if there was no origin, or if it is an accepted origin
            $filetowrite = $imageFolder . $temp['name'];
            $filenametoreturn = $temp['name'];
            // Create folder if it's not exists
            if (file_exists($imageFolder) == false) {
                mkdir($imageFolder, 0777, true);
            }
            // Move uploaded file
            move_uploaded_file($temp['tmp_name'], $filetowrite);

            // Determine the base URL
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https://" : "http://";
            //$baseurl = $protocol . $_SERVER["HTTP_HOST"] . rtrim(dirname($_SERVER['REQUEST_URI']), "/") . "/";
            $imageurl = $protocol . $_SERVER["HTTP_HOST"] . rtrim($imageLink, "/") . "/";

            // Respond to the successful upload with JSON.
            // Use a location key to specify the path to the saved image resource.
            // { location : '/your/uploaded/image/file'}
            //echo json_encode(array('location' => $imageurl . $filetowrite));
            echo json_encode(array('location' => $imageurl . $filenametoreturn));
        } else {
            // Notify editor that the upload failed
            header("HTTP/1.1 500 Server Error");
        }
    }

    public function searchNews(string $word)
    {
        $news = new Collection;
        if ($word) {
            $news = Book::where('active', 1)
                ->where('available', 1)
                ->whereHas('i18n', function ($query) use ($word) {
                    $query->where('title', 'like', '%' . $word . '%');
                })
                ->with(['i18n' => function ($query) {
                    $query->select('title', 'book_id');
                }])
                ->orderBy('id', 'desc')
                ->take(20)
                ->get();
        }

        $html = view('admin.ajax._get_news_ajax')
            ->with('news', $news)
            ->render();

        return Response::json($html);
    }
}
