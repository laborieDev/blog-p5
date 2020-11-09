<?php
include_once("modele/ClassPdo.php");
include_once("entity/Comment.php");

class CommentRepository extends ClassPdo
{

    public  static function getClassPdo()
    {
		if(ClassPdo::$monClassPdo==null){
			ClassPdo::$monClassPdo= new PostRepository();
        }
        
		return ClassPdo::$monClassPdo;
    }

    public function getComments()
    {
        $req = "SELECT id FROM comment";
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetchAll();

        $allComments = [];

        foreach($value as $comment){
            array_push($allComments, $this->getComment($comment['id']));
        }

        return $allComments;
    }

    public function getComment($id)
    {
        $req = "SELECT * FROM comment WHERE id = $id";
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetch();

        $comment = new Comment();
        $comment->setID($value['id']);
        $comment->setAuthorName($value['author_name']);
        $comment->setContent($value['content']);
        $comment->setCommentStatus($value['comment_status']);
        $comment->setAddAt($value['addAt']);
        $comment->setPost($value['id_post']);

        return $comment;
    }
    
    public function newComment($postID)
    {
        $req = "INSERT INTO comment(author_name, content, comment_status, add_at, id_blog_post) VALUES ('', '', 'waiting', NOW(), $postID)";
        $rs = ClassPdo::$monPdo->query($req);

        $req = "SELECT id, add_at, comment_status, id_blog_post FROM comment WHERE id = (SELECT MAX(id) FROM comment)";
        $rs = ClassPdo::$monPdo->query($req);
        $value = $rs->fetch();

        $comment = new Comment();
        $comment->setID($value['id']);
        $comment->setAddAt($value['add_at']);
        $comment->setCommentStatus($value['comment_status']);
        $comment->setPost($value['id_blog_post']);

        return $comment;
    }


    public function updateComment($comment)
    {
        $id = $comment->getID();
        $authorName = $comment->getAuthorName();
        $content = $comment->getContent();
        $commentStatus = $comment->getCommentStatus();

        $req = "UPDATE comment SET author_name = '$authorName', content = '$content', comment_status = '$commentStatus' WHERE id = $id ";
        ClassPdo::$monPdo->query($req);
    }

    public function deleteComment($comment){
        $id = $comment->getID();
        $req = "DELETE FROM comment WHERE id=$id";
        ClassPdo::$monPdo->query($req);
    }
}
?>