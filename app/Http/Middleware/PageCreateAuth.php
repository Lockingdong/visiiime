<?php

namespace App\Http\Middleware;

use App\Models\VPage;
use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use URL;

class PageCreateAuth
{
    public function handle(Request $request, Closure $next)
    {
        $isPageUrlExists = VPage::where('page_url', $request->page_url)->exists();
        $requestData = Request::create('/' . $request->page_url);
        $response = Route::dispatch($requestData);

        if ($response->getStatusCode() === 200 || $isPageUrlExists) {
            return response()
                ->json(
                    'route existed',
                    500
                );
        }

        if ($response->getStatusCode() !== 404) {
            return response()
                ->json(
                    'route invalid',
                    500
                );
        }

        return $next($request);
    }
}
