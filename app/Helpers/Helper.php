<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use DateTime;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Cocur\Slugify\Slugify;
use App\Models\Order;
use App\Models\News;
use App\Models\Category;
use App\Models\Campaignable;
use App\Models\Book;
use App\Models\Author;
use App\Http\Controllers\Admin\AdminController;

class Helper
{
    public static function convertTimeForStoreInDB($time)
    {
        return date('Y-m-d H:i:s', strtotime($time));
    }

    public static function strSlug(string $str): string
    {
        $slugify = new Slugify([
            'rulesets' => ['default', 'bulgarian'],
            'separator' => '-',
            'lowercase' => true,
            'trim' => true,
            #'regexp' => '/[^A-Za-z0-9-]+/',
            #'lowercase_after_regexp' => true,
            'strip_tags' => true,
            'decode' => true,
        ]);
        return $slugify->slugify($str);
    }

    public static function getNewsCategoriesNames(News $news, bool $showLabel = true)
    {
        $categories = [];
        foreach ($news->categories as $category) {
            $categories[] = "<a href='" . route('category.show', ['slug' => $category->slug]) . "'>" . $category->i18n->name . "</a>";
        }

        return implode(' ', $categories);
    }

    public static function getNewsAuthorsNames(News $news, bool $withAuthorTag = false)
    {
        $authors = [];
        foreach ($news->authors as $author) {
            #$authors[] = "<a href='#'>" . $author->i18n->fullname . "</a>";
            if ($withAuthorTag) {
                $authors[] = "<a href='#'>" . $author->i18n->fullname . "</a>";
            } else {
                $authors[] = $author->i18n->fullname;
            }
        }

        return implode(' ', $authors);
    }

    public static function generateUrlDynamic(string $key, string $newValue)
    {
        $url = url()->current();
        $queryParams = request()->query();

        if (isset($queryParams[$key])) {
            $existingValues = explode(',', $queryParams[$key]);
            if (($index = array_search($newValue, $existingValues)) !== false) {
                unset($existingValues[$index]);
            } else {
                $existingValues[] = $newValue;
            }

            $newValue = implode(',', $existingValues);
        }

        $queryParams[$key] = $newValue;

        $queryString = http_build_query($queryParams);
        $queryString = urldecode($queryString);

        $url = $url . '?' . $queryString;

        return $url;
    }

    public static function getLogo($logo, $dir, $size)
    {
        if (!$logo) {
            return asset(AdminController::NO_IMAGE);
        }

        $path = $dir . $size . $logo;

        if (!file_exists(public_path($path))) {
            return asset(AdminController::NO_IMAGE);
        }

        return url($path);
    }

    public static function formatDateForHuman(string $datetime)
    {
        $months = [
            'January' => 'Януари',
            'February' => 'Февруари',
            'March' => 'Март',
            'April' => 'Април',
            'May' => 'Май',
            'June' => 'Юни',
            'July' => 'Юли',
            'August' => 'Август',
            'September' => 'Септември',
            'October' => 'Октомври',
            'November' => 'Ноември',
            'December' => 'Декември',
        ];

        $dateTime = new DateTime($datetime);
        $now = new DateTime();
        $interval = $now->diff($dateTime);

        // Проверка дали разликата е по-малка от 12 часа
        if ($interval->days == 0 && $interval->h < 12) {
            if ($interval->h > 0) {
                return $interval->h . ' ' . ($interval->h == 1 ? 'час' : 'часа');
            } elseif ($interval->i > 0) {
                return $interval->i . ' ' . ($interval->i == 1 ? 'минута' : 'минути');
            } else {
                return '1 минута';
            }
        }

        $formattedDate = $dateTime->format('F d, Y');
        $month = $dateTime->format('F');

        if (isset($months[$month])) {
            $formattedDate = str_replace($month, $months[$month], $formattedDate);
        }

        return $formattedDate;
    }

    /* ADMIN */
    public static function getNewsAuthorsNamesAdmin(News $news)
    {
        $authors = [];
        foreach ($news->authors as $author) {
            $authors[] = $author->i18n->fullname;
        }

        return implode(' ', $authors);
    }

    public static function latinToCyrillic($text)
    {
        $transliterationTable = [
            'a' => 'а', 'b' => 'б', 'v' => 'в', 'g' => 'г', 'd' => 'д', 'e' => 'е',
            'z' => 'з', 'i' => 'и', 'j' => 'й', 'k' => 'к', 'l' => 'л', 'm' => 'м',
            'n' => 'н', 'o' => 'о', 'p' => 'п', 'r' => 'р', 's' => 'с', 't' => 'т',
            'u' => 'у', 'f' => 'ф', 'h' => 'х', 'c' => 'ц', 'ch' => 'ч', 'sh' => 'ш',
            'sht' => 'щ', 'y' => 'ъ', 'yu' => 'ю', 'ya' => 'я',
            'A' => 'А', 'B' => 'Б', 'V' => 'В', 'G' => 'Г', 'D' => 'Д', 'E' => 'Е',
            'Z' => 'З', 'I' => 'И', 'J' => 'Й', 'K' => 'К', 'L' => 'Л', 'M' => 'М',
            'N' => 'Н', 'O' => 'О', 'P' => 'П', 'R' => 'Р', 'S' => 'С', 'T' => 'Т',
            'U' => 'У', 'F' => 'Ф', 'H' => 'Х', 'C' => 'Ц', 'CH' => 'Ч', 'SH' => 'Ш',
            'SHT' => 'Щ', 'Y' => 'Ъ', 'YU' => 'Ю', 'YA' => 'Я',
        ];

        return strtr($text, $transliterationTable);
    }
}
