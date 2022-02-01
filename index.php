<?php
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/submit.php';
include 'includes/header.php';
include 'includes/footer.php';

// Show the login page
if(isset($_GET['login'])) {
    include 'includes/login.php';
}

// Show the stats page if they're an admin and the page is requested
elseif(isset($_GET['stats']) && $_SESSION['userType'] == "Admin"){
    include 'includes/stats.php';
}

// Show the userhome page if they're an admin and the page is requested
elseif(isset($_GET['userhome']) && $_SESSION['userType'] == "Admin"){
    include 'includes/userhome.php';
}

// Show the admin page if they're an admin and no page is requested
elseif($_SESSION['userType'] == "Admin"){
    include 'includes/admin.php';
}

// If the user's not an admin and they signed in send them to the user home
else {
    include 'includes/userhome.php';
}
?>