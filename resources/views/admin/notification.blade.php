@php
    $user = App\Models\User::find($command->by);
    $service = App\Models\Service::find($command->service_id);
    $items = [];
    foreach (json_decode($command->items) as $item):
        array_push($items, App\Models\Laundry::where('id', $item)->get('name'));
    endforeach;
@endphp
<h4> New Command </h4>
Items :
@foreach ($items as $item)
    {{ $item }}
@endforeach
<br> Worker : {{ $user->name }}
<br> Service : {{ $service->name }}
<br> Note : {{ $command->note ?? '' }}
<br> Client : {{ $command->client ?? '' }}
<br> Delivery Address : {{ $command->delivery_address ?? '' }}
