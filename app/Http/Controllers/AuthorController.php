<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cache; 
class AuthorController extends Controller
{
   
    public function show(){ 
        $apiToken = Auth::user()->api_token; 
        // $data = Cache::remember('author_list', '20' , function () use ($apiToken) {
        //     return $this->getAuthors($apiToken);
        // });  
        $data = $this->getAuthors($apiToken); 
        // $books =  $this->getBooks($apiToken);  
        return view('author-list',compact('data'));
    }

    public function AuthorDetails($id){ 
        $apiToken = Auth::user()->api_token; 
         
        $Details =  $this->getSingleAuthors($apiToken,$id); 
         // echo "<pre>"; print_r($AuthorDetails); die;
       
        return view('author-details',compact('Details'));
    }

    

    public function deleteBook($id){
        $apiToken = Auth::user()->api_token;
         $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('API_URL').'/api/v2/books/'.$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: '.$apiToken;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
          curl_close($ch);
          $result = json_decode($result,true);
         return redirect()->back()->with(['success' => 'Book Deleted']);;
        

    }

    public function delete($id){
        $apiToken = Auth::user()->api_token;
         $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('API_URL').'/api/v2/authors/'.$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: '.$apiToken;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
          curl_close($ch);
          $result = json_decode($result,true);
         return redirect()->intended('/author-list')->with(['success' => 'User Deleted']);;
        

    }

    

    public function add(Request $request){

        if($request->has('_token')){
            $post = $request->except('_token');  
            $apiToken = Auth::user()->api_token;
            $result = $this->AddAuthor($apiToken,$post);
            if($result == 'added'){
                  return redirect()->intended('/author-list')->with(['success' => 'Added']);;
            }else{
                  return redirect()->intended('/author-list')->with(['error' => 'Failed']);;
            }
        }else{
            return view('add-author'); 
        }  
         
        
    }

    public function addBook(Request $request){

            $apiToken = Auth::user()->api_token;
        if($request->has('_token')){
            $post = $request->except('_token');  
            $dataArr = [
               "author" => [
                     "id" => $post['author_id'] 
                  ], 
               "title" =>  $post['title'], 
               "release_date" =>  $post['release_date'], 
               "description" => $post['description'],
               "isbn" => $post['isbn'],
               "format" => $post['format'], 
               "number_of_pages" => intval($post['number_of_pages'])
            ]; 
             
            $result = $this->AddAuthor($apiToken,$dataArr,'book');
            if($result == 'added'){
                  return redirect()->back()->with(['success' => 'Book Added']);
            }else{
                  return redirect()->back()->with(['error' => 'Falied to add']);
            }
        }else{
             $authors = $this->getAuthors($apiToken); 
            return view('add-book',compact('authors')); 
        }  
         
        
    }

    

    public function getSingleAuthors($authToken,$id){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('API_URL').'/api/v2/authors/'.$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: '.$authToken;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
          curl_close($ch);
          $result = json_decode($result,true);

        return $result;
    }


    public function getAuthors($authToken){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('API_URL').'/api/v2/authors?orderBy=id&direction=ASC&limit=12&page=1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: '.$authToken;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
          curl_close($ch);
          $result = json_decode($result,true);

          return $result;
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


    public function getBooks($authToken){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,   env('API_URL').'/api/v2/books?orderBy=id&direction=ASC&limit=12&page=1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: '.$authToken;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

         $result = json_decode(curl_exec($ch),true);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        return $result; 
        curl_close($ch);
    }


}
