<?php

namespace App\Http\Controllers;

use App\Contracts\Video\VideoHosting;

//use Illuminate\Http\Request;



class TestController extends Controller
{
    public function index(VideoHosting $videoService)
    {
        return view('test', ['videoService' => $videoService]);
    }
}
