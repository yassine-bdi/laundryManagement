<?php

namespace App\Http\Controllers;

use App\Events\newCommand as EventsNewCommand;
use App\Http\Requests\CommandRequest;
use App\Models\Command;
use App\Models\Price;
use App\Services\DeleteCommand;
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
        $commands = Command::paginate(10);
        $items = DB::table('laundries')->select(['id','name'])->get(); 
        $services = DB::table('services')->select(['id','name'])->get(); 
        return view('commands.index', ['commands' => $commands, 'items' => $items, 'services' => $services]);
    }

    public function addCommand(CommandRequest $request)
    {
        $newCommand = new registerCommand($request);
        $command = $newCommand->registerCommand();
        event(new EventsNewCommand($command));
        return back()->with('statut', 'command added successfully');
    }

    public function deleteCommand(int $id) 
    {
        $deletionservice = new DeleteCommand($id); 
        if($deletionservice->deleteCommand()) {
            return back()->with('statut','command deleted successfully'); 
        } else {
            return back()->with('error','command could not be deleted'); 
        }
    }
}
