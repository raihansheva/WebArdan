<?php

namespace App\Http\Controllers;

use App\Models\TagInfo;
use Carbon\Carbon;
use App\Models\Info;
use App\Models\Artis;
use App\Models\Event;
use App\Models\Banner;
use App\Models\Podcast;
use App\Models\Program;
use App\Models\Youtube;
use App\Models\Kategori;
use App\Models\Schedule;
use App\Models\Announcer;
use App\Models\Streaming;
use App\Models\BannerInfo;
use Illuminate\Http\Request;
use App\Models\BannerPodcast;
use App\Models\BannerYoutube;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = Banner::all();

        $streamAudio = Streaming::where('type_url', 'Audio')->first();
        $streamVideo = Streaming::where('type_url', 'Video')->first();

        $program = Program::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->get();

        $event_soon = Event::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('status', 'soon')->get();
        $event_upcoming = Event::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('status', 'upcoming')
            ->limit(2)
            ->get();

        $kategoriInfo = TagInfo::with('info')->get();
        $Info = Info::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->get();
        $topInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('top_news', true) // Kondisi ini harus selalu true
            ->limit(5)
            ->get();

        $TrendingInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('trending', true) // Pastikan trending juga difilter
            ->get();


        $announcer = Announcer::all();

        $podcast = Podcast::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->take(4)->get();
        $Kategori = Kategori::with('charts')->get();

        $schedule = Schedule::with('program')->get();

        $artis = Artis::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_sekarang', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_sekarang', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->limit(3)->get();
        // dd($kategoriInfo);
        // foreach ($artis as $berita) {
        //     // Tentukan status publish langsung berdasarkan kondisi
        //     if ($berita->publish_sekarang) {
        //         $berita->publish_status = 'Publish Sekarang';
        //     } elseif ($berita->tanggal_publikasi && $berita->tanggal_publikasi >= now()) {
        //         $berita->publish_status = 'Jadwal Publish: ' . $berita->tanggal_publikasi->format('d M Y, H:i');
        //     } else {
        //         $berita->publish_status = 'Diterbitkan';
        //     }
        // }

        $playlist = Youtube::first();
        $apiKey = env('YOUTUBE_API_KEY');
        $playlistId = $playlist->link_youtube;
        // dd($topInfo);
        // Panggil YouTube API untuk mendapatkan video dari playlist
        $response = Http::get('https://www.googleapis.com/youtube/v3/playlistItems', [
            'part' => 'snippet',
            'maxResults' => 3,
            'playlistId' => $playlistId,
            'key' => $apiKey,
        ]);

        // $fmt = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        // $test = $fmt->format(123456.789);
        // dd($test);

        //  Buat ngcek kalo ada error
        // if ($response->successful()) {
        //     $videos = $response->json();
        //     dd($videos); // Tampilkan semua data yang diterima
        // } else {
        //     dd($response->json()); // Tampilkan error jika ada
        // }
        // --------------------------


        $videos = $response->json()['items'];

        // Kirim semua data ke view
        return view('page.home', [
            'banner' => $banner,
            'streamAudio' => $streamAudio,
            'streamVideo' => $streamVideo,
            'program' => $program,
            'event_soon' => $event_soon,
            'event_upcoming' => $event_upcoming,
            'info' => $Info,
            'kategoriInfo' => $kategoriInfo,
            'top_info' => $topInfo,
            'trending_info' => $TrendingInfo,
            'podcast' => $podcast,
            'videos' => $videos,
            'announcer' => $announcer,
            'kategori' => $Kategori,
            'schedule' => $schedule,
            'artis' => $artis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function detailprogram($slug)
    {
        // $info = Info::where('slug', $slug)->first();
        $kategoriInfo = TagInfo::where('is_visible', true)->with('info')->get();
        // dd($info->tag_info);
        $program = Program::where('slug', $slug)->first();
        $programO = Program::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })
            ->where('slug', '!=', $slug) // Filter program dengan slug yang tidak sama
            ->limit(4) // Batasi hasil hanya 4
            ->get();
        $topInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('top_news', true) // Kondisi ini harus selalu true
            ->limit(5)
            ->get();

        $TrendingInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('trending', true) // Pastikan trending juga difilter
            ->get();

        // $event = Event::where('slug', $slug)->first();
        $event_upcoming = Event::where('status', 'upcoming')->limit(2)->get();
        $artis = Artis::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_sekarang', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_sekarang', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->get();
        $bannerI = BannerInfo::all();
        $streamAudio = Streaming::where('type_url', 'Audio')->first();
        // dd($info);

        return view('page.detailProgram', [
            'bannerInfo' => $bannerI,
            'program' => $program,
            'programO' => $programO,
            'kategoriInfo' => $kategoriInfo,
            'trending_info' => $TrendingInfo,
            'top_info' => $topInfo,
            'event_upcoming' => $event_upcoming,
            'artis' => $artis,
            'streamAudio' => $streamAudio
        ]);
    }

    public function event()
    {

        $program = Program::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->limit(4)->get();
        $streamAudio = Streaming::where('type_url', 'Audio')->first();
        $event_soon = Event::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('status', 'soon')->get();
        $event_upcoming = Event::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('status', 'upcoming')
            ->limit(2)
            ->get();

        return view('page.event', [
            'program' => $program,
            'streamAudio' => $streamAudio,
            'event_soon' => $event_soon,
            'event_upcoming' => $event_upcoming,
        ]);
    }

    public function detailEvent($slug)
    {
        // $info = Info::where('slug', $slug)->first();
        $kategoriInfo = TagInfo::where('is_visible', true)->with('info')->get();
        // dd($info->tag_info);
        $topInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('top_news', true) // Kondisi ini harus selalu true
            ->limit(5)
            ->get();

        $TrendingInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('trending', true) // Pastikan trending juga difilter
            ->get();

        $event = Event::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('slug', $slug)->first();
        $event_upcoming = Event::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('slug', '!=', $slug)->limit(2)->get();
        $artis = Artis::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_sekarang', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_sekarang', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->get();
        $bannerI = BannerInfo::all();
        $streamAudio = Streaming::where('type_url', 'Audio')->first();

        // dd($info);

        return view('page.detailEvent', [
            'bannerInfo' => $bannerI,
            'event' => $event,
            'kategoriInfo' => $kategoriInfo,
            'trending_info' => $TrendingInfo,
            'top_info' => $topInfo,
            'event_upcoming' => $event_upcoming,
            'artis' => $artis,
            'streamAudio' => $streamAudio
        ]);
    }


    public function podcast()
    {
        $bannerP = BannerPodcast::all();
        $podcast = Podcast::all();
        $playlist = Youtube::first();
        $topInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('top_news', true) // Kondisi ini harus selalu true
            ->limit(5)
            ->get();
        $apiKey = env('YOUTUBE_API_KEY');
        $playlistId = $playlist->link_youtube;
        $streamAudio = Streaming::where('type_url', 'Audio')->first();

        // Panggil YouTube API untuk mendapatkan video dari playlist
        $response = Http::get('https://www.googleapis.com/youtube/v3/playlistItems', [
            'part' => 'snippet',
            'maxResults' => 3,
            'playlistId' => $playlistId,
            'key' => $apiKey,
        ]);


        //  Buat ngcek kalo ada error
        // if ($response->successful()) {
        //     $videos = $response->json();
        //     dd($videos); // Tampilkan semua data yang diterima
        // } else {
        //     dd($response->json()); // Tampilkan error jika ada
        // }
        // --------------------------


        $videos = $response->json()['items'];

        return view('page.podcast', [
            'bannerP' => $bannerP,
            'podcast' => $podcast,
            'videos' => $videos,
            'topInfo' => $topInfo,
            'streamAudio' => $streamAudio
        ]);
    }

    public function detailpodcast($slug)
    {
        // Cari podcast berdasarkan slug
        $detailpodcast = Podcast::where('slug', $slug)->firstOrFail();

        $idPodcast = $detailpodcast->id;

        $epsgroup = Podcast::where('podcast_id', $idPodcast)->skip(1)->take(10)->get();

        $allpodcast = Podcast::all();

        $topInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('top_news', true) // Kondisi ini harus selalu true
            ->limit(5)
            ->get();

        $streamAudio = Streaming::where('type_url', 'Audio')->first();
        // dd($epsgroup);
        $playlist = Youtube::first();

        $apiKey = env('YOUTUBE_API_KEY');
        $playlistId = $playlist->link_youtube;

        // Panggil YouTube API untuk mendapatkan video dari playlist
        $response = Http::get('https://www.googleapis.com/youtube/v3/playlistItems', [
            'part' => 'snippet',
            'maxResults' => 5,
            'playlistId' => $playlistId,
            'key' => $apiKey,
        ]);


        //  Buat ngcek kalo ada error
        // if ($response->successful()) {
        //     $videos = $response->json();
        //     dd($videos); // Tampilkan semua data yang diterima
        // } else {
        //     dd($response->json()); // Tampilkan error jika ada
        // }
        // --------------------------

        $videos = $response->json()['items'];

        // Tampilkan halaman detail dengan data podcast
        return view('page.detailPodcast', [
            'detail_podcast' => $detailpodcast,
            'eps_group' => $epsgroup,
            'all_podcast' => $allpodcast,
            'top_info' => $topInfo,
            'videos' => $videos,
            'streamAudio' => $streamAudio,
        ]);
    }


    public function chart()
    {
        $Kategori = Kategori::with('charts')->get();

        $topInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('top_news', true) // Kondisi ini harus selalu true
            ->limit(5)
            ->get();

        $streamAudio = Streaming::where('type_url', 'Audio')->first();

        return view('page.chart', [
            'kategori' => $Kategori,
            'top_info' => $topInfo,
            'streamAudio' => $streamAudio,
        ]);
    }


    public function info()
    {
        $info = Info::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->get();
        $taginfo = TagInfo::where('is_visible', true)->with('info')->get();
        $topInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('top_news', true) // Kondisi ini harus selalu true
            ->limit(5)
            ->get();

        $event_upcoming = Event::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('status', 'upcoming')
            ->limit(2)
            ->get();
        $artis = Artis::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_sekarang', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_sekarang', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->get();

        // dd($artis);
        $bannerI = BannerInfo::all();
        $streamAudio = Streaming::where('type_url', 'Audio')->first();
        // $time = Carbon::now('UTC')->toDateString();
        // dd($time);
        return view('page.infoNews', [
            'bannerInfo' => $bannerI,
            'info' => $info,
            'taginfo' => $taginfo,
            'top_info' => $topInfo,
            'event_upcoming' => $event_upcoming,
            'artis' => $artis,
            'streamAudio' => $streamAudio
        ]);
    }

    public function artis()
    {
        $info = Info::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->get();
        $taginfo = TagInfo::where('is_visible', true)->with('info')->get();
        $topInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('top_news', true) // Kondisi ini harus selalu true
            ->limit(5)
            ->get();

        $event_upcoming = Event::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('status', 'upcoming')
            ->limit(2)
            ->get();
        $artis = Artis::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_sekarang', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_sekarang', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->get();
        $bannerI = BannerInfo::all();
        $streamAudio = Streaming::where('type_url', 'Audio')->first();
        // $time = Carbon::now('UTC')->toDateString();
        // dd($time);
        return view('page.infoArtis', [
            'bannerInfo' => $bannerI,
            'info' => $info,
            'taginfo' => $taginfo,
            'top_info' => $topInfo,
            'event_upcoming' => $event_upcoming,
            'artis' => $artis,
            'streamAudio' => $streamAudio
        ]);
    }

    public function tagInfo($tag)
    {
        $info = Info::whereHas('tagInfo', function ($query) use ($tag) {
            $query->where('nama_kategori', $tag)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                }); // Filter berdasarkan nama_tag di tabel tag_infos
        })->Where('publish_now', true)
            ->with('tagInfo')->get();
        $taginfo = TagInfo::where('is_visible', true)->with('info')->get();
        $topInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('top_news', true) // Kondisi ini harus selalu true
            ->limit(5)
            ->get();

        $event_upcoming = Event::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('status', 'upcoming')
            ->limit(2)
            ->get();
        $artis = Artis::all();
        $bannerI = BannerInfo::all();
        $streamAudio = Streaming::where('type_url', 'Audio')->first();

        // dd($info);

        return view('page.detailTaginfo', [
            'bannerInfo' => $bannerI,
            'info' => $info,
            'taginfo' => $taginfo,
            'top_info' => $topInfo,
            'event_upcoming' => $event_upcoming,
            'artis' => $artis,
            'streamAudio' => $streamAudio
        ]);
    }

    public function detailInfo($slug)
    {
        $info = Info::where('slug', $slug)->first();
        $kategoriInfo = TagInfo::where('is_visible', true)->with('info')->get();
        // dd($info->tag_info);
        $topInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('top_news', true) // Kondisi ini harus selalu true
            ->limit(5)
            ->get();

        $TrendingInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('trending', true) // Pastikan trending juga difilter
            ->get();

        $event_upcoming = Event::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('status', 'upcoming')
            ->limit(2)
            ->get();
        $artis = Artis::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_sekarang', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_sekarang', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->get();
        $bannerI = BannerInfo::all();
        $streamAudio = Streaming::where('type_url', 'Audio')->first();

        // dd($info);

        return view('page.detailInfo', [
            'bannerInfo' => $bannerI,
            'info' => $info,
            'kategoriInfo' => $kategoriInfo,
            'trending_info' => $TrendingInfo,
            'top_info' => $topInfo,
            'event_upcoming' => $event_upcoming,
            'artis' => $artis,
            'streamAudio' => $streamAudio
        ]);
    }


    public function youtube()
    {
        $youtube = Youtube::all();
        $event_soon = Event::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('status', 'soon')->get();
        $event_upcoming = Event::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('status', 'upcoming')
            ->limit(2)
            ->get();
        $topInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('top_news', true) // Kondisi ini harus selalu true
            ->limit(5)
            ->get();

        $bannerYT = BannerYoutube::first();
        $streamAudio = Streaming::where('type_url', 'Audio')->first();

        return view('page.youtube', [
            'bannerYT' => $bannerYT,
            'youtube' => $youtube,
            'event_soon' => $event_soon,
            'event_upcoming' => $event_upcoming,
            'top_info' => $topInfo,
            'streamAudio' => $streamAudio
        ]);
    }


    public function detailInfoArtis($slug)
    {
        // $info = Info::where('slug', $slug)->first();
        $kategoriInfo = TagInfo::where('is_visible', true)->with('info')->get();
        // dd($info->tag_info);
        $topInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('top_news', true) // Kondisi ini harus selalu true
            ->limit(5)
            ->get();

        $TrendingInfo = Info::where(function ($query) {
            $query->where('publish_now', true)
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('trending', true) // Pastikan trending juga difilter
            ->get();

        $event_upcoming = Event::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_now', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_now', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->where('status', 'upcoming')
            ->limit(2)
            ->get();
        $artis = Artis::where('slug', $slug)->first();
        $artisO = Artis::where(function ($query) {
            // Tampilkan jika publish_sekarang true
            $query->where('publish_sekarang', true)
                // Atau jika publish_sekarang false dan tanggal_publikasi <= sekarang
                ->orWhere(function ($query) {
                    $query->where('publish_sekarang', false)
                        ->where('tanggal_publikasi', '<=', now());
                });
        })->get();
        $bannerI = BannerInfo::all();
        $streamAudio = Streaming::where('type_url', 'Audio')->first();

        // dd($info);

        return view('page.detailInfoArtis', [
            'bannerInfo' => $bannerI,
            // 'info' => $info,
            'kategoriInfo' => $kategoriInfo,
            'trending_info' => $TrendingInfo,
            'top_info' => $topInfo,
            'event_upcoming' => $event_upcoming,
            'artis' => $artis,
            'artisO' => $artisO,
            'streamAudio' => $streamAudio
        ]);
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
