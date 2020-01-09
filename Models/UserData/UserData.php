<?php


class UserData
{
    protected $_user_id, $_username, $_email;

    public function __construct($dbRow)
    {
        $this->_user_id = $dbRow['user_id'];
        $this->_username = $dbRow['username'];
        $this->_email= $dbRow['email'];
    }

    public function getUserID()
    {
        return $this->_user_id;
    }

    public function getUsername()
    {
        return $this->_username;
    }

    public function getEmail()
    {
        return $this->_email;
    }
}