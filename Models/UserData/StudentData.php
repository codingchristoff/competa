<?php


class StudentData extends ClassData
{
    protected $tableGroup, $dateJoined;

    /**
     * StudentData constructor.
     */
    public function __construct()
    {
        parent::__construct();
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

    /**
     * @param $newClass -> new class ID
     */
    public function setClass($newClass){
        //Inherited from ClassData
        $this->_classID = $newClass;
    }

}