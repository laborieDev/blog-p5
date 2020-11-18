<?php

class Category{
    private $id;
    private $name;

    /**
     * @return int category's id
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * @param int new New ID
     */
    public function setID($new)
    {
        $this->id = $new;
    }

    /**
     * @return string category's name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string new New Name
     */
    public function setName($new)
    {
        $this->name = $new;
    } 
}
