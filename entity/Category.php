<?php

class Category{
    private $id;
    private $name;


    public function getID()
    {
        return $this->id;
    }

    public function setID($new)
    {
        $this->id = $new;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($new)
    {
        $this->name = $new;
    }
    
}