<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\TweetResource;
use App\Http\Requests\UpdateUserRequest;




class UserController extends Controller
{
    public function show(User $user)
{
    return new UserResource($user);
}

    public function tweets(User $user)
    {
        // Get the 10 latest tweets of the user
        $tweets = $user->tweets()->latest()->take(10)->get();

        // Return the tweets using the TweetResource
        return TweetResource::collection($tweets);
    }

    public function me(Request $request)
    {
        return new UserResource($request->user());
    }

    public function updateMe(UpdateUserRequest  $request)
    {
        $user = $request->user();
        
        $user->name = $request->name;   
        $user->email = $request->email;
        
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        
        $user->save();
        
        return new UserResource($user);
    }
}

