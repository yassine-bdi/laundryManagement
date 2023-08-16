<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function Home()
    {  
        $items = DB::table('laundries')->select(['id','name'])->get(); 
        $services = DB::table('services')->select(['id','name'])->get(); 
        return view('home',['items' => $items, 'services' => $services]);
    }
}
