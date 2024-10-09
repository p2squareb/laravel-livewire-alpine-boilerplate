<?php

namespace App\Http\Middleware;

use App\Models\System;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CacheConfig
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $configNames = [
            'external', 'policy', 'basic', 'point',
        ];

        foreach($configNames as $configName) {
            $this->cacheConfig($configName);
        }

        return $next($request);
    }

    private function cacheConfig($configName): void
    {
        if(!Cache::has("config.$configName")) {
            Cache::forever("config.$configName", $this->getConfig($configName));
        }
    }

    private function getConfig($configName)
    {
        $config = System::query()->where('title', $configName)->orderByDesc('id')->first();
        return json_decode($config->content);
    }
}
