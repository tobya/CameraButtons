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
            while(true){


            $tokens = readline('Input Token for Camera ' . $Camera . ': ');


            $Out = Artisan::call("camera:token $Camera " . $tokens  );
            $this->info('Token Set for Camera: ' . $Camera );
            }

        return 0;
    }
}
