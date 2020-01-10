<?php

require_once("Models/UserDataSet.php");

class ClassData extends UserData
{
    protected $_classID, $_user_ds;

<<<<<<< HEAD
    public function __construct()
=======
    public function __construct($user_data)
>>>>>>> d1e094f687aa587e22f106520806ddb48413921f
    {
        parent::__construct($user_data);
        $this->_classID = $user_data['classID'];
        $this->_user_ds = new UserDataSet();
    }

    /**
     *  Subclasses should only see student data
     * */
    public function getInfo($userName)
    {
        $user = $this->_user_ds->fetchUser($userName);

        if($user instanceof AdminData || $user instanceof TeacherData)
        {}
        else {
            return $user;
        }
    }
}