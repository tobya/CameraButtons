<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CommandTokenInput extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'camera:tokeninput {camera}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

            $Camera = $this->argument('camera');

            if ($Camera == 'all'){
                $Cameras = collect([1,2]);
            } else {
                $Cameras = collect([$Camera]);
            }

            while(true){

                foreach ($Cameras as $Camera) {
                    # code...
            $token = readline('Input Token for Camera ' . $Camera . ': ');

            if ($token != ''){


            $Out = Artisan::call("camera:token $Camera bearer " . $token  );
            $this->info('Token Set for Camera: ' . $Camera );
            } 
                }
            }

        return 0;
    }
}
