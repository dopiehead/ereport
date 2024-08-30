<?php 
     class Session
{
    public function __construct()
    {
        session_start(); // Start the session when the object is created
    }

    // Check if the user is logged in
    public function checkLogin()
    {
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
            $this->redirectToSignIn();
        }
    }

    // Redirect to the sign-in page
    private function redirectToSignIn()
    {
        header("Location: ../sign-in.php");
        exit;
    }
}
?>


