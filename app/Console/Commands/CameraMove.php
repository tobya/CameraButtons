<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;


class CameraMove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'camera:move {camera} {axis} {dir} {cmd}';

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

// The data to send to the API

        //{method: "SetPtzf", axis: 0, dir: 0, cmd: 2}
        $postData = array(

        "method"=> "SetPtzf", 
        'axis' => intval($this->argument('axis')),
        'dir'=> intval($this->argument('dir')),
        'cmd' => intval($this->argument('cmd')),
         
        );


        $tokens = json_decode(Storage::disk('token')->get( 'tokens.json'));


        $token = $tokens->{'camera'.$this->argument('camera')};

        // Setup cURL
        $ch = curl_init($token->url . '/camera_move');
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: '. $token->token ,
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        // Send the request
        $response = curl_exec($ch);

        // Check for errors
        if($response === FALSE){
            die(curl_error($ch));
        }

        // Decode the response
        $responseData = json_decode($response, TRUE);

        // Close the cURL handler
        curl_close($ch);

        // Print the date from the response
        $this->info( 'updated');



        $this->info(print_r($responseData,true)); 

        return 0;

        
    }
}
