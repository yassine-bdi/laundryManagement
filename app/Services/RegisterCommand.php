<?php

namespace App\Services;

use App\Http\Requests\CommandRequest;
use App\Models\Command;
use Illuminate\Http\Request;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;

class registerCommand
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function registerCommand()
    {
        $items = $this->request['items'];
        $total_price = 0;
        foreach ($items as $item) {
            $item_service_price =  Price::where([
                'service_id' => $this->request['service'],
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
        $command->service_id = $this->request['service'];
        $command->by = Auth::user()->id;
        $command->total_price = $total_price;
        $command->note = strip_tags($this->request['note']);
        $command->client = strip_tags($this->request['client']);
        $command->delivery_address = strip_tags($this->request['delivery_address']);
        $command->save();
        return $command;
    }
}
