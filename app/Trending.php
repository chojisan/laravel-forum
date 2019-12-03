<?php

namespace App;

use Illuminate\Support\Facades\Redis;

class Trending
{
    public function get()
    {
        // get trending top 5
        //$trending =  collect(Redis::zrevrange('trending_threads', 0, 4))->map(function ($thread) {
        //    return json_decode($thread);
        //});

        return [];

        //return array_map('json_decode', Redis::zrevrange($this->cacheKey(), 0, 4));
    }

    public function push($thread)
    {
        Redis::zincrby($this->cacheKey(), 1, json_encode([
            'title' => $thread->title,
            'path' => $thread->path()
        ]));
    }

    public function reset()
    {
        Redis::del($this->cacheKey());
    }

    public function cacheKey()
    {
        return app()->environment('testing') ? 'testing_trending_threads' : 'trending_threads';
    }
}
