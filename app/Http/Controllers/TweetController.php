<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Http\Resources\TweetResource;
use App\Http\Requests\StoreTweetRequest;

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

    public function like(Tweet $tweet)
    {
        // Erhöhe die Likes-Zähler
        $tweet->likes = $tweet->likes + 1;
    
        // Speichere den Tweet
        if ($tweet->save()) {
            // Geben Sie den Tweet als Ressource zurück
            return new TweetResource($tweet);
        } else {
            // Geben Sie einen Fehler zurück
            return response()->json([
                'error' => 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.'
            ], 500);
        }
    }
    public function store(StoreTweetRequest $request)
    {
        $tweet = new Tweet;
        $tweet->text = $request->text;
        $tweet->user_id = $request->user()->id;

        if ($tweet->save()) {
            return new TweetResource($tweet);
        } else {
            return response()->json([
                'error' => 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.'
            ], 500);
        }
    }
    
    

}

