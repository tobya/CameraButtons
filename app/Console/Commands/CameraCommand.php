<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Artisan;
class CameraCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';
   // protected $hidden = true;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    protected $token;

    public function getToken($force = false){


        if ($this->token && !$force){
            return $this->token;
        }


        $tokens = json_decode(Storage::disk('token')->get( 'tokens.json'));


        $token = $tokens->{'camera'.$this->argument('camera')};
        $this->token = $token;

        return $token;
    }

    public function login(){

        // The data to send to the API
        $postData = array(

        "name"=> config('camera.username'), 
        "password" => config('camera.password'),

        );

        $token = $this->getToken();


        // Setup cURL
        $ch = curl_init( $token->url . '/login_name');
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,

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
        $Camera = $this->argument('camera');
         $Out = Artisan::call("camera:token $Camera bearer " . $responseData['data']['token']  );    

         $this->getToken(true);
         return $responseData['data']['token'];

    }


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
        return 0;
    }
}
