<?php

namespace App\Services;

use App\Http\Requests\CommandRequest;
use App\Models\Command;
use Illuminate\Http\Request;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Boolean;

class DeleteCommand
{
    private $command;

    public function __construct(int $command)
    {
        $this->command = $command;
    }

    public function deleteCommand(): Bool
    {
        if (Command::where('id', $this->command)->exists()) {
            $commandToDelete = Command::find($this->command);
            $commandToDelete->delete();
            return true;
        }
        return false;
    }
}
