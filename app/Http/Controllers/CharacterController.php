<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Character as CharacterResource;

class CharacterController extends Controller
{
    /**
     * Get the user's active character
     *
     * @param Illuminate\Http\Request
     * @return void
     */
    public function get_active_character(Request $request)
    {
        $character = Auth::guard('api')->user()->active_character();

        return response(new CharacterResource($character), 200);
    }

    /**
     * Get all the user's characters
     *
     * @param Illuminate\Http\Request
     * @return void
     */
    public function get_all_characters(Request $request)
    {
        $characters = Auth::guard('api')->user()->characters;

        return response(new CharacterResource($characters), 200);
    }
}
