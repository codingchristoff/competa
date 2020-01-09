<?php


class Criteria
{
    protected $_criteria_ID, $_criteria_text;

    public function __construct($criteria_data)
    {
        $this->_criteria_ID = $criteria_data['criteriaID'];
        $this->_criteria_text = $criteria_data['criteriaText'];
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