<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queries = DB::getQueryLog();

        dd($queries);
    }
}
