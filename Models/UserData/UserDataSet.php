<?php

require_once('Models/Database.php');
require_once('Models/UserData/UserData.php');
require_once('Models/UserData/AdminData.php');
require_once('Models/UserData/TeacherData.php');
require_once('Models/UserData/StudentData.php');

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

        //Gets a student user
        if ($userType === 's')
        {
            //SQL statement will select a specific user
            $sqlQuery = 'SELECT * FROM students WHERE userName="' . $userName . '"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement

            $row = $statement->fetch();
            return new StudentData($row);;
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
        if ($row != null)
        {
            return new AdminData($row);
        }

        //SQL statement will get a user with a specific variable in teachers
        $sqlQuery = 'SELECT * FROM teachers WHERE ' . $typeClean . '="' . $variableClean . '";';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $row = $statement->fetch();

        //Check if anything was found in the database for teachers
        if ($row != null)
        {
            return new TeacherData($row);
        }

        //SQL statement will get a user with a specific variable in students
        $sqlQuery = 'SELECT * FROM students WHERE ' . $typeClean . '="' . $variableClean . '";';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $row = $statement->fetch();

        //Check if anything was found in the database for teachers
        if ($row != null)
        {
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

        //Temporarily sets loginError in case login fails
        $this->loginError = True;

        //Checks if the userName exists
        if ($user != null)
        {
            //Checks password to see if it matches for the userName
            if (password_verify($passClean, $user->getPassword()))
            {
                return $user;
            }
            else {
                return null;
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

    //Gets classID
    public function fetchClassID($className)
    {
        $sqlQuery = 'SELECT classID FROM classes WHERE className="' . $className .'"';

        $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        return $statement->fetch();
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
            $dataSet[] = $row;
        }
        return $dataSet;
    }

    //Create user by adding to the database
    public function createUser($user)
    {
        //Cleans up input
        $userNameClean = $this->cleanInput($user->getUserName());
        $firstNameClean = $this->cleanInput($user->getFirstName());
        $lastNameClean = $this->cleanInput($user->getLastName());
        $emailClean = $this->cleanInput($user->getEmail());
        $passwordClean = $this->cleanInput($user->getPassword());

        //Encrypts the password using the Crypt_Blowfish algorithm
        $passwordClean = password_hash($passwordClean,PASSWORD_BCRYPT);

        //Gets the first letter of the userName and puts it to lowercase
        $userType = strtolower(substr($userNameClean, 0,1));

        //Checks if user should be put into the student table
        if ($userType === 's')
        {
            $classIDClean = $this->cleanInput($user->getClassID());
            //SQL statement that will be inserted into the database
            $sqlQuery = 'INSERT INTO students (firstName, lastName, userName, email, password, roleID, classID) VALUES ("' . $firstNameClean . '", "' . $lastNameClean . '", "' . $userNameClean . '", "' . $emailClean . '", "' . $passwordClean . '", "3", "' . $classIDClean .'");';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        //Checks if user should be put into the teacher table
        else if($userType === 't')
        {
            $classIDClean = $this->cleanInput($user->getClassID());
            //SQL statement that will be inserted into the database
            $sqlQuery = 'INSERT INTO teachers (firstName, lastName, userName, email, password, roleID, classID) VALUES ("' . $firstNameClean . '", "' . $lastNameClean . '", "' . $userNameClean . '", "' . $emailClean . '", "' . $passwordClean . '", "2", "' . $classIDClean .'");';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        //Checks if user should be put into the admin table
        else if($userType === 'a')
        {
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
        $userType = strtolower(substr($userName, 0,1));

        //Checks if user should be removed from student table
        if ($userType === 's')
        {
            //SQL statement that will delete a student
            $sqlQuery = 'DELETE FROM students WHERE userName="' . $userClean .'";';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        //Checks if user should be removed from teacher table
        else if($userType === 't')
        {
            //SQL statement that will delete a student
            $sqlQuery = 'DELETE FROM teachers WHERE userName="' . $userClean .'";';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        //Checks if user should be removed admin table
        else if($userType === 'a')
        {
            //SQL statement that will delete a student
            $sqlQuery = 'DELETE FROM admins WHERE userName="' . $userClean .'";';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
    }

    //Edits a student
    public function editUser($user)
    {

        //Cleans up input
        $userNameClean = $this->cleanInput($user->getUserName());
        $firstNameClean = $this->cleanInput($user->getFirstName());
        $lastNameClean = $this->cleanInput($user->getLastName());
        $emailClean = $this->cleanInput($user->getEmail());
        $passwordClean = $this->cleanInput($user->getPassword());

        //Encrypts the password using the Crypt_Blowfish algorithm
        $passwordClean = password_hash($passwordClean,PASSWORD_BCRYPT);

        //Gets the first letter of the userName and puts it to lowercase
        $userType = strtolower(substr($userNameClean, 0,1));

        //Checks if user should be removed from students table
        if ($userType === 's')
        {
            $classIDClean = $this->cleanInput($user->getClassID());
            //SQL statement that will edit a user
            $sqlQuery = 'UPDATE students SET firstName="' . $firstNameClean .'", lastName="' . $lastNameClean.'", email="' . $emailClean.'", password="' . $passwordClean.'", classID="' . $classIDClean.'" WHERE userName="' . $userNameClean.'"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        //Checks if user should be removed from teachers table
        else if ($userType === 't')
        {
            $classIDClean = $this->cleanInput($user->getClassID());
            //SQL statement that will edit a user
            $sqlQuery = 'UPDATE teachers SET firstName="' . $firstNameClean .'", lastName="' . $lastNameClean.'", email="' . $emailClean.'", password="' . $passwordClean.'", classID="' . $classIDClean.'" WHERE userName="' . $userNameClean.'"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
        //Checks if user should be removed from admins table
        else if ($userType === 'a')
        {
            //SQL statement that will edit a user
            $sqlQuery = 'UPDATE admins SET firstName="' . $firstNameClean .'", lastName="' . $lastNameClean.'", email="' . $emailClean.'", password="' . $passwordClean.'" WHERE userName="' . $userNameClean.'"';

            $statement = $this->dbHandle->prepare($sqlQuery); // prepare a PDO statement
            $statement->execute(); // execute the PDO statement
        }
    }

    //Sets a students tableGroup
    public function setTableGroup($user)
    {
        //Cleans up input
        $userNameClean = $this->cleanInput($user->getUserName());
        $tableGroupClean = $this->cleanInput($user->getTableGroup());

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
}