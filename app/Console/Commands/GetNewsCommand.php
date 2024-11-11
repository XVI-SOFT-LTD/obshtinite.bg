<?php

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;
use voku\helper\HtmlDomParser;

class GetNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-external-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get news from external sites.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->getNewsFromVarna('https://www.chernomore.bg/c/2-varna');
        /*
    //$this->getNewsFromShumen('http://oblastshumen.government.bg/new/category/novini/');
    $this->getNewsFromPleven('http://plevenzapleven.bg/blog/category/1-новини/');
    $this->getNewsFromSofia('https://www.sofia.bg/news');
    $this->getNewsFromPlovdiv('http://www.pd.government.bg/?cat=3');
    $this->geNewsFromVratza('http://vratsa.bg/bg/news/aktualni-novini');
    $this->getNewsFromBurgas('bg/news/index/1/', 'bg');
     */
    }

    private function getNewsFromVarna(string $url)
    {
        $base_url = 'http://www.chernomore.bg';

        $html = HtmlDomParser::file_get_html($url);
        if (!$html) {
            return;
        }

        foreach ($html->findMulti('div.article-listing ul li') as $news) {

            $url = $news->find('.article-title a', 0)->href ?? '';
            $url = trim(urldecode($url));

            $title = $news->find('.article-title a', 0)->plaintext ?? '';

            $description = '';

            $picture = '';
            foreach ($news->find('.article-image img') as $img) {
                if ($img->hasAttribute('data-src')) {
                    $picture = $img->getAttribute('data-src');
                }
            }

            if (!$picture) {
                continue;
            }

            $picture = $base_url . $picture;

            if ($title && $url && $picture) {
                $this->updateOrInsert($url, $title, $description, $picture);
            }
        }
    }

    /*
    private function getNewsFromShumen(string $url)
    {
    $base_url = 'http://oblastshumen.government.bg';

    $html = file_get_contents($url);
    $html = HtmlDomParser::str_get_html($html);
    if ($html) {
    foreach ($html->find('/html/body/div/div[2]/div[2]/section/div[2]/ul[1]/li') as $news) {
    $title = $news->find('h1.subtitle', 0)->plaintext;
    $url = $news->find('a', 0)->href;
    $url = trim(urldecode($url));

    $picture = ($news->find('a img', 0)->src) ?? null;
    $picture = str_replace('-150x150', '', $picture);

    $description = trim($news->find('p', 0)->plaintext);
    $description = str_replace('[...]', '...', $description);
    $description = str_replace('[…]', '...', $description);

    if (!$picture) {
    continue;
    }

    if ($title && $url && $picture && $description) {
    $this->updateOrInsert($url, $title, $description, $picture);
    }
    }
    }
    }

    private function getNewsFromPleven(string $url)
    {
    $base_url = "http://plevenzapleven.bg";

    $html = file_get_contents($url);
    $html = HtmlDomParser::str_get_html($html);
    if ($html) {
    foreach ($html->find('[@id="featured"]/div[3]/ul/li') as $news) {
    $title = $news->find('h2 a', 0)->plaintext;
    $url = $news->find('h2 a', 0)->href;
    $url = trim(urldecode($url));

    $picture = ($news->find('.post-thumb a img', 0)->src) ?? null;
    $picture = str_replace('-100x75', '', $picture);

    $description = trim($news->find('p', 0)->plaintext);

    if (!$picture) {
    continue;
    }

    if ($title && $url && $picture && $description) {
    $this->updateOrInsert($url, $title, $description, $picture);
    }
    }
    }
    }

    private function getNewsFromSofia(string $url)
    {
    $base_url = "https://www.sofia.bg";

    $html = file_get_contents($url);
    $html = HtmlDomParser::str_get_html($html);
    if ($html) {
    foreach ($html->find('.news-wrapper div#hol') as $news) {
    $title = $news->find('div.news-title', 0)->plaintext;
    $url = $news->find('.small-image a', 0)->href;

    $picture = ($news->find('.small-image a img', 0)->src) ?? null;

    $description = trim($news->find('div.desc', 0)->plaintext);

    if (!$picture) {
    continue;
    }

    if ($title && $url && $picture && $description) {
    $this->updateOrInsert($url, $title, $description, $base_url . $picture);
    }
    }
    }
    }

    private function geNewsFromVratza($url)
    {
    $base_url = 'http://vratsa.bg';

    $html = file_get_contents($url);
    $html = HtmlDomParser::str_get_html($html);
    if ($html) {
    foreach ($html->find('//*[@id="yw0"]/div[1]/article') as $row) {
    $title = $row->find('a h4.item_title', 0)->plaintext;
    $url = $row->find('a', 0)->href;
    $picture = $row->find('img.article-image', 0)->src;
    $description = trim($row->find('p.article-text', 0)->plaintext);

    if (!$picture) {
    continue;
    }

    if ($title && $url && $picture && $description) {
    $this->updateOrInsert($base_url . $url, $title, $description, $base_url . $picture);
    }
    }
    }
    }

    private function getNewsFromBurgas($url, $lang = "bg")
    {
    $base_url = "http://bsregion.org/";
    $url = $base_url . $url;

    $html = file_get_contents($url);
    $html = HtmlDomParser::str_get_html($html);
    if ($html) {
    foreach ($html->find('//*[@id="newsList"]/li') as $news) {

    $title = $news->find('h2 a', 0)->plaintext;
    $url = $news->find('h2 a', 0)->href;
    $picture = ($news->find('a img', 0)->src) ?? null;
    $description = trim($news->plaintext);

    if (!$picture) {
    continue;
    }

    if ($title && $url && $picture && $description) {
    //$description = $this->getContentPageViewBurgas($base_url . $url);
    $this->updateOrInsert($base_url . $url, $title, $description, $base_url . $picture);
    }
    }
    }
    }

    private function getNewsFromPlovdiv(string $url)
    {

    $base_url = "http://www.pd.government.bg";

    $html = file_get_contents($url);
    $html = HtmlDomParser::str_get_html($html);
    if ($html) {
    foreach ($html->find('//*[@id="content"]/div article') as $news) {
    $title = $news->find('h2 a', 0)->plaintext;
    $url = $news->find('h2 a', 0)->href;
    $picture = ($news->find('a img', 0)->src) ?? null;
    $description = trim($news->find('.entry-content p', 0)->plaintext);

    if (!$picture) {
    continue;
    }

    if ($title && $url && $picture && $description) {
    $this->updateOrInsert($url, $title, $description, $picture);
    }
    }
    }
    }

    private function getContentPageViewBurgas(string $url)
    {
    $description = null;

    $html = file_get_contents($url);
    $html = HtmlDomParser::str_get_html($html);
    if ($html) {
    $description = $html->find('//*[@id="newsView"]/div', 0)->plaintext;
    }

    return $description;
    }
     */

    private function updateOrInsert(string $url, string $title, string $description, string $picture)
    {
        News::updateOrCreate(
            ['url' => $url],
            [
                'municipality_id' => null,
                'title' => $title,
                'description' => $description,
                'logo' => $picture,
                //'publish_date' => date('Y-m-d H:i:s'),
            ]
        );
    }
}
