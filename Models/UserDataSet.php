<?php

require_once('Models/Database.php');
require_once('Models/UserData/UserData.php');

class UserDataSet
{
    protected $dbHandle, $dbInstance, $loginError;

    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getdbConnection();
    }

    //Checks the database for a specified user
    public function fetchUser($userName)
    {

        //Gets the first letter of the userName and puts it to lowercase
        $userType = strtolower(substr($userName, 0,1));
        echo $userType;
        //Gets a student user
        if ($userType === 's')
        {
            echo 'Hi';
            //SQL statement will select a specific user
            $sqlQuery = 'SELECT * FROM students WHERE userName="' . $userName . '"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            $row = $statement->fetch();
            return new StudentData($row);
        }
        //Gets a teacher user
        else if($userType === 't')
        {
            //SQL statement will select a specific user
            $sqlQuery = 'SELECT * FROM teachers WHERE userName="' . $userName . '"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            $row = $statement->fetch();
            return new TeacherData($row);
        }
        //Gets an admin user
        else if ($userType === 'a')
        {
            //SQL statement will select a specific user
            $sqlQuery = 'SELECT * FROM admins WHERE userName="' . $userName . '"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            $row = $statement->fetch();
            return new AdminData($row);
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

        //Temporarily sets loginError in case login fails
        $this->loginError = True;

        //Checks if the userName exists
        if ($user!=null)
        {
            //Checks password to see if it matches for the userName
            if (password_verify($passClean, $user->getPassword()))
            {
                //Saves the user information as a session
                return $user;
            }
            else {
                return false;
            }

        }
    }

    //Gets all students
    public function fetchAllStudents()
    {
        //SQL statement will select a specific user
        $sqlQuery = 'SELECT * FROM students';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Returns all students in an array
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new UserData($row);
        }
        return $dataSet;
    }

    //Gets all students
    public function fetchAllTeachers()
    {
        //SQL statement will select a specific user
        $sqlQuery = 'SELECT * FROM teachers';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        //Returns all teacher in an array
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new UserData($row);
        }
        return $dataSet;
    }

    //Create user by adding to the database
    public function createUser($firstName, $lastName, $userName, $email, $password)
    {
        //Cleans up input
        $firstName = $this->cleanInput($firstName);
        $lastName = $this->cleanInput($lastName);
        $email = $this->cleanInput($email);
        $userName = $this->cleanInput($userName);
        $password = $this->cleanInput($password);

        //Encrypts the password using the Crypt_Blowfish algorithm
        $password = password_hash($password,PASSWORD_BCRYPT);

        //Gets the first letter of the userName and puts it to lowercase
        $userType = strtolower(substr($userName, 0,1));

        //Checks if user should be put into the student table
        if (strcmp($userType, 's'))
        {
            //SQL statement that will be inserted into the database
            $sqlQuery = 'INSERT INTO students (firstName, lastName, userName, email, password, roleID) VALUES ("' . $firstName . '", "' . $lastName . '", "' . $userName . '", "' . $email . '", "' . $password. '", "3");';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        //Checks if user should be put into the teacher table
        else if(strcmp($userType, 't'))
        {
            //SQL statement that will be inserted into the database
            $sqlQuery = 'INSERT INTO teachers (firstName, lastName, userName, email, password, roleID) VALUES ("' . $firstName . '", "' . $lastName . '", "' . $userName . '", "' . $email . '", "' . $password. '", "2");';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        //Checks if user should be put into the admin table
        else if(strcmp($userType, 'a'))
        {
            //SQL statement that will be inserted into the database
            $sqlQuery = 'INSERT INTO admins (firstName, lastName, userName, email, password, roleID) VALUES ("' . $firstName . '", "' . $lastName . '", "' . $userName . '", "' . $email . '", "' . $password. '", "1");';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
    }

    //Remove student
    public function deleteUser($userName)
    {
        //Cleans up input
        $userClean = $this->cleanInput($userName);

        //SQL statement that will delete a user
        $sqlQuery = 'DELETE FROM watchList WHERE watchListID="' . $userClean .'";';

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
}