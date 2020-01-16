<?php

require_once('Models/UserData/UserData.php');

class  AdminData extends UserData
{
    protected $_adminID;

    public function __construct($user_data)
    {
        parent::__construct($user_data);
        $this->_adminID = $user_data['adminID'];
    }

    public function getAllUsers()
    {
        //Creating UserDataSet object to initiate link to database
        $userDataSet = new UserDataSet();

        //Fetching all of the students
        $studentArray = $userDataSet->fetchAllStudents();

        //Fetching all of the teachers
        $teacherArray = $userDataSet->fetchAllTeachers();

        //Creating an array to store all the teacher objects and all of the student objects TOGETHER
        $teacherAndStudentArray = array_merge($studentArray, $teacherArray);

        //Returns one array with student and teacher objects
        return $teacherAndStudentArray;
    }

    /**
     * This function takes in data for the user and creates a new user object
     *
     * @param $userData is an array containing all the data the for the new user
     *
     */
    public function addUser($userData)
    {
        //Creates a UserData object for easy access of the users information (firstname, lastname, etc.)
        $tempUser = new UserData($userData);

        //Creating UserDataSet object to initiate link to database
        $userDataSet = new UserDataSet();

        //Storing the UserData object's fields (firstname, lastname, etc.)
        $userDataSet->createUser($tempUser->getFirstName(), $tempUser->getLastName(), $tempUser->getUsername(), $tempUser->getEmail(), $tempUser->getPassword());

    }

    //Need deleteUser function from UserDataSet
    public function deleteUser()
    {
        return ;
    }

    /**
     * @param $userObjct -> the userData object
     * @param $newClass -> the new class the user is being assigned to
     */
    public function setUserClass($userObject, $newClass)
    {
        //Calls the function in student to change
        $userObject->setClass($newClass);
    }

    //Needs rubric class to be complete and function in UserDataSet
    public function createRubric()
    {
        return ;
    }

    //Needs rubric class to be complete and function in UserDataSet
    public function editRubric()
    {
        return ;
    }

    //Needs rubric class to be complete and function in UserDataSet
    public function deleteRubric()
    {
        return ;
    }

    //Needs rubric class to be complete and function in UserDataSet
    public function getUserID()
    {
        return $this->_adminID;
    }
}