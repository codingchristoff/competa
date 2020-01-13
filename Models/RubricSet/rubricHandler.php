<?php

require_once('');

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
    public function checkRubricName($rubricName)
    {
        //checks if value exists in database
        $sql = "SELECT * FROM rubrics WHERE rubricName = :rubricName";
    
            if ($stmt = $this->_dbHandle->prepare($sql))
            {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":rubricName", $param_rubricName, PDO::PARAM_STR);
    
                // Set parameters
                $param_rubricName = trim($rubricName);
    
                // Attempt to execute the prepared statement
                if ($stmt->execute())
                {
                    if ($stmt->rowCount() == 1)
                    {
                        $row = $stmt->fetch();
                        return new Rubric($row);                        
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return "An error has occurred, please try again later.";
                }
            }
            //Close statement
            unset($stmt);
            //Close connection
            unset($pdo);
        }
           public function createRubric($rubricName)
           {
               


           }
        //if it does then 


    }



}