<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Requests\WorkerRequest;
use Illuminate\Support\Facades\DB;

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


    public function addWorker(WorkerRequest $request)
    {
        $validatedData = $request->validated();
        if (User::where([
            ['name', $validatedData['name']],
            ['email', $validatedData['email']]
        ])->exists()) {
            return back()->with('error', 'this worker already exists!');
        } else {
            DB::transaction(function () use ($request, $validatedData) {
                $userID = DB::table('users')->insertGetId([
                    'name' => strip_tags($validatedData['name']),
                    'email' => strip_tags($validatedData['email']),
                    'role' => 'worker',
                    'password' => Hash::make($request['password'])
                ]);
                DB::table('workers')->insert([
                    'user_id' => $userID,
                    'salary' => $validatedData['salary'],
                    'joindate' => $validatedData['joindate'],
                    'age' => $validatedData['age'],
                    'mission' => strip_tags($validatedData['mission']),
                    'worker_id' => rand(1000, 200000),
                ]);
            });
            return to_route('workers')->with('statut', 'Worker added with success');
        }
    }


    public function editWorker(WorkerRequest $request, $id)
    {   

        $validatedData = $request->validated(); 
        if (!Worker::where('id', $id)->exists()) {
            return back()->with('error', 'this worker does not exists!');
        } else {
            $worker = Worker::find($id);
            $user = User::find($worker->user_id);
            $user->name = strip_tags($validatedData['name']);
            $user->email = strip_tags($validatedData['email']);
            $user->role = 'worker';
            $user->password = Hash::make($request->password);
            $user->save();

            $worker->salary = $validatedData['salary'];
            $worker->joindate = $validatedData['joindate'];
            $worker->age = $validatedData['age'];
            $worker->mission = strip_tags($validatedData['mission']);

            $worker->save();
            return to_route('workers')->with('statut', 'Worker updated with success');
        }
    }


    public function deleteWorker(Request $request, $id)
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
