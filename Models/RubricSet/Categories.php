<?php


class Categories
{

    protected $_category_ID, $_category_text;

    public function __construct($criteria_data)
    {
        $this->_category_ID = $criteria_data['criteriaID'];
        $this->_category_text = $criteria_data['criteriaText'];
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
    public function getCategoryText()
    {
        return $this->_category_text;
    }

}