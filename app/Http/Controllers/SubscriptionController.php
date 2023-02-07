<?php

namespace App\Http\Controllers;

use Request;
use App\Models\{
    Website
};
use Illuminate\Http\Response;

class SubscriptionController extends Controller
{
    public function store(Website $website)
    {
        $attributes = Request::validate([
            'user_id' => ['exists:users,id']
        ]);

        $website->subscribers()->attach(
            $attributes['user_id']
        );

        return response()->json([
            'message' => "Subscribed to {$website->name}"
        ], 200);
    }
}
