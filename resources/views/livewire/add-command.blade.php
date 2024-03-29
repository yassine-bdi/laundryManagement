<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <p> choose a service </p>
    <form action="{{ route('addcommand') }}" method="POST" wire:submit.prevent="submit">
        @csrf
        @foreach ($services as $service)
            <div class="form-check">
                <label class="form-check-label"> <input type="radio" name="service" class="form-check-input"
                        value="{{ $service->id }}" wire:model="service">

                    {{ $service->name }} </label>

            </div>
        @endforeach
        @error('service')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <p class="py-2"> choose an item </p>

        @csrf
        @foreach ($itemsload as $item)
            <div class="form-check">
                <label class="form-check-label"> <input type="checkbox" name="items[]" class="form-check-input"
                        value="{{ $item->id }}" wire:model="items">{{ $item->name }} </label>
            </div>
        @endforeach
        @error('items')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="py-2">
            <input type="text" name="client" class="form-control" placeholder="client's name.." value=""
                wire:model="client">
            @error('client')
                <p class="text-danger"> {{ $message }}</p>
            @enderror
        </div>
        <div class="py-2">
            <input type="text" name="delivery_address" class="form-control" placeholder="delivery address.."
                value=" " wire:model="delivery_address">
            @error('delivery_address')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="py-2">
            <input type="text" name="note" class="form-control" placeholder="write a note.." value=" "
                wire:model="note">
            @error('note')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="py-2">
            <input type="submit" class="btn btn-success" value="Send">
        </div>

    </form>



</div>
