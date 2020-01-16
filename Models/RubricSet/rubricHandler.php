<?php

require_once('Models/RubricSet/Rubric.php');
require_once('Models/RubricSet/Category.php');
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

    //################ Get Methods ################

    /**
     * Returns the rubricID from the rubricName as an int
     */
    public function retrieveRubricID($rubricName)
    {
        //checks if value exists in database
        $sql = "SELECT rubricID FROM rubrics WHERE rubricName = :rubricName";
    
        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":rubricName", $param_rubricName, PDO::PARAM_STR);
    
            // Set parameters
            $param_rubricName = trim($rubricName);
    
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch();
                    return (int)$row['rubricID'];
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }
    /**
     * Returns rubricName from the rubricID
     */
    public function retrieveRubricName($rubricID)
    {
        //checks if value exists in database
        $sql = "SELECT rubricName FROM rubrics WHERE rubricID = :rubricID";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":rubricID", $param_rubricID, PDO::PARAM_STR);

            // Set parameters
            $param_rubricID = trim($rubricID);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch();
                    return (String)$row['rubricName'];
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }

    /**
     * Returns the category id based on the name of the category
     */
    public function retrieveCategoryID($categoryText)
    {
        $sql = "SELECT categoryID FROM categories WHERE categoryText = :categoryText";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":categoryText", $param_categoryText, PDO::PARAM_STR);

            // Set parameters
            $param_categoryText = trim($categoryText);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $row = $stmt->fetch();
                return $row['categoryID'];
            } else {
                return false;
            }
        }
        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }

    /**
     * Returns the category row from the category text
     */
    public function retrieveCategory($categoryID)
    {
        //checks if value exists in database
        $sql = "SELECT * FROM categories WHERE categoryID = :categoryID";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":categoryID", $param_categoryID, PDO::PARAM_STR);
    
            // Set parameters
            $param_categoryID = trim($categoryID);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch();
                    return new Category($row);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }

    /**
     * Returns a criteria row from the criteria text
     */
    public function retrieveCriteria($criteriaID)
    {
        //checks if value exists in database
        $sql = "SELECT * FROM criteria WHERE criteriaID = :criteriaID";
    
        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":criteriaID", $param_criteriaID, PDO::PARAM_STR);
    
            // Set parameters
            $param_criteriaID = trim($criteriaID);
    
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch();
                    return new Criteria($row);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }

    /**
     * Returns a criteria row from the criteria text
     */
    public function retrieveCriteriaID($criteriaText)
    {
        //checks if value exists in database
        $sql = "SELECT criteriaID FROM criteria WHERE criteriaText = :criteriaText";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":criteriaText", $param_criteriaText, PDO::PARAM_STR);

            // Set parameters
            $param_criteriaText = trim($criteriaText);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $row = $stmt->fetch();
                return $row['criteriaID'];
            }
        } else {
            return false;
        }
        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }

    /**
     * Returns all mergeIDs with the corresponding date as an array
     */
    public function retrieveRubricGroupOnDateID($dateID)
    {
        //checks if value exists in database
        $sql = "SELECT mergeID FROM rubricGroup WHERE dateID = :dateID";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":dateID", $param_dateID, PDO::PARAM_STR);

            // Set parameters
            $param_dateID = trim($dateID);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $mergeID = [];
                while ($row = $stmt->fetch()) {
                    $mergeID[] = (int)$row['mergeID'];
                }
                return $mergeID;
            }
        } else {
            return false;
        }
        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }

    /**
     * Returns all mergeIDs with the corresponding rubric id.
     */
    public function retrieveRubricGroupOnID($rubricID)
    {
        //checks if value exists in database
        $sql = "SELECT mergeID FROM rubricMerge WHERE rubricID = :rubricID";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":rubricID", $param_rubricID, PDO::PARAM_STR);

            // Set parameters
            $param_rubricID = trim($rubricID);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $mergeID = [];
                while ($row = $stmt->fetch()) {
                    $mergeID[] = $row['mergeID'];
                }
                return $mergeID;
            }
        }
    }

    /**
     * Returns the date from the dateID as a string
     */
    public function retrieveDate($dateID)
    {
        //checks if value exists in database
        $sql = "SELECT date FROM dates WHERE dateID = :dateID";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":dateID", $param_dateID, PDO::PARAM_STR);

            // Set parameters
            $param_dateID = trim($dateID);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch();
                    return (String)$row['date'];
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }

    /**
     * Returns the dateID from the date as an int
     */
    public function retrieveDateID($date)
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
                return false;
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
                return false;
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
    public function retrieveMergeID($rubricID, $categoryID, $criteriaID)
    {
        //checks if value exists in database
        $sql = "SELECT mergeID FROM rubricMerge WHERE rubricID = :rubricID AND categoryID = :categoryID AND criteriaID = :criteriaID";

        if ($stmt = $this->dbHandle->prepare($sql)) {
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
                $row = $stmt->fetch();
                return $row['mergeID'];
            }
        } else {
            return false;
        }

        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }

    /**
     * @return date string returns date in format required by sql
     */
    public function getTimestamp()
    {
        return date('Y-m-d H:i:s');
    }

    //################ Set Methods ################

    /**
     * Inserts rubric name into database
     *
     * @param rubricName string
     *
     * @return result int id
     */
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
                $result = $this->retrieveRubricID($rubricName);
                return $result['rubricName'];
            } else {
                return false;
            }
            // Close statement
            unset($stmt);
            // Close connection
            unset($pdo);
        }
    }

    /**
     * Inserts category name into database
     *
     * @param categoryText string
     *
     * @return result int id
     */
    public function createCategory($categoryText)
    {
        $sqlQuery = "INSERT INTO categories (categoryText) values (:categoryText)";

        if ($stmt = $this->dbHandle->prepare($sqlQuery)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":categoryText", $param_categoryText, PDO::PARAM_STR);

            // Set parameters
            $param_categoryText = trim($categoryText);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $result = $this->retrieveCategoryID($categoryText);
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }

    public function createCriteria($criteriaText)
    {
        $sqlQuery = "INSERT INTO criteria (criteriaText) values (:criteriaText)";

        if ($stmt = $this->dbHandle->prepare($sqlQuery)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":criteriaText", $param_criteriaText, PDO::PARAM_STR);

            // Set parameters
            $param_criteriaText = trim($criteriaText);

            // Attempt to execute the prepared statement
            $stmt->execute();
            $result = $this->retrieveCriteriaID($criteriaText);
            return $result;
        } else {
            return false;
        }
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }

    /**
     * Takes a timestamp and inserts into DB then returns the ID
     *
     * @param timestamp ('Y-m-d H:i:s')
     *
     * @return dateID int
     */
    public function createDate($date)
    {
        $sql = "INSERT INTO dates (date) values (:date)";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":date", $param_date, PDO::PARAM_STR);

            // Set parameters
            $param_date = trim($date);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                return $this->retrieveDateID($date);
            } else {
                return false;
            }
        } else {
            return false;
        }
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }

    public function createMerge($rubricID, $categoryID, $criteriaID)
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
                $result = $this->retrieveMergeID($rubricID, $categoryID, $criteriaID);
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }

    public function createGroup($mergeID, $dateID)
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
                return false;
            }
        } else {
            return false;
        }
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }

    //################ Verification Methods ################

    /**
     * Checks if rubric exists, if it does then returns ID otherwise creates and returns the ID.
     *
     * @param rubricName
     *
     * @return rubricID
     */
    public function checkRubric($rubricName)
    {
        $rubricID = $this->retrieveRubricID($rubricName);

        if ($rubricID == false) {
            $rubricID = $this->createRubric($rubricName);
        }
        return $rubricID;
    }

    /**
     * Checks if category exists, if it does then returns ID otherwise creates and returns the ID.
     *
     * @param categoryName
     *
     * @return categoryID
     */
    public function checkCategory($categoryText)
    {
        $categoryID = $this->retrieveCategoryID($categoryText);

        if ($categoryID == false) {
            $categoryID = $this->createCategory($categoryText);
        }
        return $categoryID;
    }

    /**
     * Checks if criteria exists, if it does then returns ID otherwise creates and returns the ID.
     *
     * @param criteriaName
     *
     * @return criteriaID
     */
    public function checkCriteria($criteriaName)
    {
        $criteriaID = $this->retrieveCriteriaID($criteriaName);

        if ($criteriaID == false) {
            $criteriaID = $this->createCriteria($criteriaName);
        }
        return $criteriaID;
    }

    /**
     * Checks if date exists, if it does then returns ID otherwise creates and returns the ID.
     *
     * @param timestamp
     *
     * @return dateID
     */
    public function checkDate($timestamp)
    {
        $dateID = $this->retrieveDateID($timestamp);

        if ($dateID == false) {
            $dateID = $this->createDate($timestamp);
        }

        return $dateID;
    }

    /**
     * Checks if date exists, if it does then returns ID otherwise creates and returns the ID.
     *
     * @param rubricID
     * @param categoryID
     * @param criteriaID
     *
     * @return rubricID
     * @return categoryID
     * @return criteriaID
     */
    public function checkMergeID($rubricID, $categoryID, $criteriaID)
    {
        $mergeID = $this->retrieveMergeID($rubricID, $categoryID, $criteriaID);

        if ($mergeID == false) {
            $mergeID = $this->createMerge($rubricID, $categoryID, $criteriaID);
        }

        return $mergeID;
    }

    //################ Main Methods ################

    public function searchRubric($rubricName)
    {
        $rubricID = $this->retrieveRubricID($rubricName);

        if ($rubricID == false) {
            return "No rubric found, please alter search term";
        } else {
            //checks if value exists in database
            $sql = "SELECT mergeID FROM rubricMerge WHERE rubricID = :rubricID";
    
            if ($stmt = $this->dbHandle->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":rubricID", $param_rubricID, PDO::PARAM_STR);

                // Set parameters
                $param_rubricID = trim($rubricID);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    $mergeID = [];
                    while ($row = $stmt->fetch()) {
                        $mergeID[] = $row['mergeID'];
                    }
                    if ($mergeID == null) {
                        return "No merge results found";
                    } else {
                        //loop through mergeID and return the dateID into the array
                        
                        $date = [];
                        foreach ($mergeID as $id) {
                            $sql = "SELECT d.date FROM rubricGroup rg INNER JOIN dates d WHERE rg.mergeID = $id AND rg.dateID = d.dateID";

                            if ($stmt = $this->dbHandle->prepare($sql)) {
                                // Attempt to execute the prepared statement
                                if ($stmt->execute()) {
                                    $row = $stmt->fetch();
                                    if (!$row == null) {
                                        $date[] = $row['date'];
                                    }
                                }
                            }
                        }
                        
                        $date = array_unique($date);
                        if (sizeof($date) == 0) {
                            return "No results found.";
                        } else {
                            return $date;
                        }
                    }
                }
                //Close statement
                unset($stmt);
                //Close connection
                unset($pdo);
            }
        }
    }

    /**
     * Method will take search input and return a rubric object which
     *
     * @param date specific timestamp
     * @param rubricName specific name of the Rubric
     *
     * @return Rubric object which contains the information needed to produce a blank rubric
     */
    public function buildRubric($date, $rubricName)
    {
        $mergeID = [];

        $dateID = $this->retrieveDateID($date);

        $rubricID = $this->retrieveRubricID($rubricName);

        //Returns a list of merge id's which contain the matching rubric ID
        $mergeID[] = $this->retrieveRubricGroupOnID($rubricID);

        //Loops through each merge id and returns the ones which match the date
        foreach ($mergeID as $group) {
            $rubricGroup = $this->retrieveRubricGroupOnDateID($dateID);
        }

        //Loops through each
        $mergeList = [];
        foreach ($rubricGroup as $mergeID) {
            $mergeList[] = $this->retrieveMerge($mergeID);
        }
        //var_dump($mergeList);

        //Creates new rubric object.
        $rubric=new Rubric($rubricID, $rubricName);

        //holds the value of the first categoryID in the array
        $holder=$mergeList[0]['categoryID'];

        //In the created rubric, creates and adds a category object using the int in $holder
        //$rubric->addCategory($this->retrieveCategory($holder));

        //Creates a new Category Object, so that it can be sent to the rubric later.
        $category = ($this->retrieveCategory($holder));

        //Loops through the merge array
        foreach ($mergeList as $mergeItem) {
            //Checks current objects categoryID with previous to see if its a new category
            if (!($mergeItem['categoryID'] == $holder)) {
                //if it is different, sends off the last category to the rubric
                $rubric->addCategory($category);
                $category=($this->retrieveCategory($mergeItem['categoryID']));
            }
            //gets criteria object from current criteria ID
            $category->addCriteria($this->retrieveCriteria($mergeItem['criteriaID']));
            //Changes holder, to hold previous categoryID
            $holder =   $mergeItem['categoryID'];
        }
        //adds final category to the rubric
        $rubric->addCategory($category);

        // Return final rubric obj
        return $rubric;


        //$rubricObj = new Rubric($rubricID, $rubricName);

        //set method in Rubric to set category
    }


    /**
     * Sorts the data that is passed back from the form
     *
     * @param postedResult string
     * @param dateID int
     *
     * @return boolean
     */
    public function insertAssessmentValues($postedResult, $dateID)
    {
        //$dateID = $this->checkDate($this->getTimestamp());

        $explosion = explode(",",$postedResult);

        $rubricID = $explosion[0];
        $categoryID = $explosion[1];
        $criteriaID = $explosion[2];
        $result = $explosion[3];
        $studentID = $explosion[4];
        $rubricDate = $this->checkDate($explosion[5]);

        $mergeID = $this->checkMergeID($rubricID, $categoryID, $criteriaID);

        return $this->createAssessmentValue($mergeID, $studentID, $result,$dateID, $rubricDate);
    }

    /**
     *
     */
    public function createAssessmentValue($mergeID, $studentID, $result,$dateID, $rubricDate)
    {
        $sql = "INSERT INTO assessments (mergeID, studentID, result, dateID, rubricDate) values (:mergeID, :studentID, :result, :dateID, :rubricDate)";
 
        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":mergeID", $param_mergeID, PDO::PARAM_STR);
            $stmt->bindParam(":studentID", $param_studentID, PDO::PARAM_STR);
            $stmt->bindParam(":result", $param_result, PDO::PARAM_STR);
            $stmt->bindParam(":dateID", $param_dateID, PDO::PARAM_STR);
            $stmt->bindParam(":rubricDate", $param_rubricDate, PDO::PARAM_STR);

            // Set parameters
            $param_mergeID = trim($mergeID);
            $param_studentID = trim($studentID);
            $param_result = trim($result);
            $param_dateID = trim($dateID);
            $param_rubricDate = trim($rubricDate);

            // Attempt to execute the prepared statement
            $stmt->execute();
                return true;
        } else {
            return false;
        }
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }

    /**
     * Enters the rubric data into the database
     *
     * not finished
     *
     * GET STRING FROM ALI
     * @param mergeID
     * @param dateID
     *
     * @return
     */
    public function insertRubricData($rubricText, $categoryText, $criteriaText, $dateID)
    {
        $rubricID = $this->checkRubric($rubricText);
        $categoryID = $this->checkCategory($categoryText);
        $criteriaID = $this->checkCriteria($criteriaText);

        $mergeID = $this->checkMergeID($rubricID, $categoryID, $criteriaID);

        $sql = "INSERT INTO rubricMerge (rubricID, categoryID, criteriaID, dateID) values (:mergeID, :studentID, :result, :dateID)";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":mergeID", $param_mergeID, PDO::PARAM_STR);
            $stmt->bindParam(":studentID", $param_studentID, PDO::PARAM_STR);
            $stmt->bindParam(":result", $param_result, PDO::PARAM_STR);
            $stmt->bindParam(":dateID", $param_dateID, PDO::PARAM_STR);

            // Set parameters
            $param_mergeID = trim($mergeID);
            $param_studentID = trim($studentID);
            $param_result = trim($result);
            $param_dateID = trim($dateID);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                return "Values inserted successfully";
            } else {
                return false;
            }
        } else {
            return false;
        }
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }

    public function getDatesFromStudentID($studentID)
    {
        //checks if value exists in database
        $sql = "SELECT dateID FROM assessments where studentID = :studentID";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":studentID", $param_studentID, PDO::PARAM_STR);

            // Set parameters
            $param_studentID = trim($studentID);
            $dateIDs = [];

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                    while ($row = $stmt->fetch()) {
                        $dateIDs[] = $row;
                    }
                    $dates = [];
                    foreach ($dateIDs as $ID)
                    {
                        $dates[]=($this->retrieveDate($ID['dateID']));
                    }
                    return $dates;
                }
            } else {
                return false;
            }
        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }

    public function getMergeIDsFromStudentID($studentID,$dateID)
    {
        //checks if value exists in database
        $sql = "SELECT mergeID,rubricDate FROM assessments where studentID = :studentID and dateID = :dateID";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":studentID", $param_studentID, PDO::PARAM_STR);
            $stmt->bindParam(":dateID", $param_dateID, PDO::PARAM_STR);

            // Set parameters
            $param_studentID = trim($studentID);
            $param_dateID = trim($dateID);

            $mergeIDs = [];

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                while ($row = $stmt->fetch())
                {
                 $mergeIDs[] = $row;
                }
            return $mergeIDs;
            }
        } else {
            return false;
        }

        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }


    public function createMarkedRubric($studentID,$assessmentDate)//,$rubricDate)
    {
        $mergeIDs = $this->getMergeIDsFromStudentID($studentID,$assessmentDate);
        $rubricDate = $mergeIDs[0]['rubricDate'];
        $rubricDate = $this->retrieveDate($rubricDate);
        foreach ($mergeIDs as $ID)
        {
            $merges[] = $this->retrieveMerge($ID['mergeID']);
        }
        $rubricID = $merges[0]['rubricID'];
        $this->retrieveRubricName($rubricID);
        $rubric = ($this->buildRubric($rubricDate,($this->retrieveRubricName($rubricID))));
        $rubricArray[]=$rubric;
        $mergedArrays[0] = $rubricArray;
        $mergedArrays[1] = $merges;

        return $mergedArrays;
    }


}
