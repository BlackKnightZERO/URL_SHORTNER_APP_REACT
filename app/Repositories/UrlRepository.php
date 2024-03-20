<?php

namespace App\Repositories;
use App\Models\Url;

class UrlRepository implements UrlRepositoryInterface {

    public function all() {
        return URL::WHERE('user_id', auth()->user()->id)->latest()->get();
    }

    public function create(object $data) {
        $long_url = $data->long_url;
        if (substr($long_url, -1) === '/') {
            $long_url = rtrim($long_url, '/');
        }
        return URL::firstOrCreate(
            ['long_url' => $long_url],
            ['short_url' => $this->generateShortURL(), 'visit_count' => 1, 'user_id' => auth()->user()->id ],
        );
    }

    public function find($data) {
        return URL::where('short_url', $data)->firstOrFail();
    }

    public function update(array $data, $id) {
        $url = URL::findOrFail($id);
        $url->update($data);
        return $url;
    }

    public function generateShortURL() {
        
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