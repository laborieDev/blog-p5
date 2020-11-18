<?php

class Post{
    public $id;
    public $title;
    public $extract;
    public $content;
    public $img;
    public $addAt;
    public $lastEditAt;
    public $author;


    public function getID()
    {
        return $this->id;
    }

    public function setID($new)
    {
        $this->id = $new;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($new)
    {
        $this->title = $new;
    }
    
    public function getExtract()
    {
        return $this->extract;
    }

    public function setExtract($new)
    {
        $this->extract = $new;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($new)
    {
        $this->content = $new;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($new)
    {
        $this->img = $new;
    }

    public function getAddAt()
    {
        return $this->addAt;
    }

    public function setAddAt($new)
    {
        $this->addAt = $new;
    }

    public function getLastEditAt()
    {
        return $this->lastEditAt;
    }

    public function setLastEditAt($new)
    {
        $this->lastEditAt = $new;
    }
    
    public function getAuthor()
    {
        return $this->author;
    }
    
    public function setAuthor($new)
    {
        $this->author = $new;
    }
}
