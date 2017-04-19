<?php

namespace App\Http\Controllers;

use App\Client;
use App\Page;
use App\Service;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.layout', ['page' => Page::find(1)]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function layout()
    {
        return view('admin.layout', ['page' => Page::find(1)]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicos()
    {
        return view('admin.servicos', ['services' => Service::all()]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientes()
    {
        return view('admin.clientes', ['clients' => Client::all()]);
    }
}
