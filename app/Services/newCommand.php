<?php

namespace App\Services;

use App\Models\Command;
use Illuminate\Http\Request;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;

class newCommand
{

    public function registerCommand(Request $request)
    {
        $items = $request->items;
        $total_price = 0;
        foreach ($items as $item) {
            $item_service_price =  Price::where([
                'service_id' => $request->service,
                'laundry_id' => $item
            ])
                ->get('price');
            $collection_first = $item_service_price->first();
            if (!$collection_first == null) {
                $total_price += $collection_first->price;
            }
        }
        $command = new Command();
        $command->items = json_encode($items);
        $command->service_id = $request->service;
        $command->by = Auth::user()->id;
        $command->total_price = $total_price;
        $command->save();
    }
}
