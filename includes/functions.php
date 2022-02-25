<?php

// This file contains the functions needed for the site

function db_connect() {

    // Use this to connect to the database

    include 'includes/config.php';

    // Define connection as a static variable
    static $connection;

    // See if we're already connected to the database first
    if(!isset($connection)) {
        
        // Grab the settings from the config.ini file
        $config = parse_ini_file($configFile); 
        $connection = @mysqli_connect($config['servername'],$config['username'],$config['password'],$config['dbname']);
    }

    // Verify the connection was successful, if not send them to the setup page
    if($connection == FALSE) {
        echo "<script>";
        echo "window.location.href = \"index.php?setup\";";
        echo "</script>";
    }

    // Send back the connection
    return $connection;
}

function getActiveDeviceCount() {

    // This will return the number of active devices in the database

    // Connect to the database
    $connection = db_connect();

    // Get the number of active devices from the database
    $sql = "SELECT COUNT(ID) AS CountOfID FROM Devices WHERE Active=True;";
    $results = $connection->query($sql);

    // Return the data if found, otherwise return 0
    if ($results->num_rows > 0) {
        $row = $results->fetch_assoc();     
        return $row['CountOfID'];
    } 
    else {
        return 0;
    }
}

function getStudentsPerGrade(){

    // Input: None
    // Output: Associative array ['Role','Count']

    // Initialize variables
    $studentGradeArray = [];

    // Connect to the database
    $connection = db_connect();

    // Get the count of students per grade
    $sql = "SELECT Role,Count(ID) AS CountOfStudents FROM People WHERE Role>=2000 AND Active GROUP BY Role;";
    $results = $connection->query($sql);

    // If data is returned loop through it
    if ($results->num_rows > 0) {
        
        // Add data to the array
        while ($row=$results->fetch_assoc()) {
            $studentGradeArray += [strval($row['Role']) => $row['CountOfStudents']];
        }
    } 

    return $studentGradeArray;
}

function getCountHistory($role){

    // Input: Integer representing the role, where 0 is for total student count.
    // Output: Associative array ['Date','Count']

    // Initialize variables
    $countHistoryArray = [];

    // Connect to the database
    $connection = db_connect();

    // Get the count of students per grade
    $sql = "SELECT * FROM CountHistory WHERE Role=".$role.";";
    $results = $connection->query($sql);

    // If data is returned loop through it
    if ($results->num_rows > 0) {
        
        // Add data to the array
        while ($row=$results->fetch_assoc()) {
            $countHistoryArray += [strval($row['RecordedDate']) => $row['StudentCount']];
        }
    } 

    return $countHistoryArray;
}

function getGrade($year){
    $todayYear = date("Y");
    $todayMonth = date("m");
    $year = substr($year, -4);
    $classOf='';
    if ($todayMonth >= 7 && $todayMonth <= 12){
      $todayYear++;
    }
    $grade = 12 - ($year - $todayYear);
    if ($grade == 0){
      $classOf="Kindergarten";
    }
    elseif ($grade == 1){
      $classOf=$grade."st Grade";
    }
    elseif ($grade == 2){
      $classOf=$grade."nd Grade";
    }
    elseif ($grade == 3){
      $classOf=$grade."rd Grade";
    }
    else{
      $classOf=$grade."th Grade";
    }
    return $classOf;
  }
 
 function reverseGetGrade($grade){
    $todayYear = date("Y");
    $todayMonth = date("m");
    $todayDay = date("d");
    if ($todayMonth >= 7 && $todayMonth <=12){
      $todayYear++;
    }
    if ($grade == "12th Grade"){
       return ($todayYear-1)."-".$todayYear;
    }else if ($grade == "11th Grade"){
       return $todayYear."-".($todayYear+1);
    } else if ($grade == "10th Grade"){
       return ($todayYear+1)."-".($todayYear+2);
    } else if ($grade == "9th Grade"){
       return ($todayYear+2)."-".($todayYear+3);
    } else if ($grade == "8th Grade"){
       return ($todayYear+3)."-".($todayYear+4);
    } else if ($grade == "7th Grade"){
       return ($todayYear+4)."-".($todayYear+5);
    } else if ($grade == "6th Grade"){
       return ($todayYear+5)."-".($todayYear+6);
    } else if ($grade == "5th Grade"){
       return ($todayYear+6)."-".($todayYear+7);
    } else if ($grade == "4th Grade"){
       return ($todayYear+7)."-".($todayYear+8);
    } else if ($grade == "3rd Grade"){
       return ($todayYear+8)."-".($todayYear+9);
    } else if ($grade == "2nd Grade"){
       return ($todayYear+9)."-".($todayYear+10);
    } else if ($grade == "1st Grade"){
       return ($todayYear+10)."-".($todayYear+11);
    } else if ($grade == "Kindergarten"){
       return ($todayYear+11)."-".($todayYear+12);
    }
 }

