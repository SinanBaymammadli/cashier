<?php

namespace App\Http\Controllers;

use App\Log;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('sudo');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = Log::all();

        return view('log.index', ['logs' => $logs]);
    }
}
