<?php

namespace App\Services\Business;

use \PDO;
use Illuminate\Support\Facades\Log;
use App\Models\UserModel;
use App\Services\Data\SecurityDAO;

class SecurityService{
    
    public function authenticate(UserModel $user){
        
        Log::info("Entering SecurityService.login()");
        
        //BEST PRACTICE: Externalize your application configuration
        //Get Credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //BEST PRACTICE: Do not create Database Connections in a DAO
        //Create Connection
        $conn = new \PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection
        //Create Connection
        $service = new SecurityDAO($conn);
        $flag = $service->findByUser($user);
        
        
        //Return the finder results
        Log::info("Exit SecurtiyService.login() with " . $flag);
        return $flag;
        
    }
    
    public function FindAllUsers(){
        
        Log::info("Entering SecurityService.FindAllUsers()");
        
     
        //Get Credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //BEST PRACTICE: Do not create Database Connections in a DAO
        //Create Connection
        $conn = new \PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Create a Security Service DAO with this connection
        //Create Connection
        $service = new SecurityDAO($conn);
        $flag = $service->DisplayAllUsers();
        
        
        //Return the finder results
        Log::info("Exit SecurtiyService.login() with " . $flag);
        return $flag;
        
    }
    
}