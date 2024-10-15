<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use DB;

class AdminMoveController extends Controller
{
    public function index()
    {
        die;
        $this->truncateTables();

        $rows = DB::connection('old')->select("select * from wp_posts where post_type = 'post' and post_parent = 0 and post_title LIKE 'Община%' and post_status = 'publish' order by id desc");
        if ($rows) {
            foreach ($rows as $row) {
                $slug = Helper::strSlug($row->post_title);

                $id = DB::table('municipalities')->insertGetId([
                    'id' => $row->ID,
                    'slug' => $slug,
                    'contact_email' => $this->getEmail($row->post_content),
                    'website' => $this->getWebsite($row->post_content),
                    "logo" => $this->getLogo($row->post_content),
                    "contact_phone_one" => $this->getPhone($row->post_content),
                    'active' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

                DB::table('municipalities_i18n')->insert([
                    'municipality_id' => $id,
                    'language_id' => 1,
                    'name' => $row->post_title,
                    'description' => $row->post_content,
                    'address' => $this->getAddress($row->post_content),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }

    private function truncateTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('landmarks_gallery')->truncate();
        DB::table('landmarks_i18n')->truncate();
        DB::table('landmarks')->truncate();
        DB::table('municipalities_i18n')->truncate();
        DB::table('municipalities')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
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
