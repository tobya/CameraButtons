<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CameraPreset extends CameraCommand
{

     protected $hidden = false;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'camera:preset {camera} {preset} {--login}';

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

        if ($this->option('login')){
            $this->login();
        }


// The data to send to the API
        $postData = array(

        "method"=> "SetPreset", 
        'operate'=> 0,
         'id'=> intval($this->argument('preset'))
        );


        $token = $this->getToken();

        // Setup cURL
        $ch = curl_init($token->url . '/camera_preset');
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
        Log::error(curl_error($ch));
            die(curl_error($ch));
        }

        // Decode the response
        $responseData = json_decode($response, TRUE);

        // Close the cURL handler
        curl_close($ch);

        // Print the date from the response
        $this->info( 'updated');


        Log::info(print_r($responseData,true));
        $this->info(print_r($responseData,true)); 

        return 0;
    }


    
}
