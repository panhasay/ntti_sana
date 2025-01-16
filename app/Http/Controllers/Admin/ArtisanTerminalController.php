<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;

class ArtisanTerminalController extends Controller
{
    protected $artisanCommands = [
        'install' => 'composer install',
        'update' => 'composer update',
        'require' => 'composer require',
    ];

    public function getAllCommands()
    {
        $commands = collect($this->artisanCommands)
            ->map(function ($description, $command) {
                return [
                    'command' => $command,
                    'description' => $description
                ];
            })
            ->values()
            ->toArray();

        return response()->json($commands);
    }

    public function executeArtisanCommand(Request $request)
    {
        $command = $request->input('command');

        putenv('COMPOSER_HOME=' . base_path('vendor/composer'));

        $allowedCommands = ['install', 'update', 'require'];

        if (!in_array($command, $allowedCommands)) {
            return "Invalid command: Only 'install', 'update', and 'require' are allowed.";
        }

        $fullCommand = "composer $command";
        if ($command === 'require') {
            $fullCommand .= ' simplesoftwareio/simple-qrcode --ignore-platform-reqs';
        }

        $output = [];
        $returnCode = 0;
        exec("$fullCommand 2>&1", $output, $returnCode);


        if ($returnCode === 0) {
            return "Composer command '$command' executed successfully.<br>" . implode('<br>', $output);
        } else {
            return "Failed to execute Composer command '$command'.<br>" . implode('<br>', $output);
        }
    }

    public function executeNPM(Request $request)
    {
        $command = $request->input('command');
        // Define allowed commands to prevent abuse
        $allowedCommands = ['dev', 'build'];

        if (!in_array($command, $allowedCommands)) {
            return "Invalid command: Only 'dev' and 'build' are allowed.";
        }

        // Build the command string
        $fullCommand = "npm run $command";

        // Change to the Laravel project root directory
        $projectRoot = base_path();

        // Execute the NPM command
        $output = [];
        $returnCode = 0;
        exec("cd $projectRoot && $fullCommand 2>&1", $output, $returnCode);

        // Handle the response
        if ($returnCode === 0) {
            return "NPM command '$command' executed successfully.<br>" . implode('<br>', $output);
        } else {
            return "Failed to execute NPM command '$command'.<br>" . implode('<br>', $output);
        }
    }
}
