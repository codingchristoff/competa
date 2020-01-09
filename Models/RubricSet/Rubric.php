<?php


class Rubric
{
    protected $_rubric_ID, $_category_ID, $_criteria_ID;

    public function __construct($_rubric_data)
    {
        $this->_rubric_ID = $_rubric_data['rubricID'];
    }
}