<?php

require_once('Models/Database.php');
require_once('Models/UserData/UserData.php');

class UserDataSet
{
    protected $dbHandle, $dbInstance;

    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getdbConnection();
    }

    //Checks the database for a specified user
    public function fetchUser($userName)
    {
        //Gets the first letter of the userName and puts it to lowercase
        $userType = strtolower(strcmp(substr($userName, 0,1)));

        //Gets a student user
        if (strcmp($userType, 's'))
        {
            //SQL statement will select a specific user
            $sqlQuery = 'SELECT * FROM students WHERE userName="' . $userName . '"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            $row = $statement->fetch();
            return new StudentData($row);
        }
        //Gets a teacher user
        else if(strcmp($userType, 't'))
        {
            //SQL statement will select a specific user
            $sqlQuery = 'SELECT * FROM teachers WHERE userName="' . $userName . '"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            $row = $statement->fetch();
            return new TeacherData($row);
        }
        //Gets an admin user
        else if (strcmp($userType, 'a'))
        {
            //SQL statement will select a specific user
            $sqlQuery = 'SELECT * FROM admins WHERE userName="' . $userName . '"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            $row = $statement->fetch();
            return new AdminData($row);
        }
    }

    //Create user by adding to the database
    public function createUser($firstName, $lastName, $userName, $email, $password, $roleID)
    {
        //Encrypts the password using the Crypt_Blowfish algorithm
        $password = password_hash($password,PASSWORD_BCRYPT);

        //Gets the first letter of the userName and puts it to lowercase
        $userType = strtolower(strcmp(substr($userName, 0,1)));

        //Checks if user should be put into the student table
        if (strcmp($userType, 's'))
        {
            //SQL statement that will be inserted into the database
            $sqlQuery = 'INSERT INTO students (firstName, lastName, userName, email, password, roleID) VALUES ("' . $firstName . '", "' . $lastName . '", "' . $userName . '", "' . $email . '", "' . $password. '", "' . $roleID.'");';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        //Checks if user should be put into the teacher table
        else if(strcmp($userType, 't'))
        {
            //SQL statement that will be inserted into the database
            $sqlQuery = 'INSERT INTO teachers (firstName, lastName, userName, email, password, roleID) VALUES ("' . $firstName . '", "' . $lastName . '", "' . $userName . '", "' . $email . '", "' . $password. '", "' . $roleID.'");';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        //Checks if user should be put into the admin table
        else if(strcmp($userType, 'a'))
        {
            //SQL statement that will be inserted into the database
            $sqlQuery = 'INSERT INTO admins (firstName, lastName, userName, email, password, roleID) VALUES ("' . $firstName . '", "' . $lastName . '", "' . $userName . '", "' . $email . '", "' . $password. '", "' . $roleID.'");';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
    }

}