<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Http\Resources\TweetResource;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::with('user')
            ->orderBy('created_at', 'desc')
            ->take(100)
            ->get();

        return TweetResource::collection($tweets);
    }
}

