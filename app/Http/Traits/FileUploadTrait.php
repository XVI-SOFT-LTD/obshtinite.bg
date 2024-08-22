<?php

namespace App\Http\Traits;

use Throwable;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

trait FileUploadTrait
{
    const MAIN_DIR = 'uploads/';
    const NO_IMAGE = '/theme/img/no-image.png';

    public function uploadImage(UploadedFile $tmpImg, int $id, string $dir, $sizes = [])
    {
        try {
            $dir = $this->makeDirectory($id, $dir);
        } catch (\Throwable $th) {
            throw $th->getMessage();
        }

        $filename = md5(microtime()) . '.' . $tmpImg->getClientOriginalExtension();

        $image = ImageManager::gd()->read($tmpImg->getPathname());

        // copy original
        $originalPath = $dir . 'original_' . $filename;
        $image->save($originalPath);

        // resize images
        if (!empty($sizes)) {
            foreach ($sizes as $size) {
                foreach ($size as $width => $height) {
                    $path = $dir . "{$width}_" . $filename;
                    $image->coverDown($width, $height)->save($path);
                }
            }
        }

        return $filename;
    }

    public function uploadGallery(array $images, int $id, string $dir, $sizes = [])
    {
        if (empty($images)) {
            return [];
        }

        $sortorder = 1;
        foreach ($images as $image) {
            $filename = $this->uploadImage($image, $id, $dir, $sizes);
            if ($filename) {
                DB::table("news_gallery")->insert([
                    'news_id' => $id,
                    'filename' => $filename,
                    'sortorder' => $sortorder,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $sortorder++;
            }
        }
    }

    public function deleteFiles($files): void
    {
        if (empty($files)) {
            return;
        }

        foreach ($files as $file) {
            $this->deleteFile($file);
        }
    }

    public function deleteFile($file): void
    {
        $dir = public_path(self::MAIN_DIR . 'files' . '/' . intval($file->object_id / 1000));
        $filename = $file->filename;

        if (file_exists($dir . '/' . $filename)) {
            unlink($dir . '/' . $filename);
        }

        DB::table("files")->where('id', $file->id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
    }

    public function uploadFiles(array $files, int $objectId, Model $eloquent, string $type): void
    {
        if (empty($files)) {
            return;
        }

        $sortorder = 1;
        foreach ($files as $file) {
            $this->uploadFile($file, $objectId, $eloquent, $type, $sortorder++);
        }
    }

    public function uploadFile(UploadedFile $file, int $id, Model $eloquent, string $type = null, int $sortorder = 0): void
    {
        $dir = 'files';
        try {
            $dir = $this->makeDirectory($id, $dir);
        } catch (\Throwable $th) {
            throw $th->getMessage();
        }

        $originalName = $file->getClientOriginalName();
        $filename = md5(microtime()) . '.' . $file->getClientOriginalExtension();

        if ($file->move($dir, $filename)) {
            DB::table("files")->insert([
                'filename' => $filename,
                'original_filename' => $originalName,
                'object_id' => $id,
                'object_eloquent' => $eloquent::class,
                'object_type' => $type,
                'object_table' => $eloquent->getTable(),
                'sortorder' => $sortorder,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    public function uploadTinymceImage(UploadedFile $tmpImg)
    {
        $originalName = $tmpImg->getClientOriginalName();
        $filename = md5(microtime()) . '.' . $tmpImg->getClientOriginalExtension();

        $id = DB::table('images')->insertGetId([
            'filename' => $filename,
            'original_filename' => $originalName,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        try {
            $dir = $this->makeDirectory($id, Image::DIR);
        } catch (Throwable $th) {
            throw $th->getMessage();
        }

        if ($tmpImg->move($dir, $filename)) {
            return [
                'location' => asset(self::MAIN_DIR . Image::DIR . '/' . intval($id / 1000) . '/' . $filename),
            ];
        }
    }

    protected function makeDirectory(int $id, string $dir)
    {
        $dir = public_path(self::MAIN_DIR . $dir . '/' . intval($id / 1000));

        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        if (strrev($dir) != '/') {
            $dir .= '/';
        }

        return $dir;
    }

}
