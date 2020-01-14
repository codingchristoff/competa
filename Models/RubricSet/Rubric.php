<?php


class Rubric
{
    protected $_rubric_ID, $_rubric_name, $categories=[];

    public function __construct($rubric_row)
    {
        $this->_rubric_ID = $rubric_row['rubricID'];
        $this->_rubric_name = $rubric_row['rubricName'];
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

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }
}