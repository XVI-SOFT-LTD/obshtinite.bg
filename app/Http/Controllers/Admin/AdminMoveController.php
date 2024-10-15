<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;

class AdminMoveController extends Controller
{
    public function index()
    {
        #DB::table('municipalities')->truncate();

        $rows = DB::connection('old')->select("select * from wp_posts where post_type = 'post' and post_parent = 0 and post_title LIKE 'Община%' and post_status = 'publish' order by id desc");
        if ($rows) {
            foreach ($rows as $row) {
                $data = [
                    'id' => $row->ID,
                    "name_bg" => $row->post_title,
                    'description_bg' => $row->post_content,
                    "address_bg" => $this->getAddress($row->post_content),
                    'email' => $this->getEmail($row->post_content),
                    'website' => $this->getWebsite($row->post_content),
                    "logo" => $this->getLogo($row->post_content),
                    "video" => null,
                    'latitude' => null,
                    'longitude' => null,
                    "phone1" => $this->getPhone($row->post_content),
                    #"phone2",
                    #'work_time_bg',
                    #'fb_url',
                    #'google_url',
                    #'type_subscription',
                    #'position_vip',
                    'tags_bg' => null,
                    #'valid_from',
                    #'valid_to',
                    #'homepage',
                    'active' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                dump($data, $row);
                #DB::table('municipalities')->insertGetId($data);
            }
        }
    }

    private function getAddress($description)
    {
        $string = $this->get_string_between($description, 'Home.png" alt="" width="19" />', PHP_EOL);

        return trim($string);
    }

    private function getEmail($description)
    {
        $string = $this->get_string_between($description, 'Mail.png" alt="" width="19" height="19" />', PHP_EOL);
        return trim($string);
    }

    private function getPhone($description)
    {
        $string = $this->get_string_between($description, 'Phone.png" alt="" width="19" height="19" />', PHP_EOL);
        return trim($string);
    }

    private function getWebsite($description)
    {
        $string = $this->get_string_between($description, 'Link.png" alt="" width="19" height="19" />', PHP_EOL);
        return trim(strip_tags($string));
    }

    private function getLogo($description)
    {
        #$string = $this->get_string_between($description, 'src="', '"');
        preg_match_all('/src="([^"]*)"/', $description, $result);

        $string = str_replace("https://obshtinite.bg/wp-content/uploads/", "", $result[1][0]);
        return trim($string);
    }

    public function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) {
            return '';
        }

        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}
