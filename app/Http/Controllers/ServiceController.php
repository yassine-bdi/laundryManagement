<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service; 

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Language']); 
    }
    
    public function Services() 
    {   
        return view('admin.services',['services' => Service::paginate(5)]); 
    }

    public function addService(Request $request) 
    {
        if(!Service::where('name',$request->name)->exists()) {
            $service = new Service(); 
            $service->name = $request->name; 
            $service->save(); 
            return to_route('services')->with('statut','service created with success'); 
        } else {
            return to_route('services')->with('error','service already exists!');
        }
    }

    public function editService(Request $request,int $id) 
    {
        if(Service::where('id',$id)->exists()) {
            $service = Service::find($id); 
            $service->name = $request->name; 
            $service->save(); 
            return to_route('services')->with('statut','service updated with success'); 
        } else {
            return to_route('services')->with('error','service does not exists!');
        }
    
    }

    public function deleteService(Request $request,int $id)
    {
        if(!Service::where('name',$id)->exists()) {
            $service = Service::find($id);  
            $service->delete(); 
            return to_route('services')->with('statut','service deleted with success'); 
        } else {
            return to_route('services')->with('error','service does not exists!');
        }
    }
    
}
