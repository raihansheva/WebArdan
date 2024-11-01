<?php

namespace App\Http\View\Composers;

use App\Models\Contact;
use App\Models\SocialMedia;
use Illuminate\View\View;
use App\Models\AppLink; // Ganti dengan model yang sesuai

class FooterComposer
{
    public function compose(View $view)
    {
        // Ambil data dari model
        $appLinks = AppLink::all();
        $contact = Contact::first();
        $sosmed = SocialMedia::all();
        
        // Kirim data ke view
        $view->with([
            'applink' => $appLinks, // Ganti dengan nama variable di view
            'contact' => $contact,
            'sosmed' => $sosmed
        ]);
    }
}