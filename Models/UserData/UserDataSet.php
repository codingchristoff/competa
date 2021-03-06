<?php

require_once('Models/Database.php');
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/TeacherData.php');
require_once('Models/UserData/StudentData.php');

class UserDataSet
{
    protected $dbHandle;
    protected $dbInstance;

    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getdbConnection();
    }

    //Checks the database for a specified user
    public function fetchUser($userName)
    {

        //Gets the first letter of the userName and puts it to lowercase
        $userType = strtolower(substr($userName, 0, 1));

        //Gets a student user
        if ($userType === 's') {
            //SQL statement will select a specific user
            $sqlQuery = 'SELECT * FROM students WHERE userName="' . $userName . '"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            $row = $statement->fetch();
            return new StudentData($row);
        }
        //Gets a teacher user
        elseif ($userType === 't') {
            //SQL statement will select a specific user
            $sqlQuery = 'SELECT * FROM teachers WHERE userName="' . $userName . '"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            $row = $statement->fetch();
            return new TeacherData($row);
        }
        //Gets an admin user
        elseif ($userType === 'a') {
            //SQL statement will select a specific user
            $sqlQuery = 'SELECT * FROM admins WHERE userName="' . $userName . '"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            $row = $statement->fetch();
            return new AdminData($row);
        } else {
            return null;
        }
    }

    //Checks the database for a specified user
    public function checkEmail($userEmail)
    {
        //SQL statement will select a specific user
        $sqlQuery = 'SELECT email FROM students WHERE email="' . $userEmail . '";';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Returns all students in an array
        $dataSetStudent = [];
        while ($row = $statement->fetch()) {
            $dataSetStudent[] = $row[0];
        }

        if (!empty($dataSetStudent))
        {
            return $dataSetStudent;
        }

        //SQL statement will select a specific user
        $sqlQuery = 'SELECT email FROM teachers WHERE email="' . $userEmail . '";';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Returns all students in an array
        $dataSetTeacher = [];
        while ($row = $statement->fetch()) {
            $dataSetTeacher[] = $row[0];
        }

        if (!empty($dataSetTeacher))
        {
            return $dataSetTeacher;
        }

        //SQL statement will select a specific user
        $sqlQuery = 'SELECT email FROM admins WHERE email="' . $userEmail . '";';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Returns all students in an array
        $dataSetAdmin = [];
        while ($row = $statement->fetch()) {
            $dataSetAdmin[] = $row[0];
        }

        if (!empty($dataSetAdmin))
        {
            return $dataSetAdmin;
        }
    }

    //Search the database for a specific user
    public function searchUser($userName)
    {
        //Gets the first letter of the userName and puts it to lowercase
        $userType = strtolower(substr($userName, 0, 1));

        //Gets a student user
        if ($userType === 's') {
            //SQL statement will select a specific user
            $sqlQuery = 'SELECT * FROM students WHERE userName LIKE"' . $userName . '%"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            //Returns all students in an array
            $dataSet = [];
            while ($row = $statement->fetch()) {
                $dataSet[] = new StudentData($row);
            }
            return $dataSet;
        }
        //Gets a teacher user
        elseif ($userType === 't') {
            //SQL statement will select a specific user
            $sqlQuery = 'SELECT * FROM teachers WHERE userName LIKE"' . $userName . '%"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            //Returns all students in an array
            $dataSet = [];
            while ($row = $statement->fetch()) {
                $dataSet[] = new TeacherData($row);
            }
            return $dataSet;
        }
        //Gets an admin user
        elseif ($userType === 'a') {
            //SQL statement will select a specific user
            $sqlQuery = 'SELECT * FROM admins WHERE userName LIKE"' . $userName . '%"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            //Returns all students in an array
            $dataSet = [];
            while ($row = $statement->fetch()) {
                $dataSet[] = new AdminData($row);
            }
            return $dataSet;
        } else {
            return null;
        }
    }


    //Used to check if unique variable exists, outputs userData object
    public function fetchUniqueVariable($variable, $type)
    {
        $variableClean = $this->cleanInput($variable);
        $typeClean = $this->cleanInput($type);

        //SQL statement will get a user with a specific variable in admins table
        $sqlQuery = 'SELECT * FROM admins WHERE ' . $typeClean . '="' . $variableClean . '";';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $row = $statement->fetch();

        //Check if anything was found in the database for admins
        if ($row != null) {
            return new AdminData($row);
        }

        //SQL statement will get a user with a specific variable in teachers
        $sqlQuery = 'SELECT * FROM teachers WHERE ' . $typeClean . '="' . $variableClean . '";';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $row = $statement->fetch();

        //Check if anything was found in the database for teachers
        if ($row != null) {
            return new TeacherData($row);
        }

        //SQL statement will get a user with a specific variable in students
        $sqlQuery = 'SELECT * FROM students WHERE ' . $typeClean . '="' . $variableClean . '";';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $row = $statement->fetch();

        //Check if anything was found in the database for teachers
        if ($row != null) {
            return new StudentData($row);
        }
    }



    //Logs in user
    public function login($userName, $password)
    {
        //Cleans up input
        $userClean = $this->cleanInput($userName);
        $passClean = $this->cleanInput($password);

        //Contains user information
        $user = $this->fetchUser($userClean);

        //Checks if the userName exists
        if ($user != null) {
            //Checks password to see if it matches for the userName
            if (password_verify($passClean, $user->getPassword())) {
                return $user;
            } else {
                return null;
            }
        }
    }



    //Gets all students
    public function fetchAllStudents()
    {
        //SQL statement will select all students
        $sqlQuery = 'SELECT * FROM students';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Returns all students in an array
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new StudentData($row);
        }
        return $dataSet;//Returns all students in an array
    }

    //Gets all teachers
    public function fetchAllTeachers()
    {
        //SQL statement will select all teachers
        $sqlQuery = 'SELECT * FROM teachers';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Returns all teacher in an array
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new TeacherData($row);
        }
        return $dataSet;
    }

    //Gets all admins
    public function fetchAllAdmins()
    {
        //SQL statement will select all admins
        $sqlQuery = 'SELECT * FROM admins';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Returns all teacher in an array
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new AdminData($row);
        }
        return $dataSet;
    }

    //Gets classID
    public function fetchClassID($className)
    {
        $sqlQuery = 'SELECT classID FROM classes WHERE className="' . $className .'"';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Getting the row (array)
        $row = $statement->fetch();

        //returning the first value (the classID)
        return $row[0];
    }

    //Gets className
    public function fetchClassName($classID)
    {
        $sqlQuery = 'SELECT className FROM classes WHERE classID="' . $classID .'"';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Getting the row (array)
        $row = $statement->fetch();

        //returning the first value (the classID)
        return $row[0];
    }

    //Gets all classNames
    public function fetchAllClassNames()
    {
        //SQL statement will select a specific user
        $sqlQuery = 'SELECT className FROM classes';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Returns all students in an array
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = $row[0];
        }
        return $dataSet;
    }

    //Gets all classNames
    public function fetchAllClasses()
    {
        //SQL statement will select a specific user
        $sqlQuery = 'SELECT * FROM classes';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Returns all students in an array
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new ClassInfoData($row);
        }
        return $dataSet;
    }

    //Adds a class to the database
    public function addClass($className)
    {
        //Cleans up input
        $classNameClean = $this->cleanInput($className);

        //Check if the name uses letters and spaces
        if (!(preg_match("/^[a-zA-Z ]*$/", $classNameClean)) || strlen($classNameClean) > 45) {
            return 'Class name error';
        }

        //Checks if the class already exists
        if ($this->fetchClassID($className)!==null) {
            return 'Class already exists';
        }

        //SQL statement will create a new class
        $sqlQuery = 'INSERT INTO classes (className) VALUES("' . $classNameClean.'")';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
    }

    //Deletes a class from the database
    public function deleteClass($className)
    {
        //Cleans up input
        $classNameClean = $this->cleanInput($className);

        if ($classNameClean=='Temporary') {
            return 'Cannot delete Temporary';
        }

        $classID = $this->fetchClassID($classNameClean);
        //Checks if the class exists
        if ($classID==null) {
            return 'Class does not exist';
        }

        //Changes all students who are in the deleted class into 'Temporary'
        $sqlQuery = 'UPDATE students SET classID="27" WHERE classID="' . $classID .'";';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Changes all teachers who are in the deleted class into 'Temporary'
        $sqlQuery = 'UPDATE teachers SET classID="27" WHERE classID="' . $classID .'";';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Deletes the class
        $sqlQuery = 'DELETE FROM classes WHERE classID="' . $classID .'"';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
    }

    //Gets all students that match a specific classID
    public function fetchStudentsInClass($classID)
    {
        //SQL statement will select a specific user
        $sqlQuery = 'SELECT * FROM students WHERE classID="' . $classID .'";';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Returns all students in an array
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new StudentData($row);
        }
        return $dataSet;//Returns all students in an array
    }

    // This function returns all students who are in a teachers class
    public function getStudentsInClass($classID)
    {
        $sql = "SELECT studentID,tableGroup FROM students WHERE classID = :classID";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            $stmt->bindParam(":classID", $param_classID, PDO::PARAM_STR);

            // Set parameters
            $param_classID = trim($classID);

            $stmt->execute(); // execute the PDO statement
            
//            //Getting the row (array)
//            $row = $stmt->fetch();
//            if ($row != false) {//returning the first value (the classID)
//                while ($row = $stmt->fetch()) {
//                    $studentIDs[] = $row;
//                }
//                return $studentIDs;
//            } else {
//                return "No students in class";
//            }

            // STEVENs POTENTIAL FIX
            $studentIDs = [];
            while ($row = $stmt->fetch()) {
                $studentIDs[] = $row; //First index studentID
            }
            return $studentIDs;//Returns all studentIDs

        } else {
            return false;
        }
    }

    public function getTeachersClassID($teacherID)
    {
        $sql = "SELECT classID FROM teachers WHERE teacherID = :teacherID";

        if ($stmt = $this->dbHandle->prepare($sql)) {
            $stmt->bindParam(":teacherID", $param_teacherID, PDO::PARAM_STR);

            // Set parameters
            $param_teacherID = trim($teacherID);

            $stmt->execute(); // execute the PDO statement

            //Getting the row (array)
            $row = $stmt->fetch();
            if ($row != false) {//returning the first value (the classID)
                return $row;
            } else {
                return "Teacher not found";
            }
        } else {
            return false;
        }
    }

    public function getTeachersName($teacherID)
    {
        $sql = "SELECT firstName, lastName FROM teachers WHERE teacherID = :teacherID";
    
        if ($stmt = $this->dbHandle->prepare($sql)) {
            $stmt->bindParam(":teacherID", $param_teacherID, PDO::PARAM_STR);
    
            // Set parameters
            $param_teacherID = trim($teacherID);
    
            $stmt->execute(); // execute the PDO statement
    
            //Getting the row (array)
            $row = $stmt->fetch();
            if ($row != false) {//returning the first value (the classID)
                return $row;
            } else {
                return "Teacher not found";
            }
        } else {
            return false;
        }
    }

    //Create user by adding to the database
    public function createUser($user, $classID)
    {
        //Cleans up input
        $userNameClean = $this->cleanInput($user->getUsername());
        $firstNameClean = $this->cleanInput($user->getFirstName());
        $lastNameClean = $this->cleanInput($user->getLastName());
        $emailClean = $this->cleanInput($user->getEmail());
        $passwordClean = $this->cleanInput($user->getPassword());

        //Encrypts the password using the Crypt_Blowfish algorithm
        $passwordClean = password_hash($passwordClean, PASSWORD_BCRYPT);

        //Gets the first letter of the userName and puts it to lowercase
        $userType = strtolower(substr($userNameClean, 0, 1));

        //Check to see if the userName is using the correct naming scheme
        if (!($userType=='s' || $userType=='t' || $userType=='a')) {
            return 'Username not using correct naming scheme, should start with S, T or A';
        } elseif ($userType=='a' && $classID!='None') {
            return 'Admins must have no class name';
        } elseif ($userType!='a' && $classID=='None') {
            return 'Only Admins can have no class';
        }

        //Checks if the user already exists
        if ($this->fetchUser($userNameClean)->getUsername()!==null) {

            return 'Username already exists';
        }

        //Check if email already exists
        if (!empty($this->checkEmail($emailClean)))
        {
            return 'Email already exists';
        }


        //Checks the rest of the variables to see if they are in the correct format
        $checkUserVariables = $this->checkUserVariables($userNameClean, $firstNameClean, $lastNameClean, $emailClean, $passwordClean);
        if ($checkUserVariables!==null) {
            return $checkUserVariables;
        }

        //Checks if user should be put into the student table
        if ($userType === 's') {
            $classIDClean = intval($this->cleanInput($classID));
            //SQL statement that will be inserted into the database
            $sqlQuery = 'INSERT INTO students (firstName, lastName, userName, email, password, roleID, classID) VALUES ("' . $firstNameClean . '", "' . $lastNameClean . '", "' . $userNameClean . '", "' . $emailClean . '", "' . $passwordClean . '", "3", "' . $classIDClean .'");';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        //Checks if user should be put into the teacher table
        elseif ($userType === 't') {
            $classIDClean = intval($this->cleanInput($classID));
            //SQL statement that will be inserted into the database
            $sqlQuery = 'INSERT INTO teachers (firstName, lastName, userName, email, password, roleID, classID) VALUES ("' . $firstNameClean . '", "' . $lastNameClean . '", "' . $userNameClean . '", "' . $emailClean . '", "' . $passwordClean . '", "2", "' . $classIDClean .'");';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        //Checks if user should be put into the admin table
        elseif ($userType === 'a') {
            //SQL statement that will be inserted into the database
            $sqlQuery = 'INSERT INTO admins (firstName, lastName, userName, email, password, roleID) VALUES ("' . $firstNameClean . '", "' . $lastNameClean . '", "' . $userNameClean . '", "' . $emailClean . '", "' . $passwordClean . '", "1");';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
    }

    //Remove student
    public function deleteUser($userName)
    {
        //Cleans up input
        $userClean = $this->cleanInput($userName);

        //Gets the first letter of the userName and puts it to lowercase
        $userType = strtolower(substr($userName, 0, 1));

        //Checks if user should be removed from student table
        if ($userType === 's') {
            //SQL statement that will delete a student
            $sqlQuery = 'DELETE FROM students WHERE userName="' . $userClean .'";';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            return true;
        }
        //Checks if user should be removed from teacher table
        elseif ($userType === 't') {
            //SQL statement that will delete a student
            $sqlQuery = 'DELETE FROM teachers WHERE userName="' . $userClean .'";';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            return true;
        }
        //Checks if user should be removed admin table
        elseif ($userType === 'a') {
            //SQL statement that will delete a student
            $sqlQuery = 'DELETE FROM admins WHERE userName="' . $userClean .'";';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            return true;
        }
    }

    //Edits a user
    public function editUser($user, $classID)
    {
        //Cleans up input
        $userNameClean = $this->cleanInput($user->getUsername());
        $firstNameClean = $this->cleanInput($user->getFirstName());
        $lastNameClean = $this->cleanInput($user->getLastName());
        $emailClean = $this->cleanInput($user->getEmail());
        $passwordClean = $this->cleanInput($user->getPassword());


        $editPassword = false;
        if ((!$passwordClean=="")) {
            //Encrypts the password using the Crypt_Blowfish algorithm
            $passwordClean = password_hash($passwordClean, PASSWORD_BCRYPT);

            $editPassword = true;
        }


        //Gets the first letter of the userName and puts it to lowercase
        $userType = strtolower(substr($userNameClean, 0, 1));

        //Tests on class name
        if ($userType=='a' && $classID!='None') {
            return 'Admins must have no class name';
        } elseif ($userType!='a' && $classID=='None') {
            return 'Only Admins can have no class';
        }

        //Checks the rest of the variables to see if they are in the correct format
        $checkUserVariables = $this->checkUserVariables($userNameClean, $firstNameClean, $lastNameClean, $emailClean, $passwordClean);
        if ($checkUserVariables!==null) {
            return $checkUserVariables;
        }

        //Checks if user should be removed from students table
        if ($userType === 's') {
            $classIDClean = intval($this->cleanInput($classID));
            //SQL statement that will edit a user
            if ($editPassword==true) {
                $sqlQuery = 'UPDATE students SET firstName="' . $firstNameClean .'", lastName="' . $lastNameClean.'", email="' . $emailClean.'", password="' . $passwordClean.'", classID="' . $classIDClean.'" WHERE userName="' . $userNameClean.'"';
            } else {
                $sqlQuery = 'UPDATE students SET firstName="' . $firstNameClean .'", lastName="' . $lastNameClean.'", email="' . $emailClean.'", classID="' . $classIDClean.'" WHERE userName="' . $userNameClean.'"';
            }

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        //Checks if user should be removed from teachers table
        elseif ($userType === 't') {
            $classIDClean = intval($this->cleanInput($classID));
            //SQL statement that will edit a user
            if ($editPassword==true) {
                $sqlQuery = 'UPDATE teachers SET firstName="' . $firstNameClean .'", lastName="' . $lastNameClean.'", email="' . $emailClean.'", password="' . $passwordClean.'", classID="' . $classIDClean.'" WHERE userName="' . $userNameClean.'"';
            } else {
                $sqlQuery = 'UPDATE teachers SET firstName="' . $firstNameClean .'", lastName="' . $lastNameClean.'", email="' . $emailClean.'", classID="' . $classIDClean.'" WHERE userName="' . $userNameClean.'"';
            }

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        //Checks if user should be removed from admins table
        elseif ($userType === 'a') {
            //SQL statement that will edit a user
            if ($editPassword==true) {
                $sqlQuery = 'UPDATE admins SET firstName="' . $firstNameClean .'", lastName="' . $lastNameClean.'", email="' . $emailClean.'", password="' . $passwordClean.'" WHERE userName="' . $userNameClean.'"';
            } else {
                $sqlQuery = 'UPDATE admins SET firstName="' . $firstNameClean .'", lastName="' . $lastNameClean.'", email="' . $emailClean.'" WHERE userName="' . $userNameClean.'"';
            }
            
            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
    }

    //Sets a students tableGroup
    public function setTableGroup($userName, $tableGroup)
    {
        //Cleans up input
        $userNameClean = $this->cleanInput($userName);
        $tableGroupClean = $this->cleanInput($tableGroup);

        if (!(preg_match("/^[0-9]+$/", $tableGroupClean))) {
            return 'Group must be a number';
        }

        //SQL statement that will edit a students tableGroup
        $sqlQuery= 'UPDATE students SET tableGroup="' . $tableGroupClean.'" WHERE userName="' . $userNameClean.'"';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
    }

    // used to clean inputs for security purposes
    private function cleanInput($i)
    {
        $i = trim($i);
        $i = stripcslashes($i);
        $i = htmlspecialchars($i);
        return $i;
    }

    //Used to check if an email is valid
    private function checkUserVariables($userName, $firstName, $lastName, $email, $password)
    {
        //Check if the length is too big
        if (strlen($userName) > 45) {
            return 'Username error';
        }
        //Check if the name uses letters and if it is the correct length
        if (!(preg_match("/^[a-zA-Z]*$/", $firstName)) || !(preg_match("/^[a-zA-Z]*$/", $lastName)) || strlen($firstName) > 45 || strlen($lastName) > 45) {
            return 'Name error';
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false || strlen($email) > 45) {
            return 'Email error';
        }

        if (strlen($password) > 255) {
            return 'Password error';
        }
    }
    public function getStudentName($studentID)
    {
        //checks if value exists in database
        $sql = "SELECT firstName, lastName FROM students where studentID = :studentID";
        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":studentID", $param_studentID, PDO::PARAM_STR);
            // Set parameters
            $param_studentID = trim($studentID);
            // Attempt to execute the prepared statement
            $stmt->execute();
            $row = $stmt->fetch();
            $name = $row['firstName'] . " " . $row['lastName'];
            return $name;
        } else {
            return false;
        }
        //Close statement
        unset($stmt);
        //Close connection
        unset($pdo);
    }
    /*
     * Inserts into the assigned rubrics table the values it is passed.
     */
    public function insertStudentAssignment($teacherID, $studentID, $rubricDate, $targetStudent)
    {
        $sql = "INSERT INTO assignedRubrics values (:teacherID, :studentID, :rubricDate, :targetStudent)";
        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":teacherID", $param_teacherID, PDO::PARAM_STR);
            $stmt->bindParam(":studentID", $param_studentID, PDO::PARAM_STR);
            $stmt->bindParam(":rubricDate", $param_rubricDate, PDO::PARAM_STR);
            $stmt->bindParam(":targetStudent", $param_targetStudent, PDO::PARAM_STR);
            // Set parameters
            $param_teacherID = trim($teacherID);
            $param_studentID = trim($studentID);
            $param_rubricDate = trim($rubricDate);
            $param_targetStudent = trim($targetStudent);
            // Attempt to execute the prepared statement
            $stmt->execute();
            return "Rubric has been assigned to student:" . $this->getStudentName($studentID) . " for student: " .$this->getStudentName($targetStudent);
        } else {
            return "There was an error accessing the database. Please try again.";
        }
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }

    /**
     *
     */
    public function getAssignedRubricForStudent($teacherID, $dateID, $studentID)
    {
        $rubricHandler = new RubricHandler();

        $teacherName = ($this->getTeachersName($teacherID));
        $rubricDate = ($rubricHandler->getdate($dateID));
        $rubricName = ($rubricHandler->getRubricNameOnDateID($dateID));
        $targetStudentID = $studentID;
        $studentName = $this->getStudentName($studentID);
        $data = ['firstName' => $teacherName['firstName'], 'lastName' => $teacherName['lastName'], 'rubricDate' => $rubricDate, 'rubricName' => $rubricName, 'targetStudentID' => $targetStudentID, 'targetStudentName' => $studentName];

        return $data;
    }

    /**
     * Removes the assigned rubric from the assignedRubrics table
     * 
     * @param studentID
     * @param targetStudent
     * @param rubricDate
     * 
     * @return string
     */
    public function removeAssignedRubric($studentID, $targetStudent, $rubricDate)
    {
        $sql = "DELETE FROM assignedRubrics WHERE studentID = :studentID AND targetStudent = :targetStudent AND rubricDate = :rubricDate";
        if ($stmt = $this->dbHandle->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":studentID", $param_studentID, PDO::PARAM_STR);
            $stmt->bindParam(":targetStudent", $param_targetStudent, PDO::PARAM_STR);
            $stmt->bindParam(":rubricDate", $param_rubricDate, PDO::PARAM_STR);
            // Set parameters
            $param_studentID = trim($studentID);
            $param_targetStudent = trim($targetStudent);
            $param_rubricDate = trim($rubricDate);
            // Attempt to execute the prepared statement
            $stmt->execute();
            return "Rubric has been removed to student:" . $this->getStudentName($studentID) . " for student: " .$this->getStudentName($targetStudent);
        } else {
            return "There was an error accessing the database. Please try again.";
        }
        // Close statement
        unset($stmt);
        // Close connection
        unset($pdo);
    }
}
