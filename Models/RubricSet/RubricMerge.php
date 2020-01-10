<?php


class RubricMerge
{
    protected $_rubric_ID, $_category_ID, $_criteria_ID;

    public function __construct($_merge_row)
    {
        $this->_rubric_ID = $_merge_row['rubricID'];
        $this->_category_ID=$_merge_row['categoryID'];
        $this->_criteria_ID=$_merge_row['criteriaID'];
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
    public function getCategoryID()
    {
        return $this->_category_ID;
    }

    /**
     * @return mixed
     */
    public function getCriteriaID()
    {
        return $this->_criteria_ID;
    }
}