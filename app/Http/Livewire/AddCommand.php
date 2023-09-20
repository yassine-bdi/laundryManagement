<?php

namespace App\Http\Livewire;

use App\Events\newCommand;
use App\Http\Requests\CommandRequest;
use App\Services\registerCommand;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AddCommand extends Component
{
    public $service;
    public $items = array();
    public $client;
    public $note;
    public $delivery_address;

    protected function rules(): array
    {
        return (new CommandRequest())->rules();
    }

    public function updated($client)
    {
        $this->validateOnly($client, ['client' => 'string|min:3|max:2000']);
    }

    public function render()
    {
        $itemsload = DB::table('laundries')->select(['id', 'name'])->get();
        $servicesload = DB::table('services')->select(['id', 'name'])->get();
        return view('livewire.add-command', ['itemsload' => $itemsload, 'services' => $servicesload]);
    }

    public function submit()
    {
        $newCommand = new registerCommand($this->validate());
        $command = $newCommand->registerCommand();
        event(new newCommand($command));
        session()->flash('message', 'Command added with success');
    }
}
