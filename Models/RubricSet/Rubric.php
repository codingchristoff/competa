<?php


class Rubric
{
    protected $_rubric_ID, $_rubric_name, $categories=[];

    public function __construct($rubricID,$rubricName)
    {
        $this->_rubric_ID = $rubricID;
        $this->_rubric_name = $rubricName;
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

    /**
     * @param array $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @param array $categories
     */
    public function addCategory($categories)
    {
        $this->categories[] = $categories;
    }


}