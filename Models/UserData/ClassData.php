<?php

require_once("Models/UserData/UserDataSet.php");
require_once("Models/UserData/UserData.php");

class ClassData extends UserData
{
    protected $_classID, $_user_ds;

    public function __construct($user_data)
    {
        parent::__construct($user_data);
        $this->_classID = $user_data['classID'];
        //$this->_user_ds = new UserDataSet();
    }

    /**
     *  Subclasses should only see student data
     * */
    public function getInfo()
    {
        //$user = $this->_user_ds->fetchUser($userName);

        //if($user instanceof AdminData || $user instanceof TeacherData)
        //{}
        //else {
           // return $user;
        //}
    }

    public function getClassID()
    {
        return $this->_classID;
    }



    /**
     * @param $newClass -> new class ID
     */
    public function setClass($newClass){

        //Creating a database connection to save user's details
        $userSaveConnection = new UserDataSet();

        //Sets the user objects _classID (works for student and teacher)
        $this->_classID = $newClass;

        //Calling the editUser method (This method saves users into the database) -> passes the UserData object itself to the method
        $userSaveConnection->editUser($this);
    }

}