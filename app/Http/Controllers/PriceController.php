<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceRequest;
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

    public function addPrice(PriceRequest $request)
    {
        $validatedData = $request->validated();
        if (!Price::where([
            ['laundry_id', $validatedData['laundry_id']],
            ['service_id', $validatedData['service_id']],
        ])->exists()) {
            Price::create($validatedData);
            return to_route('prices')->with('statut', 'price added with success');
        } else {
            return to_route('prices')->with('error', 'price already exists!');
        }
    }


    public function editPrice(PriceRequest $request, int $id)
    {
        $validatedData = $request->validated();
        if (Price::where('id', $id)->exists()) {
            $price = Price::find($id);
            $price->price = $validatedData['price'];
            $price->laundry_id = $validatedData['laundry'];
            $price->service_id = $validatedData['service'];
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
