<?php

require_once('Models/UserData/ClassData.php');

class StudentData extends ClassData
{
    protected $_studentID, $_tableGroup, $_dateJoined;

    /**
     * StudentData constructor.
     */
    public function __construct($user_data)
    {
        parent::__construct($user_data);
        $this->_studentID = $user_data['studentID'];
        $this->_tableGroup = $user_data['tableGroup'];
        $this->_dateJoined = $user_data['dateJoined'];
    }

    public function getUserID()
    {
        return $this->_studentID;
    }

    /**
     * @return mixed
     */
    public function getTableGroup()
    {
        return $this->_tableGroup;
    }

    /**
     *  Requires DataSet to implement
     */
    public function setTable()
    {
        return ;
    }

    /**
     * @return StudentData|void
     * Gets student data
     */
    public function getInfo()
    {
        parent::getInfo();
    }

    /**
     *  Requires DataSet to implement
     */
    public function selectOpenRounds()
    {
        return ;
    }

    /**
     *  Requires DataSet to implement
     */
    public function viewPublishedRounds()
    {
        return ;
    }

    /**
     *  Requires DataSet to implement
     */
    public function setDateJoined()
    {
        return ;
    }

}