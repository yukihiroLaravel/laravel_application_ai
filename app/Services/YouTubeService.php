<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class YouTubeService
{
    // YouTube Data API から動画のタイトルを取得する（取れなければ null）
    public function getTitle(string $youtubeId): ?string
    {
        $key = config('services.youtube.key');
        if (! $key) {
            return null;
        }

        // 同じ動画は1日キャッシュして、APIの使用回数を節約する
        return Cache::remember("youtube_title_{$youtubeId}", now()->addDay(), function () use ($youtubeId, $key) {
            $response = Http::get('https://www.googleapis.com/youtube/v3/videos', [
                'id' => $youtubeId,
                'key' => $key,
                'part' => 'snippet',
            ]);

            if ($response->failed()) {
                return null;
            }

            return $response->json('items.0.snippet.title');
        });
    }
}
