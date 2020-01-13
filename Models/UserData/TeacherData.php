<?php

require_once('Models/UserData/UserData.php');

class TeacherData extends ClassData
{
    protected $_teacherID;

    /**
     * TeacherData constructor.
     */
    public function __construct($user_data)
    {
        parent::__construct($user_data);
        $this->_teacherID = $user_data['teacherID'];
    }

    public function getUserID()
    {
        return $this->_teacherID;
    }

    /**
     *  Requires DataSet to implement
     */
    public function assignTable()
    {
        return ;
    }

    /**
     *  Requires DataSet to implement
     */
    public function switchTable()
    {
        return ;
    }

    /**
     *  Requires DataSet to implement
     */
    public function startRound()
    {
        return ;
    }

    /**
     *  Requires DataSet to implement
     */
    public function viewAllRounds()
    {
        return ;
    }

    /**
     *  Requires DataSet to implement
     */
    public function publishRound()
    {
        return ;
    }

    /**
     * @return array
     * Gets an Array with all students
     */
    public function viewMyStudents()
    {
        $studentData = $this->_user_ds->fetchAllStudents();

        return $studentData;
    }

    /**
     *  Requires DataSet to implement
     */
    public function viewStudentScore()
    {
        return ;
    }

    /**
     *  Requires DataSet to implement
     */
    public function viewStudentGrading()
    {
        return;
    }

    /**
     *  Requires DataSet to implement
     */
    public function editRoundRubric()
    {
        return ;
    }
}