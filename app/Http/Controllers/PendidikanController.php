<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    public function index()
    {
        $pendidikan = Pendidikan::latest()->get();

        return view('admin.pendidikan.index', compact('pendidikan'));
    }
}
