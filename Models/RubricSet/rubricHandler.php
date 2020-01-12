<?php


class RubricHandler
{
    protected $dbHandle, $dbInstance;
    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getdbConnection();

    }

    public function createRubric()
    {


    }
    public function createRubricFromName($rubricName)
    {

    }



}