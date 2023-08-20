<?php

namespace App\Http\Controllers;

use App\Events\newCommand as EventsNewCommand;
use App\Models\Command;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\registerCommand;

class CommandController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'Language']);
    }

    public function commands()
    {
        return view('commands.index');
    }

    public function addCommand(Request $request)
    {
        $newCommand = new registerCommand($request); 
        $command = $newCommand->registerCommand(); 
        EventsNewCommand::dispatch($command); 
        return back()->with('statut','command added succesfully'); 

    }
}
