<h1>Stats Page</h1>
<br/>
<?php echo getActiveDeviceCount(); ?> active devices in the database. <br />
<?php echo getActivePeopleCount(); ?> active people in the database. <br />
<?php echo getActiveAssignmentCount(); ?> active assignments in the database. <br />

<?php

    $countHistoryArray = getCountHistory(0);

    foreach ($countHistoryArray as $key => $value) {
        echo $key." - ".$value."<br />";
    }

?>