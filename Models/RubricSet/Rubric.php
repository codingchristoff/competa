<?php


class Rubric
{

    protected $_rubric_ID, $_rubric_name;

    public function __construct($criteria_row)
    {
        $this->_rubric_ID = $criteria_row['rubricID'];
        $this->_rubric_name = $criteria_row['rubricName'];

    }

    /**
     * @return mixed
     */
    public function getRubricID()
    {
        return $this->_rubric_ID;
    }

    /**
     * @return mixed
     */
    public function getRubricName()
    {
        return $this->_rubric_name;
    }
}