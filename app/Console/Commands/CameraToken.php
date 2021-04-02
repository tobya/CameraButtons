<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CameraToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'camera:token {camera} {token1} {token2}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Camera Login Token';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


    



        $tokenfn = 'tokens.json';

        $token = $this->argument('token1') . ' ' .       $token = $this->argument('token2');

        if (file_exists(resource_path('token/'. $tokenfn) )){

            $tokenarray =  json_decode( Storage::Disk('token')->get($tokenfn),true);
         } else {

            $tokenarray = [

                'camera1' => [
                    'url' => 'http://camerademo2.cookingisfun.ie'
                ],
                'camera2' => [
                    'url' => 'http://http://192.168.1.236'
                ]
            ];
        }

        $tokenarray['camera' . $this->argument('camera')]['token'] = $token;
        $tokenarray['camera' . $this->argument('camera')]['camera'] = $this->argument('camera');

        Storage::disk('token')->put('tokens.json', json_encode($tokenarray) );

        $this->info('Token written to disk');
        return 0;
    }


}
