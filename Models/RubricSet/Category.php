<?php


class Category
{
    protected $_category_ID, $_category_text, $criteria = [];

    public function __construct($category_row)
    {
        $this->_category_ID = $category_row['categoryID'];
        $this->_category_text = $category_row['categoryText'];
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

    /**
     * @return array
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * @param array $criteria
     */
    public function setCriteria($criteria)
    {
        $this->criteria = $criteria;
    }

    /**
     * @param array $criteria
     */
    public function addCriteria($criteria)
    {
        $this->criteria[] = $criteria;
    }
}