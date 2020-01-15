<?php


class Criteria
{
    protected $_criteria_ID, $_criteria_text,$_criteria_Value;

    public function __construct($criteria_row)
    {
        $this->_criteria_ID = $criteria_row['criteriaID'];
        $this->_criteria_text = $criteria_row['criteriaText'];
<<<<<<< HEAD
        //$this->_criteria_Value=$criteria_row['criteriaValue'];
=======
       // $this->_criteria_Value=$criteria_row['criteriaValue'];
>>>>>>> 10788c1a240bd0ed812039854a82a11689ef8f39
    }

    /**
     * @return mixed
     */
    public function getCriteriaID()
    {
        return $this->_criteria_ID;
    }

    /**
     * @return mixed
     */
    public function getCriteriaText()
    {
        return $this->_criteria_text;
    }

    /**
     * @return mixed
     */
    public function getCriteriaValue()
    {
        return $this->_criteria_Value;
    }
}