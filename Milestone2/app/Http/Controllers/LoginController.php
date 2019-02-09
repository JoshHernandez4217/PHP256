<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Services\Business\SecurityService;
use Illuminate\Support\Facades\Log;
use Exception;


class LoginController extends Controller
{

        public function index(Request $request){
            try{
                
                //Get the posted Form Data
                $username = $request->input('username');
                $password = $request->input('password');
                
                //Save a posted Form Data in User Object Model
                $user = new Usermodel(-1, $username, $password, -1, -1. -1, -1);
                
                //Call Security Business Service
                $service = new SecurityService();
                $status = $service->authenticate($user);
                
                //Render a failed or success response View and pass the User model to it
                if($status){
                    $data = ['model' => $user];
                    return view('Homepage')->with($data);
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
