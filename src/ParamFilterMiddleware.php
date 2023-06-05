<?php

namespace ParamFilter;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ParamFilterMiddleware
{
    private $exceptUrls = [
    // add urls that you don't want to delete the query params
    ];

    public function handle(Request $request, Closure $next)
    {
        $url = $request->fullUrl();

        if ($this->shouldCheckQueryParams($request) && $this->hasQueryParams($request)) {
            return $this->removeQueryParamsAndRedirect($url);
        }

        return $next($request);
    }

    private function shouldCheckQueryParams(Request $request)
    {
        $url = $request->url();

        foreach ($this->exceptUrls as $exemptUrl) {
            if ($url === $exemptUrl) {
                return false;
            }
        }
        return true;

    }

    private function hasQueryParams(Request $request)
    {
        return count($request->query()) > 0;
    }

    private function removeQueryParamsAndRedirect($url)
    {
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['query'])) {
            $urlWithoutQuery = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] .':'.$parsedUrl['port']. $parsedUrl['path'];
            return Redirect::to($urlWithoutQuery);
        }

        return Redirect::to($url);
    }
}
