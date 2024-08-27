<?php if (isset($_GET['logout'])) {
    $userAuth->logout();
    header("Location: index.php"); // Redirect to self to avoid showing logout message after refresh
    exit();
}
?>