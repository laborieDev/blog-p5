<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class CommentController
{
    private $sessionObject;
    private $twig;
    private $postRepo;
    private $catRepo;

    public function __construct()
    {
        $this->sessionObject = new SessionObject;
        $this->twig = new Environment(new FilesystemLoader('templates'));
        $this->twig->addGlobal('session', $this->sessionObject->getAll());
        $this->postRepo = new PostRepository;
        $this->catRepo = new CategoryRepository;
        $this->commentRepo = new CommentRepository;
        $this->userRepo = new UserRepository;
    }

    /**
     * @return twigRender all comments
     */
    public function getAllComments()
    {
        $comments = $this->commentRepo->getComments(10);

        return $this->twig->render('admin/all_comments.html.twig', [
            'comments' => $comments
        ]);
    }

    /**
     * AJAX -- See More Comments on Dashboard
     * @param int nbPage
     * @return JSON Ajax response
     */
    function seeMoreDashboardComments($nbPage)
    {
        $comments = $this->commentRepo->getComments(10, $nbPage);
        $allMinID = $this->commentRepo->getCommentMinID();

        $section = "";
        $i = 1;
        $minID = $allMinID;
        foreach ($comments as $comment) {
            $id = $comment->getID();
            $status = $comment->getCommentStatus();
            $authorName = $comment->getAuthorName();
            $content = $comment->getContent();
            $addAt = date_create($comment->getAddAt());
            $addAt = date_format($addAt,"d.m.Y");
            $postID = $comment->getPost();
            switch ($status) {
                case "isValid":
                    $statusMessage = "Validé";
                    $statusClass = "valid";
                    break;
                case "waiting":
                    $statusMessage = "En attente";
                    $statusClass = "waiting";
                    break;
                case "isReject":
                    $statusMessage = "Rejeté";
                    $statusClass = "reject";
                    break;
            }

            $section .= "
                <tr id=\"row-post-$id\">
                  <th scope=\"row\">$addAt</th>
                  <td class=\"statut-cell $statusClass\">$statusMessage</td>
                  <td class=\"author-cell\">$authorName</td>
                  <td class=\"content-cell\">$content</td>
                  <td class=\"buttons-cell\">
                    <a class=\"see\" href=\"../article/$postID\" target=\"_blank\"><i class=\"lni lni-eye\"></i></a>
                    <a class=\"see\" onclick=\"setThisComment($id, '$status')\" href=\"#\"><i class=\"lni lni-pencil-alt\"></i></a>
                    <a class=\"delete\" onclick=\"getDeleteModal($id)\" href=\"#\"><i class=\"lni lni-trash\"></i></a>
                  </td>
                </tr>
            ";
            $i++;
            $minID = $id;
        }
        $nbPage ++;

        if ($allMinID == $minID) {
            return json_encode(array('data' => $section, 'nbPage' => -1));
        } else { 
            return json_encode(array('data' => $section, 'nbPage' => $nbPage));
        }
    }

    /**
     * @param int id of comment
     * @param string new status of comment
     * @param boolean returnDatas is true if a comments list is return
     * @return twigRender all comments which isWaiting
     */
    public function setCommentStatus($id, $newStatus, $returnDatas)
    {
        $comment = $this->commentRepo->getComment($id);
        $comment->setCommentStatus($newStatus);
        $this->commentRepo->updateComment($comment);

        if ($returnDatas == "true") {
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
        } else {
            $section = "";
            $message = "Le commentaire a bien été modifié !";
        }

        return json_encode(array('data' => $section, 'message' => $message));
    }

    /**
     * @param int id of comment
     * @return twigRender alert message
     */
    public function deleteComment($id)
    {
        $comment = $this->commentRepo->getComment($id);

        if ($comment == "") {
            return json_encode(array('message' => "Le commentaire n'existe pas !"));
        }

        try{
            $this->commentRepo->deleteComment($comment);
            $message = "Le commentaire a bien été supprimé !";
        } catch (\Exception $e) {
            http_response_code(500);
            $message =  "Attention : " . $e->getMessage();
        }

        return json_encode(array('message' => $message));
    }
}
