<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ArtisanTerminalController;

class adminController extends Controller
{
    protected $cmd;

    public function __construct(ArtisanTerminalController $cmd)
    {
        $this->cmd = $cmd;
    }

    public function index()
    {
        $commandsResponse = $this->cmd->getAllCommands();
        $record_cmd = json_decode($commandsResponse->getContent(), true);

        return view('admin.admin', compact('record_cmd'));
    }
    public function show(Request $request)
    {
        $commandsResponse = $this->cmd->executeArtisanCommand($request);
        return $commandsResponse;
    }
    public function showNPM(Request $request)
    {
        $commandsResponse = $this->cmd->executeNPM($request);
        return $commandsResponse;
    }
}
