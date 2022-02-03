<?php 

// Kick the user out after 4 hours of inactivity
if (isset($_SESSION['lastActivity']) && (time() - $_SESSION['lastActivity'] > 4*60*60)) { // Four hours 
    header("Location: index.php?logout");
}
$_SESSION['lastActivity'] = time();

// See if the user is an admin
if (isset($_SESSION['userType']) && $_SESSION['userType'] == "Admin"){
    $isAdmin="True";
}
else{
    $isAdmin="False";
}

// Set the active page in the nav bar
$navHomeActive = "";
$navHomeSpan = "";
$navStatsActive = "";
$navStatsSpan = "";
if (isset($_GET['stats'])) {
    $navStatsActive = "active";
}
else {
    $navHomeActive = "active";
}

?>

<!doctype html>
<html lang="en">

<head>
    <title><?php echo str_replace("'","\'",$config['title']); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<head>

<body id="main">

<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/logo.png"  height="35" class="d-inline-block align-top" alt="">
            <!-- <strong><?php echo str_replace("'","\'",$config['title']); ?></strong> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php   if ($loggedIn == "True") { ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $navHomeActive;?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $navStatsActive;?>" href="index.php?stats">Stats</a>
                </li>
        <?php   } ?>
            </ul>
        <?php if ($loggedIn == "True") { ?>
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-ite dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill"></i> &nbsp;<?php echo $_SESSION["firstName"]. " ". $_SESSION["lastName"]; ?>
                    </a>
                    <ul class="dropdown-menu navbar-dark bg-primary" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="nav-link dropdown-item active" href="index.php?logout">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        <?php   } ?>
        </div>
    </div>
</nav>
