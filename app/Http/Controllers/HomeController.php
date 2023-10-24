<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $search = request('search');

        if($search){
            $usuarios = User::where('name', 'ilike' , "%$search%" )->get();
        }else{
            $usuarios = collect();
        }
    
        return view('user.timeline', ['search' => $search, 'usuarios' => $usuarios]);
    }
}
