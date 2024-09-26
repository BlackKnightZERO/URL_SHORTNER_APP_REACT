<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\URL;
use App\Http\Requests\StoreURLRequest;
use Illuminate\Support\Facades\URL as URLL;
use Inertia\Inertia;

use App\Services\UrlService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DashboardController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected UrlService $urlService){}

    public function index(Request $request) {
        $data = [
            'base_url'  => URLL::to('/') . '/',
            'short_url' => '',
            'long_url' => '',
            'urls' => $this->urlService->all(),
        ];
        if ($request->is('api/*') && $request->expectsJson()) {
            return $this->successResponse($data, 'Urls retrieved successfully.');
        }
        return Inertia::render('Dashboard', $data);
    }

    public function create(StoreURLRequest $request) {
        $url = $this->urlService->create($request);
        $data = [
            'base_url'  => URLL::to('/') . '/',
            'short_url' => $url->short_url,
            'long_url' => $url->long_url,
            'urls' => $this->urlService->all(),
        ];
        if ($request->is('api/*') && $request->expectsJson()) {
            return $this->successResponse($data, 'Url created successfully.');
        }
        return Inertia::render('Dashboard', $data);
    }

    public function redirect(Request $request, $url){
        try {
            $__url = $this->urlService->find($url);

            $this->urlService->update(['visit_count' => $__url->visit_count + 1], $__url->id);

            if ($request->is('api/*') && $request->expectsJson()) {
                $data = [
                    'long_url' => $__url->long_url
                ];
                return $this->successResponse($data, 'URL retrieved successfully.');
            }

            return redirect()->to($__url->long_url);

        } catch (ModelNotFoundException $e) {
            if ($request->is('api/*') && $request->expectsJson()) {
                return $this->errorResponse('URL not found.', null, 404);
            }
            abort(404, 'URL not found.');
        }
    }

}
