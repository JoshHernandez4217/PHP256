<?php
namespace App\Models;


class UserModel implements \JsonSerializable{
    
    private $id;
    private $username;
    private $password;
    private $FirstName;
    private $LastName;
    private $Email;
    
    public function __construct($id, $username, $password, $FirstName, $LastName, $Email){
        
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Email = $Email;
        
    }
    
    public function jsonSerialize(){
        
        return get_object_vars($this);
    }
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->LastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    

    
    
    
}