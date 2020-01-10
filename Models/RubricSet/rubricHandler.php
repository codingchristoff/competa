<?php

require_once('Models/Database.php');
require_once('Models/RubricSet/Rubric.php');
require_once('Models/RubricSet/Categories.php');
require_once('Models/RubricSet/Criteria.php');

class rubricHandler
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }
    
    public function test($rubericName)
    {
        $sqlQuery = 'SELECT * FROM rubrics WHERE rubricName = :rubricName';
    
        $stmt = $this->_dbHandle->prepare($sqlQuery); // prepare PDO statement

        $stmt->bindParam(":rubricName", $param_rubericName, PDO::PARAM_STR);

        // Set parameters
        $param_rubericName = $rubericName;

        $stmt->execute(); // execute the PDO statement

        return new Rubric($stmt->fetch());  // return an array of UserData objects
    }

}