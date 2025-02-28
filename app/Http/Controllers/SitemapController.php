<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function generateSitemap()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('https://ardanradio.com'))
            ->add(Url::create('https://ardanradio.com/home'))
            ->add(Url::create('https://ardanradio.com/ardan-youtube'))
            ->add(Url::create('https://ardanradio.com/chart'))
            ->add(Url::create('https://ardanradio.com/info-news'))
            ->add(Url::create('https://ardanradio.com/info-detail'))
            ->add(Url::create('https://ardanradio.com/info-kategori'))
            ->add(Url::create('https://ardanradio.com/event'))
            ->add(Url::create('https://ardanradio.com/detail-event'))
            ->add(Url::create('https://ardanradio.com/podcast'))
            ->add(Url::create('https://ardanradio.com/detail-podcast'))
            ->add(Url::create('https://ardanradio.com/detail-info-artis'))
            ->add(Url::create('https://ardanradio.com/detail-program'));

        $sitemap->writeToDisk('public', 'sitemap.xml');

        return response()->json(['message' => 'Sitemap berhasil dibuat!']);
    }
}
