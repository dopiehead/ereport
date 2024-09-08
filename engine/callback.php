<?php

if (isset($_GET['url'])) {
    $url = $_GET['url'];
    echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
}

?>