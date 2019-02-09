<?php

namespace App\Services\Data;


use \PDO;
use Illuminate\Support\Facades\Log;
use App\Models\UserModel;
use App\Services\Utility\DatabaseException;
use PDOException;
use Exception;


class SecurityDAO{
    
    private $conn = NULL;
    
    //BEST PRACTICE: Do not create Database Connections in  a DAO 
    // so you can support Atomic Database Transactions
    
    public function __construct($conn){
        $this->conn = $conn;
    }
    
    
    public function findByUser(UserModel $user){
        
        Log::info("Enter SecurityDAO, findByUser()");
        
        //catch all exceptions    
        try{
        //Select username and password and seee if this row exists
        $name = $user->getUsername();
        $password = $user->getPassword();
        $sth = $this->conn->prepare('SELECT ID, Username, Password FROM users WHERE Username = :username AND Password = :password');
        $sth->bindParam(':username', $name);
        $sth->bindParam(':password', $password);
        $sth->execute();
        
        //See if user existed and return true if found else return false if not found
        //Below is a business service rule
        if($sth->rowCount() == 1){
            Log::info("Exit SercurityDAO, findByUser() with true");
            return true;
        }
        else{
            Log::info("Exit SecurityDAO, findByUser() with False");
            return false;
        }
        
        }
        catch(Exception $e){
            //BEST PRACTICE: Catch all exceptions (do not swallow exceptions) log the exception
            //do not throw technology specific exceptions and throw a custom exception
            Log::error("Exception: " , array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
       
        
        
        
    }
    
    public function DisplayAllUsers(){
        
        Log::info("Enter SecurityDAO, DisplayAllUsers()");
        
        //catch all exceptions
        try{
            //Select username and password
            $sth = $this->conn->prepare('SELECT * FROM users');
            $sth->execute();
            
            //See if user existed and return true if found else return false if not found
            //Below is a business service rule
            if($sth->rowCount() > 0){
                Log::info("Exit SercurityDAO, findByUser() with true");
                return true;
            }
            else{
                Log::info("Exit SecurityDAO, findByUser() with False");
                return false;
            }
            
        }
        catch(Exception $e){
            //BEST PRACTICE: Catch all exceptions (do not swallow exceptions) log the exception
            //do not throw technology specific exceptions and throw a custom exception
            Log::error("Exception: " , array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        
        
        
    }
    
    
    
    
}