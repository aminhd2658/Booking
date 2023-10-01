<?php

namespace App\Http\Controllers;

use App\Models\Stay;

class IndexController
{
    public function index()
    {
        $stays = Stay::isActive()->take(8)->get();
        return view('index', compact('stays'))->with([
            'pageTitle' => 'Find your next stay',
            'pageDescription' => 'Search low prices on hotels, homes and much more...'
        ]);
    }
}
