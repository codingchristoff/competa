<?php

require_once("Models/UserData/UserDataSet.php");

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
}