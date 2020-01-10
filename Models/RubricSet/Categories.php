<?php


class Categories
{

    protected $_category_ID, $_category_text;

    public function __construct($criteria_row)
    {
        $this->_category_ID = $criteria_row['criteriaID'];
        $this->_category_text = $criteria_row['criteriaText'];
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