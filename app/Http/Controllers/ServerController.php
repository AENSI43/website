<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerController extends Controller
{
    /**
     * Show Admin Panel
     */
    public function index()
    {
        return view('admin-panel.index');
    }
}
