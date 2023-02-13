<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WorkerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'Language']);
    }



    public function workers()
    {
        return view('admin.workers', ['workers' =>
        User::where('role', 'worker')
            ->with('worker')
            ->paginate(5)]);
    }
    
    
    public function addWorker(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|confirmed',
            'mission' => 'required|string|max:255',
            'salary' => 'required|max:8',
            'joindate' => 'required|date',
            'age' => 'required|numeric|max:99'

        ]);
        if (User::where([
            ['name', $request->name],
            ['email', $request->email]
        ])->exists()) {
            return back()->with('error', 'this worker already exists!');
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = 'worker'; 
            $user->password = Hash::make($request->password);
            $user->save();
            $worker = new Worker();
            $worker->user_id = $user->id;
            $worker->salary = $request->salary;
            $worker->joindate = $request->joindate;
            $worker->age = $request->age;
            $worker->mission = $request->mission;
            $worker->worker_id = rand(1000, 200000);
            $worker->save();
            return to_route('workers')->with('statut', 'Worker added with success');
        }
    } 
    
    
    public function editWorker(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',

            'mission' => 'required|string|max:255',
            'salary' => 'required|max:8',
            'joindate' => 'required|date',
            'age' => 'required|numeric|max:99'

        ]);
        if (!Worker::where('id', $id)->exists()) {
            return back()->with('error', 'this worker does not exists!');
        } else {           
            $worker = Worker::find($id); 
            $user = User::find($worker->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = 'worker'; 
            $user->password = Hash::make($request->password);
            $user->save();

            $worker->salary = $request->salary;
            $worker->joindate = $request->joindate;
            $worker->age = $request->age;
            $worker->mission = $request->mission;

            $worker->save();
            return to_route('workers')->with('statut', 'Worker updated with success');
        }
    }


    public function deleteWorker(Request $request,$id) 
    {
        if (!Worker::where('id', $id)->exists()) {
            return back()->with('error', 'this worker does not exists!');
        } else {           
            $worker = Worker::find($id); 
            $user = User::find($worker->user_id);
            $worker->delete(); 
            $user->delete(); 
            return to_route('workers')->with('statut', 'Worker deleted with success');
        }
    }
}
