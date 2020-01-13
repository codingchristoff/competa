<?php

require_once('Models/RubricSet/Rubric.php');
require_once('Models/RubricSet/Categories.php');

class RubricHandler
{
    protected $dbHandle;
    protected $dbInstance;
    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getdbConnection();
    }

    /**
     * @param rubricName information
     */
    public function retreiveRubric($rubricName)
    {
        //checks if value exists in database
        $sql = "SELECT * FROM rubrics WHERE rubricName = :rubricName";
    
        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":rubricName", $param_rubricName, PDO::PARAM_STR);
    
            // Set parameters
            $param_rubricName = trim($rubricName);
    
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch();
                    return new Rubric($row);
                } else {
                    return false;
                }
            } else {
                return "An error has occurred, please try again later.";
            }
        }
        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }

    public function retreiveCategory($category)
    {
        //checks if value exists in database
        $sql = "SELECT * FROM categories WHERE categoryName = :categoryName";
    
        if ($stmt = $this->_dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":categoryName", $param_categoryName, PDO::PARAM_STR);
    
            // Set parameters
            $param_categoryName = trim($category);
    
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch();
                    return new Categories($row);
                } else {
                    return false;
                }
            } else {
                return "An error has occurred, please try again later.";
            }
        }
        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }

    public function retreiveCriteria($rubricName)
    {
        //checks if value exists in database
        $sql = "SELECT * FROM rubrics WHERE rubricName = :rubricName";
    
        if ($stmt = $this->_dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":rubricName", $param_rubricName, PDO::PARAM_STR);
    
            // Set parameters
            $param_rubricName = trim($rubricName);
    
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch();
                    return new Rubric($row);
                } else {
                    return false;
                }
            } else {
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
        $verify = checkRubricName($rubricName);

        //checks if the value returned is a Rubric object.
        if (is_a($verify, 'Rubric')) {
            // Prepare an insert statement
            $sql = "INSERT INTO rubric (rubricName) VALUES (:rubricName)";

            if ($stmt = $this->_dbHandle->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":rubricName", $param_rubricName, PDO::PARAM_STR);

                // Set parameters
                $param_rubricName = trim($rubricName);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    return "Name added to DB.";
                } else {
                    return "Something went wrong. Please try again later.";
                }
            }
        } else {
        }
        
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }
}
