<?php

require_once ('Models/UserDataSet.php');


class UserData
{
    protected $userID, $roleID, $firstName, $lastName, $username, $email, $password;

    public function __construct($user_data)
    {
        //Checks if user_id exists --> this means it is getting information from the database
        if (array_key_exists('user_id', $user_data)){
            $this->userID = $user_data['userID'];
            $this->roleID = $user_data['roleID'];
            $this->firstName = $user_data['firstName'];
            $this->lastName = $user_data['lastName'];
            $this->username = $user_data['userName'];
            $this->email = $user_data['email'];
            $this->password = $user_data['password'];
        }
        else{
            $this->username = $user_data['username'];
            echo $this->username;
            $this->password = $user_data['password'];
            $this->login();
        }

    }

    /**
     * Logs the user in
     *
     */
    private function login(){

        $userDataSet = new UserDataSet();


        $result = $userDataSet->fetchUser($this->username);
        echo $result;

        //Fetching the user to see if the username exists
        if ($result != null)
        {
            //Checks password to see if it matches the stored user's password
            if (password_verify($this->password, $result->getUserPassword()))
            {
                //Details of the user that is logged in
                $_SESSION['user'] = $this;
                return true;
            }
            else {
                echo'put error message here (password)';
                return false;
            }
        }
        else{
            echo 'put error message here (username)';
            return false;
        }
    }


    public function getUserID()
    {
        return $this->userID;
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