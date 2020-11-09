<?php

class Comment{
    private $id;
    private $authorName;
    private $content;
    private $commentStatus;
    private $addAt;
    private $post;


    public function getID()
    {
        return $this->id;
    }

    public function setID($new)
    {
        $this->id = $new;
    }

    public function getAuthorName()
    {
        return $this->authorName;
    }

    public function setAuthorName($new)
    {
        $this->authorName = $new;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($new)
    {
        $this->content = $new;
    }

    public function getCommentStatus()
    {
        return $this->commentStatus;
    }

    public function setCommentStatus($new)
    {
        $this->commentStatus = $new;
    }

    public function getAddAt()
    {
        return $this->addAt;
    }

    public function setAddAt($new)
    {
        $this->addAt = $new;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function setPost($new)
    {
        $this->post = $new;
    }
    
}