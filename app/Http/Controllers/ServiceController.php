<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'Language']);
    }

    public function Services()
    {
        return view('admin.services', ['services' => Service::paginate(5)]);
    }

    public function addService(ServiceRequest $request)
    {
        $validatedData = $request->validated();

        if (!Service::where('name', $validatedData['name'])->exists()) {
            $service = new Service();
            $service->name = strip_tags($validatedData['name']);
            $service->save();
            return to_route('services')->with('statut', 'service created with success');
        } else {
            return to_route('services')->with('error', 'service already exists!');
        }
    }

    public function editService(ServiceRequest $request, int $id)
    {
        $validatedData = $request->validated();
        if (Service::where('id', $id)->exists()) {
            $service = Service::find($id);
            $service->name = strip_tags($validatedData['name']);
            $service->save();
            return to_route('services')->with('statut', 'service updated with success');
        } else {
            return to_route('services')->with('error', 'service does not exists!');
        }
    }

    public function deleteService(Request $request, int $id)
    {
        if (!Service::where('name', $id)->exists()) {
            $service = Service::find($id);
            $service->delete();
            return to_route('services')->with('statut', 'service deleted with success');
        } else {
            return to_route('services')->with('error', 'service does not exists!');
        }
    }
}
