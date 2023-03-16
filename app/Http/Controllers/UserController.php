<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function UserLogin(Request $request )
    {
            
        $post = $request->except('_token'); 

         $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $response =  $this->getUserToken($post);
            $data = $response['data'];  
            session(['api_token' => $data['token_key'] ]);
            session(['user_api_data' =>$data]);
            Auth::user()->update(['api_token' => $data['token_key'] , 'api_json' => json_encode($data)  ]); 
            return redirect()->intended('author-list')
                        ->withSuccess('Signed in');
        }
   
    }


    public function getUserToken($userArr){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('API_URL').'/api/v2/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($userArr));

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        $result = json_decode($result,true);


        
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        } 
        if(isset($result['id']) && isset($result['token_key'])){
              
            return [

                'success' => true,
                'message' => 'User Successfully fetched information',
                'data' => $result

            ];
        }else{ 

            return [

                'success' => false,
                'message' => 'failed to retrive information',
                'data' => ''

            ];

        } 
        curl_close($ch);


    }
}
