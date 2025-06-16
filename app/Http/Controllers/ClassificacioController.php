<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equip;
use App\Models\Partit;

class ClassificacioController extends Controller
{
    public function index()
    {
        return view('classificacio.index');
    }
}

