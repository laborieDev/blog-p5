<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class UserController
{
    private $sessionObject;
    private $twig;
    private $postRepo;
    private $catRepo;
    private $commentRepo;
    private $userRepo;

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
     * @return twigRender Dashboard of Users
     */
    public function getDashboardUsers()
    {
        $users = $this->userRepo->getUsers();

        return $this->twig->render('admin/all_users.html.twig',[
            'users' => $users
        ]);
    }

    /**
     * Page for to create or edit a user
     * @param int idUserEdit = -1 when this function is called for create an user
     * @return twigRender New User Form
     */
    public function setUserPage($idUserEdit = -1)
    {
        if ($idUserEdit != -1) {
            $user = $this->userRepo->getUser($idUserEdit);

            if ($user == false) {
                return $this->twig->render('website/errors_page.html.twig', [
                    "error" => "Cet utilisateur n'existe pas !"
                ]);
            }
            
            return $this->twig->render('admin/set_user.html.twig', [
                    'userEdit' => $user
            ]);
        }     

        return $this->twig->render('admin/set_user.html.twig');
    }

    /*** AJAX REQUEST ***/

    /**
     * AJAX -- Add New user
     * @return string Ajax response
     */
    public function addNewUser()
    {
        $lastName = filter_input(INPUT_POST, 'lastname');
        $firstName = filter_input(INPUT_POST, 'firstname');
        $userType = filter_input(INPUT_POST, 'usertype');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        if ((!isset($lastName)) || (!isset($firstName)) || (!isset($userType)) || (!isset($email)) || (!isset($password))) {
            return "Une erreur est survenue !";
        }

        if ($this->userRepo->emailExists($email)) {
            return "Attention ! Cet email est déjà asssocié à un utilisateur !";
        }

        $user = $this->userRepo->newUser();
        $user->setLastName(filter_input(INPUT_POST, 'lastname'));
        $user->setFirstName(filter_input(INPUT_POST, 'firstname'));
        $user->setEmail(filter_input(INPUT_POST, 'email'));
        $user->setPassword(filter_input(INPUT_POST, 'password'));
        $user->setUserType(filter_input(INPUT_POST, 'usertype'));
        $this->userRepo->updateUser($user);

        return "Added";
    }

    /**
     * AJAX -- Edit user
     * @param int User's ID
     * @return string Ajax response
     */
    public function editUser($userID)
    {
        $lastName = filter_input(INPUT_POST, 'lastname');
        $firstName = filter_input(INPUT_POST, 'firstname');
        $userType = filter_input(INPUT_POST, 'usertype');
        $password = filter_input(INPUT_POST, 'password');

        if ((!isset($lastName)) || (!isset($firstName)) || (!isset($userType))) {
            return "Error";
        }
          
        $user = $this->userRepo->getUser($userID);
        $user->setLastName($lastName);
        $user->setFirstName($firstName);
        $user->setUserType($userType);

        if (isset($password)) {
            $user->setPassword($password);
        }

        $this->userRepo->updateUser($user);

        return "Edited";
    }

    /**
     * AJAX -- Delete User
     * @param int userID
     * @return JSON Ajax response
     */
    public function deleteUser($userID)
    {
        if ($userID == $this->sessionObject->getVariable('userID')) {
            http_response_code(500);
            return json_encode(array('message' => "Vous ne pouvait pas supprimé votre propre utilisateur !"));
        }

        $user = $this->userRepo->getUser($userID);

        if ($user == "") {
            return "Error";
        }

        try{
            $allPosts = $this->userRepo->getAllPosts($user);

            foreach ($allPosts as $postID) {
                $post = $this->postRepo->getPost($postID);
                $this->postRepo->deletePost($post);
            }

            $this->userRepo->deleteUser($user);
            http_response_code(200);
            $message = "L'utilisateur a bien été supprimé !";
        } catch (\Exception $e) {
            http_response_code(500);
            $message =  "Attention : " . $e->getMessage();
        }

        return json_encode(array('message' => $message));
    }

    /****** GET ERROR PAGE  ****/
    public function getUserTypeError()
    {
        return $this->twig->render('website/errors_page.html.twig', [
            "error" => "Vous n'êtes pas autorisé à accéder ici !"
        ]);
    }

}
