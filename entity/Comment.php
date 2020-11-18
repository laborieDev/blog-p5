<?php

class Comment{
    private $id;
    private $authorName;
    private $content;
    private $commentStatus;
    private $addAt;
    private $post;

    /**
     * @return int comment's id
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
     * @return string name of comment's author
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param string new New Author Name
     */
    public function setAuthorName($new)
    {
        $this->authorName = $new;
    }

    /**
     * @return string comment's content
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
     * @return string comment's status
     */
    public function getCommentStatus()
    {
        return $this->commentStatus;
    }

    /**
     * @param string new New Comment's Status
     */
    public function setCommentStatus($new)
    {
        $this->commentStatus = $new;
    }

    /**
     * @return Date Date of this comment has been created
     */
    public function getAddAt()
    {
        return $this->addAt;
    }

    /**
     * @param Date new Date of this comment has been created
     */
    public function setAddAt($new)
    {
        $this->addAt = $new;
    }

    /**
     * @return Post comment's post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param Post new New Comment's Post
     */
    public function setPost($new)
    {
        $this->post = $new;
    } 
}
