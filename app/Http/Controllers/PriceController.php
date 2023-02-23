<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use App\Models\Price;
use App\Models\Service;
use Illuminate\Http\Request;

class PriceController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'Language']);
    }

    public function prices()
    {
        return view('admin.prices', [
            'prices' => Price::with(['service', 'laundry'])->paginate(5),
            'services' => Service::all(),
            'laundries' => Laundry::all()
        ]);
    }

    public function addPrice(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
            'laundry' => 'required',
            'service' => 'required'

        ]);

        if (!Price::where([
            ['laundry_id', $request->laundry],
            ['service_id', $request->service],
        ])->exists()) {
            $price = new Price();
            $price->price = $request->price;
            $price->laundry_id = $request->laundry;
            $price->service_id = $request->service;
            $price->save();
            return to_route('prices')->with('statut', 'price added with success');
        } else {
            return to_route('prices')->with('error', 'price already exists!');
        }
    }


    public function editPrice(Request $request, int $id)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
            'laundry' => 'required',
            'service' => 'required'

        ]);

        if (Price::where('id', $id)->exists()) {
            $price = Price::find($id);
            $price->price = $request->price;
            $price->laundry_id = $request->laundry;
            $price->service_id = $request->service;
            $price->save();
            return to_route('prices')->with('statut', 'price edited with success');
        } else {
            return to_route('prices')->with('error', 'price does not exists!');
        }
    }

    public function deletePrice(Request $request, int $id)
    {
        if (Price::where('id', $id)->exists()) {
            $price = Price::find($id);
            $price->delete();
            return to_route('prices')->with('statut', 'price deleted with success');
        } else {
            return to_route('prices')->with('error', 'price does not exists!');
        }
    }
}
