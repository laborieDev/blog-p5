<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class CommentController
{
    private $twig;
    private $postRepo;
    private $catRepo;

    public function __construct()
    {
        $this->twig = new Environment(new FilesystemLoader('templates'));
        $this->twig->addGlobal('session', $_SESSION);
        $this->postRepo = new PostRepository;
        $this->catRepo = new CategoryRepository;
        $this->commentRepo = new CommentRepository;
        $this->userRepo = new UserRepository;
    }

    /**
     * @return twigRender HomePage with all blog's categories and last posts
     */
    public function setCommentStatus($id, $newStatus)
    {
        $comment = $this->commentRepo->getComment($id);
        $comment->setCommentStatus($newStatus);
        $this->commentRepo->updateComment($comment);

        $newWaitingComments = $this->commentRepo->getWaitingComments();

        $section = "";

        foreach($newWaitingComments as $comment){
            $date = date_create($comment->getAddAt());
            $date = date_format($date,"d.m.Y");
            $author = $comment->getAuthorName();
            $content = $comment->getContent();
            $postID = $comment->getPost();
            $id = $comment->getID();
            $section .= "
            <tr>
                <th scope=\"row\">$date</th>
                <td class=\"author-cell\">$author</td>
                <td class=\"content-cell\">$content</td>
                <td class=\"buttons-cell\">
                  <a class=\"see\" href=\"./article/$postID\" target=\"_blank\"><i class=\"lni lni-eye\"></i></a>
                  <a class=\"valid\" onclick=\"setThisComment('isValid',$id)\" href=\"#\"><i class=\"lni lni-checkmark\"></i></a>
                  <a class=\"delete\" onclick=\"setThisComment('isReject',$id)\" href=\"#\"><i class=\"lni lni-ban\"></i></a>
                </td>
            </tr>
            ";
        }

        if ($newStatus == "isValid") {
            $message = "Le commentaire a bien été validé !";
        } else {
            $message = "Le commentaire a bien été rejeté !";
        }

        return json_encode(array('data' => $section, 'message' => $message));
    }
}
