<?php

namespace App\Http\Controllers\Admin;

class DashboardController
{
    public function index()
    {
        return view('panel.dashboard');
    }
}
