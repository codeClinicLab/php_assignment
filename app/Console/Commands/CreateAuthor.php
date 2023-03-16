<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User; 

class CreateAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-author';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Author';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $authorArr= [
            'first_name' => 'Author'.rand(1,50),
            'last_name' => 'Lname-'.rand(1,50),
            'birthday' => date('Y-m-d'),
            'biography' => 'Created from Command',
            'gender' => 'male',
            'place_of_birth' => 'India',

        ]; 
        $userData = User::first();  
       $this->AddAuthor($userData->api_token,$authorArr,$type='author'); 
       $this->info('Author has been Created');
    }

     public function AddAuthor($authToken,$authorArr=[],$type='author'){
        $ch = curl_init();
        if($type == 'author')
        {
         curl_setopt($ch, CURLOPT_URL, env('API_URL').'/api/v2/authors');
        }else{
         curl_setopt($ch, CURLOPT_URL, env('API_URL').'/api/v2/books');
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($authorArr));

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: '.$authToken;
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = json_decode(curl_exec($ch),true);
         
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        } 
        return isset($result['id'])   ? 'added' : 'faled'; 
        curl_close($ch);
    }
}
