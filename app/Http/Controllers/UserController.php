<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\TweetResource;



class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return ['data'=>$user];
    }

    public function tweets($id)
    {
        $user = User::findOrFail($id);

        // Get the 10 latest tweets of the user
        $tweets = $user->tweets()->latest()->take(10)->get();

        // Return the tweets using the TweetResource
        return TweetResource::collection($tweets);
    }
}

