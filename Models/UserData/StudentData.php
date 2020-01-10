<?php


class StudentData extends ClassData
{
    protected $_tableGroup, $_dateJoined;

    /**
     * StudentData constructor.
     */
    public function __construct($user_data)
    {
        parent::__construct($user_data);
        $this->_tableGroup = $user_data['tableGroup'];
        $this->_dateJoined = $user_data['dateJoined'];
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
    public function getInfo($userName)
    {
        parent::getInfo($this->getUsername());
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

    /**
     * @param $newClass ->
     */
    public function setClass($newClass){
        //Inherited from ClassData
        $this->_classID = $newClass;
    }

}