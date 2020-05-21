<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SSH;

class ServerController extends Controller
{
    /**
     * Show Admin Panel
     */
    public function index()
    {
        return view('admin-panel.index');
    }

    /**
     * Retrieve the status of a server
     */
    public function status()
    {
        $commands = [
            'cd ~/production/server',
            'ss -tulpn | grep \':30120\'',
        ];

        $result = false;
        SSH::into('production')->run($commands, function($line) use (&$result)
        {
            if ($line != "") {
                $result = true;
            }
        });

        return $result ? "true" : "false";
    }

    /**
     * Start the server
     */
    public function start()
    {
        $commands = [
            'cd ~/production/server',
            'screen -dmS fivem-production mono nfpm.exe start',
        ];

        SSH::into('production')->run($commands);

        return response(true);
    }

        /**
     * Start the server
     */
    public function stop()
    {
        $commands = [
            'cd ~/production/server',
            'screen -S fivem-production -X at "#" stuff ^C',
        ];

        SSH::into('production')->run($commands);

        return response(false);
    }

    /**
     * Update the server with Git
     */
    public function update()
    {
        $commands = [
            'cd ~/production/server/alpine/opt/cfx-server/resources/nfive',
            'git pull',
        ];

        $cmd = [];
        $error = false;
        SSH::into('production')->run($commands, function($line) use (&$cmd, &$error)
        {
            foreach (preg_split('/\r\n|\r|\n/', $line) as $new_line)
            {
                if($new_line != "")
                {
                    $cmd[] = $new_line;
                }
            }

            if (preg_match('/error/', $line))
            {
                $error = true;
            }
        });



        return response([
            'error' => $error,
            'cmd' => $cmd
        ], 200);
    }
}