function getActivePeopleCount() {

    // This will return the number of active people in the database

    // Connect to the database
    $connection = db_connect();

    // Get the number of active devices from the database
    $sql = "SELECT COUNT(ID) AS CountOfID FROM People WHERE Active=True;";
    $results = $connection->query($sql);

    // Return the data if found, otherwise return 0
    if ($results->num_rows > 0) {
        $row = $results->fetch_assoc();     
        return $row['CountOfID'];
    } 
    else {
        return 0;
    }
}

function getActiveAssignmentCount() {

    // This will return the number of active assignments in the database

    // Connect to the database
    $connection = db_connect();

    // Get the number of active devices from the database
    $sql = "SELECT COUNT(ID) AS CountOfID FROM Assignments WHERE Active=True;";
    $results = $connection->query($sql);

    // Return the data if found, otherwise return 0
    if ($results->num_rows > 0) {
        $row = $results->fetch_assoc();     
        return $row['CountOfID'];
    } 
    else {
        return 0;
    }
}

function isAuthenticated($userName, $password) {

    // Takes the provided username and password and see if it's correct

    // This file contains the path to the config file needed to connect to Active Directory
    include 'includes/config.php';

    // Fix the username if they gave an email address
    if(strpos($userName, "@") == true){
        $userName = strstr($userName, '@', true);
    } 

    // Connect to Active Directory using information from the config.ini file
    $config = parse_ini_file($configFile);
    $ldap = ldap_connect("ldap://". $config['DC']);
    $netbiosName =  $config['netbios']. "\\". $userName;
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
    
    // Make sure they sent a password
    if (strlen($password) > 0){

        // Connect to Active Directory with the username and password provided by the user
        $ADConnection = @ldap_bind($ldap, $netbiosName, $password);

        // If it worked then they provided the right info, grab information about them from Active Directory
        if ($ADConnection) {
            
            // Look up the user in Active Directory
            $result = ldap_search($ldap,$config['rootDN'],"(sAMAccountName=$userName)");
            $userLookup = ldap_get_entries($ldap, $result);
            
            // If the user is found create a session
            if($userLookup['count'] = 1) {
                
                // Determine what type of user they are
                if (strpos($userLookup[0]["distinguishedname"][0],$config['studentOU']) !== false) {
                    $_SESSION["userType"]="Student";
                }
                else {
                    $_SESSION["userType"]="Employee";
                }

                // Find out if the user is an admin
                $admins = explode(',',$config['admins']);
                foreach($admins as $admin) {
                    if (strtolower($admin) == strtolower($userName)){
                        $_SESSION["userType"]="Admin";
                    } 
                }

                // Set the session variables
                $_SESSION["userName"] = $userLookup[0]["samaccountname"][0];
                $_SESSION["firstName"] = $userLookup[0]["givenname"][0];
                $_SESSION["lastName"] = $userLookup[0]["sn"][0];
                $_SESSION["email"] = $userLookup[0]["userprincipalname"][0];
                $_SESSION["loggedIn"] = TRUE;
            }

            // Close the connection to Active Directory
            @ldap_close($ldap);

            return TRUE; // The user is authenticated, and the session created
        } 
        else {
            return FALSE; // Unable to connect to Active Directory with the username and password provided
        }
    } 
    else {
        return FALSE; // The password was blank, if a blank password is passed it will succeed for stupid reasons
    }

}

function logout() {

    // Log out of the system

    // Set the session variables to empty strings.
    $_SESSION["loggedIn"] = FALSE;
    $_SESSION["userName"] = "";
    $_SESSION["firstName"] = "";
    $_SESSION["lastName"] = "";
    $_SESSION["email"] = "";
    $_SESSION["userType"] = "";
    header("location:index.php?login");
    die; 
}

?>
