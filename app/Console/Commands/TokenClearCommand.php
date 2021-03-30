<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TokenClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'camera:tokenclear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear token.json file';

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



         Storage::Disk('token')->delete('tokens.json');
         $this->info('Token file deleted.');

    

        return 0;
    }
}
