<?php

require_once ('Models/UserData/UserDataSet.php');


class UserData
{
    protected $roleID, $firstName, $lastName, $username, $email, $password;

    public function __construct($user_data)
    {
        //Setting class variables
            $this->roleID = $user_data['roleID'];
            $this->firstName = $user_data['firstName'];
            $this->lastName = $user_data['lastName'];
            $this->username = $user_data['userName'];
            $this->email = $user_data['email'];
            $this->password = $user_data['password'];
    }

    /**
     * @return mixed
     */
    public function getRoleID()
    {
        return $this->roleID;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
}