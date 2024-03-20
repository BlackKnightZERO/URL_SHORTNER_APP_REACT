<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\URL;
use App\Http\Requests\StoreURLRequest;
use Illuminate\Support\Facades\URL as URLL;
use Inertia\Inertia;

use App\Services\UrlService;

class DashboardController extends Controller
{

    public function __construct(protected UrlService $urlService){}

    public function index() {
        return Inertia::render('Dashboard', [
            'base_url'  => URLL::to('/') . '/',
            'short_url' => '',
            'long_url' => '',
            'urls' => $this->urlService->all(),
        ]);
    }

    public function create(StoreURLRequest $request) {
        $url = $this->urlService->create($request);
        return Inertia::render('Dashboard', [
            'base_url'  => URLL::to('/') . '/',
            'short_url' => $url->short_url,
            'long_url' => $url->long_url,
            'urls' => $this->urlService->all(),
        ]);
    }

    public function redirect($url) {
        $__url = $this->urlService->find($url);
        $this->urlService->update(['visit_count' => $__url->visit_count + 1], $__url->id);
        return redirect()->to($__url->long_url);
    }

}
