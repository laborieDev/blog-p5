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


    /**
     * @return int post's id
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
     * @return string post's title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string new New Title
     */
    public function setTitle($new)
    {
        $this->title = $new;
    }
    
    /**
     * @return string post's extract
     */
    public function getExtract()
    {
        return $this->extract;
    }

    /**
     * @param string new New Extract
     */
    public function setExtract($new)
    {
        $this->extract = $new;
    }

    /**
     * @return string post's content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string new New Content
     */
    public function setContent($new)
    {
        $this->content = $new;
    }

    /**
     * @return string post's img url
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string new New Img Url
     */
    public function setImg($new)
    {
        $this->img = $new;
    }

    /**
     * @return Date Date of this post has been created
     */
    public function getAddAt()
    {
        return $this->addAt;
    }

    /**
     * @param Date Date of this post has been created
     */
    public function setAddAt($new)
    {
        $this->addAt = $new;
    }

    /**
     * @return Date Date of this post has been edited
     */
    public function getLastEditAt()
    {
        return $this->lastEditAt;
    }

    /**
     * @param Date Date of this post has been edited
     */
    public function setLastEditAt($new)
    {
        $this->lastEditAt = $new;
    }
    
    /**
     * @return User Post's Author
     */
    public function getAuthor()
    {
        return $this->author;
    }
    
    /**
     * @param User new New Post's Author
     */
    public function setAuthor($new)
    {
        $this->author = $new;
    }
}
