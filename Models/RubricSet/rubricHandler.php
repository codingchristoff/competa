<?php

require_once('Models/RubricSet/Rubric.php');
require_once('Models/RubricSet/Categories.php');
require_once('Models/RubricSet/Criteria.php');

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
    public function retrieveRubric($rubricName)
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

    /**
     *
     */
    public function retreiveCategory($category)
    {
        //checks if value exists in database
        $sql = "SELECT * FROM categories WHERE categoryText = :categoryText";
    
        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":categoryText", $param_categoryText, PDO::PARAM_STR);
    
            // Set parameters
            $param_categoryText = trim($category);
    
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

    public function retrieveCriteria($criteriaText)
    {
        //checks if value exists in database
        $sql = "SELECT * FROM criteria WHERE criteriaText = :criteriaText";
    
        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":criteriaText", $param_criteriaText, PDO::PARAM_STR);
    
            // Set parameters
            $param_criteriaText = trim($criteriaText);
    
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch();
                    return new Criteria($row);
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

    /**
     * Returns all mergeIDs with the corresponding date
     */
    public function retrieveRubricGroup($date)
    {
        //checks if value exists in database
        $sql = "SELECT mergeID FROM rubricGroup WHERE date = :date";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":date", $param_date, PDO::PARAM_STR);

            // Set parameters
            $param_date = trim($date);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $mergeID = [];
                while ($row = $stmt->fetch());
                {
                                $mergeID[] = $row;
                            }
                return $mergeID;
            }
        } else {
            return "An error has occurred, please try again later.";
        }
        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }

    /**
     *
     */
    public function retrieveDate($date)
    {
        //checks if value exists in database
        $sql = "SELECT dateID FROM dates WHERE date = :date";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":date", $param_date, PDO::PARAM_STR);

            // Set parameters
            $param_date = trim($date);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch();
                    return (int)$row['dateID'];
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

    /**
     * Returns rubricID, categoryID, criteriaID based on mergeID.
     */
    public function retrieveMerge($mergeID)
    {
        //checks if value exists in database
        $sql = "SELECT * FROM rubricMerge WHERE mergeID = :mergeID";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":mergeID", $param_mergeID, PDO::PARAM_STR);

            // Set parameters
            $param_mergeID = trim($mergeID);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch();
                    return $row;
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

    public function masterMethod()
    {
        //check date if not then create
        //
    }

    public function createRubric($rubricName)
    {
            // Prepare an insert statement
            $sql = "INSERT INTO rubrics (rubricName) VALUES (:rubricName)";

            if ($stmt = $this->dbHandle->prepare($sql)) {
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
        } else {
            return "Something went wrong. Please try again later.";
        }
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }



    public function createCriteria($criteriaText)
    {  // Prepare an insert statement
        $sqlQuery = "INSERT INTO criteria (criteriaText) values (:criteriaText)";

        if ($stmt = $this->dbHandle->prepare($sqlQuery)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":criteriaText", $param_criteriaText, PDO::PARAM_STR);

            // Set parameters
            $param_criteriaText = trim($criteriaText);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                return "Criteria added to DB.";
            } else {
                return "Something went wrong. Please try again later.";
            }
        } else {
            return "Something went wrong. Please try again later.";
        }
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }
    public function createCategory($categoryName)
    {   // Prepare an insert statement
        $sqlQuery = "INSERT INTO categories (criteriaText) values (:categoryName)";

        if ($stmt = $this->dbHandle->prepare($sqlQuery)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":categoryName", $param_categoryName, PDO::PARAM_STR);

            // Set parameters
            $param_categoryName = trim($categoryName);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                return "Category added to DB.";
            } else {
                return "Something went wrong. Please try again later.";
            }
        }
        else {return "Something went wrong. Please try again later.";}
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }


    public function createDate($date)
    {
        $sqlQuery = "INSERT INTO dates (date) values (:date)";

        if ($stmt = $this->dbHandle->prepare($sqlQuery)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":date", $param_date, PDO::PARAM_STR);

            // Set parameters
            $param_date = trim($date);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                return $this->retrieveDate($date);
            } else {
                return "Something went wrong. Please try again later.";
            }
        }
        else {return "Something went wrong. Please try again later.";}
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }

    public function createMerge($rubricID,$categoryID,$criteriaID)
    {
        $sqlQuery = "INSERT INTO rubricMerge (rubricID,categoryID,criteriaID) values (:rubricID,:categoryID,:criteriaID)";

        if ($stmt = $this->dbHandle->prepare($sqlQuery)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":rubricID", $param_rubricID, PDO::PARAM_STR);
            $stmt->bindParam(":categoryID", $param_categoryID, PDO::PARAM_STR);
            $stmt->bindParam(":criteriaID", $param_criteriaID, PDO::PARAM_STR);

            // Set parameters
            $param_rubricID = trim($rubricID);
            $param_categoryID = trim($categoryID);
            $param_criteriaID = trim($criteriaID);
            // Attempt to execute the prepared statement

            if ($stmt->execute()) {
                return "Name added to DB.";
            } else {
                return "Something went wrong. Please try again later.";
            }
        } else {
            return "Something went wrong. Please try again later.";
        }
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }

    public function createGroup($mergeID,$dateID)
    {
        $sqlQuery = "INSERT INTO rubricGroup (mergeID, dateID) values (:mergeID,:dateID)";

        if ($stmt = $this->dbHandle->prepare($sqlQuery)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":mergeID", $param_mergeID, PDO::PARAM_STR);
            $stmt->bindParam(":dateID", $param_dateID, PDO::PARAM_STR);

            // Set parameters
            $param_mergeID = trim($mergeID);
            $param_dateID = trim($dateID);
            // Attempt to execute the prepared statement

            if ($stmt->execute()) {
                return "Group added to DB.";
            } else {
                return "Something went wrong. Please try again later.";
            }
        } else {
            return "Something went wrong. Please try again later.";
        }
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }

    public function test($test)
    {
        $verify = $this->retrieveRubric($test);

        if (is_a($verify, 'Rubric')) {
            return true;
        } else {
            return false;
        }
    }

    public function searchRubric($rubericName)
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
                    $rubricObj = [];
                    while ($row = $stmt->fetch());
                    {
                                    $rubricObj[] = $row;
                                }
                    return $rubricObj;
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
    }

    public Function buildRubric($date, $rubricName)
    {
        //$dateID = $this->retrieveDate($date);
        //Returns all mergeID that match the date    
        $rubricGroup[] = $this->retrieveRubricGroup($dateID);
        //Returns the rubric name
        $rubricObject = $this->retrieveRubric($rubricName);

        if($rubricName == false)
        {
            return "Rubric not found";
        }      
        else
        {
            RubricObject
        }
        else
        {
            return "Rubric does not exist. Please select another search term.";
        }

    }
}
