<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use Illuminate\Http\Request;

class LaundryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Language']); 
    }
    
    public function Laundries() 
    {   
        return view('admin.laundries',['laundries' => Laundry::paginate(5)]); 
    }

    public function addLaundries(Request $request) 
    {    
          $request->validate([
            'name' => 'required|string|max:2000',
            'image' => 'image|max:2000'
          ]); 
        if(!Laundry::where('name',$request->name)->exists()) {
           $laundry = new Laundry(); 
           $laundry->name = strip_tags($request->name); 
           if($request->hasFile('image')) {
           $laundry->photo = $request->file('image')->store('laundries','public'); 
           }
           $laundry->save(); 
           return to_route('laundries')->with('statut','laundry added with success'); 
        } else {
            return to_route('laundries')->with('error','laundry already exists!');
        }

    }

    public function editLaundries(Request $request, $id) 
    {
        $request->validate([
            'name' => 'required|string|max:2000',
            'image' => 'image|max:2000'
          ]); 
        if(Laundry::where('id',$id)->exists()) {
           $laundry = Laundry::find($id);  
           $laundry->name = strip_tags($request->name); 
           if($request->hasFile('image')) {
           $laundry->photo = $request->file('image')->store('laundries'); 
    
           }
             $laundry->save();   
           return to_route('laundries')->with('statut','laundry edited with success'); 
        } else {
            return to_route('laundries')->with('error','laundry does not exist!');
        }
    }

    public function deleteLaundry(Request $request,$id) 
    {
        if(Laundry::where('id',$id)->exists()) {
            $laundry = Laundry::find($id);  
            $laundry->delete(); 
            return to_route('laundries')->with('statut','laundry deleted with success'); 
        } else {
            return to_route('laundries')->with('error','laundry does not exist!');
        }
    }
}
