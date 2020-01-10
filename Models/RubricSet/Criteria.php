<?php


class Criteria
{
    protected $_criteria_ID, $_criteria_text;

    public function __construct($criteria_row)
    {
        $this->_criteria_ID = $criteria_row['criteriaID'];
        $this->_criteria_text = $criteria_row['criteriaText'];
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
}