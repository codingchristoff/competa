<?php


abstract class Transit
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        require_once('Models/Database.php');

        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    // Executes sql queries to eliminate duplicate code
    public function sql_prep($sqlQuery, $return)
    {
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        if($return == true)
        {
            return $statement;
        }
    }
}