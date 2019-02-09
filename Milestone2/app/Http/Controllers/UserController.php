<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller
{
    public function DisplayAllUsers(Request $request){
        
        try{
            //Call Security Service to get the method
            $ss = new SecurityService();

            
            //call the FindAllUsers() 
            $find = $ss->FindAllUsers();
          
            //Render a failed or success response View and pass the User model to it
            if($find){
                return view('ShowAllUsers')->with($find);
            }
            else{
                return view('loginFailed');
            }
        }
        catch(Exception $e){
            //BEST PRACTICE: Catch all exceptions (do not swallow exceptions) log the exception
            //do not throw technology specific exceptions and throw a custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
            
        }
        
    }
}
