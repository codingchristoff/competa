<?php


class Categories
{
    protected $_category_ID, $_category_text, $criteria=[];

    public function __construct($category_row)
    {
        $this->_category_ID = $category_row['criteriaID'];
        $this->_category_text = $category_row['criteriaText'];
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