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
    <link rel="stylesheet" href="assets/sidebars.css">
    <script src="/assets/sidebars.js"></script>
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<head>

<body id="main">