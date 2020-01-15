<?php


class ClassInfoData
{
    private $classID, $className;

    public function __construct($classInfoArray)
    {
        //Class fields declaration
        $this->classID = $classInfoArray['classID'];
        $this->className = $classInfoArray['className'];
    }

    /**
     * @return mixed
     */
    public function getClassID()
    {
        return $this->classID;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }
}