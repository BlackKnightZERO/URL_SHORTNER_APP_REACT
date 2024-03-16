<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\URL;
use App\Http\Requests\StoreURLRequest;
use Illuminate\Support\Facades\URL as URLL;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {
        $urls = URL::WHERE('user_id', auth()->user()->id)->latest()->get();
        return Inertia::render('Dashboard', [
            'base_url'  => URLL::to('/') . '/',
            'short_url' => '',
            'long_url' => '',
            'urls' => $urls,
        ]);
    }

    public function create(StoreURLRequest $request) {
        $long_url = $request->long_url;
        if (substr($long_url, -1) === '/') {
            $long_url = rtrim($long_url, '/');
        }
        $url = URL::firstOrCreate(
            ['long_url' => $long_url],
            ['short_url' => $this->generateShortURL(), 'visit_count' => 1, 'user_id' => auth()->user()->id ],
        );
        $urls = URL::WHERE('user_id', auth()->user()->id)->latest()->get();

        return Inertia::render('Dashboard', [
            'base_url'  => URLL::to('/') . '/',
            'short_url' => $url->short_url,
            'long_url' => $url->long_url,
            'urls' => $urls,
        ]);
    }

    public function redirect($url) {
        $__url = URL::where('short_url', $url)->firstOrFail();
        URL::where('short_url', $url)
            ->update(['visit_count' => $__url->visit_count + 1]);

        return redirect()->to($__url->long_url);
    }

    private function generateShortURL() {
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $shortURL = '';
        $length = 6;

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $shortURL .= $characters[$index];
        }

        return $shortURL;
    }
}
