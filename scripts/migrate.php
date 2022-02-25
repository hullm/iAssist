<?php

// Read in the config file
$configFile="../../config.ini";
$config = parse_ini_file($configFile);

importPeople();
importDevices();
importAssignments();
importCountHistory();

function db_connect() {

    // Read in the config file
    $configFile="../../config.ini";
    $config = parse_ini_file($configFile);

    // Connect to the database
    static $connection;
    $connection = @mysqli_connect($config['servername'],$config['username'],$config['password'],$config['dbname']);

    // Send back the connection
    return $connection;
}

function inventory_connect() {

    // Read in the config file
    $configFile="../../config.ini";
    $config = parse_ini_file($configFile);

    // Connect to the database
    static $inventoryDB;
    $inventoryDB = @mysqli_connect($config['servername'],$config['username'],$config['password'],"Inventory");

    // Send back the connection
    return $inventoryDB;
}

function helpdesk_connect() {

    // Read in the config file
    $configFile="../../config.ini";
    $config = parse_ini_file($configFile);

    // Connect to the database
    static $helpdesk;
    $helpdesk = @mysqli_connect($config['servername'],$config['username'],$config['password'],"Helpdesk");

    // Send back the connection
    return $helpdesk;
}

function importDevices(){

    // Import devices from the old Inventory database
    
    // Read in the config file
    $configFile="../../config.ini";
    $config = parse_ini_file($configFile);

    // Connect to the databases
    $inventoryDB = inventory_connect();
    $iAssistDB = db_connect();

    // Exit the function if one of the databases isn't found
    if($inventoryDB == FALSE) {echo "Inventory database not found, cannot import devices...\n";return;}
    if($iAssistDB == FALSE) {echo "iAssist database not found, cannot import devices...\n";return;}

    // Initialize variables
    $completedCount = 0;
    $skippedCount = 0;
    $deviceTagCount = 0;
    $deviceNameCount = 0;
    $notesCount = 0;
    $purchaseDateCount = 0;
    $siteCount = 0;
    $roomCount = 0;
    $lastUserCount = 0;
    $lastCheckInDateCount = 0;
    $lastCheckInTimeCount = 0;
    $oSVersionCount = 0;
    $internalIPCount = 0;
    $externalIPCount = 0;
    $dateAddedCount = 0;
    $dateDisabledCount = 0;
    $dateDeletedCount = 0;
    $activeCount = 0;
    $deletedCount = 0;

    echo "Importing Devices....\n";

    // Grab all the records from the old database
    $sql = "SELECT * FROM Devices;";
    $results = $inventoryDB->query($sql);

    // Make sure data was found in the old database before moving forward
    if ($results->num_rows > 0) {

        // Loop through the returned records from the old database
        while ($row=$results->fetch_assoc()) {

            // See if the record is already in the new database
            $sql = "SELECT * FROM Devices WHERE ID=".$row['ID'].";";
            $dbCheck = $iAssistDB->query($sql);

            // Add the record if it's not found in the database
            if ($dbCheck->num_rows == 0) {

                // Create the devices's record in the database 
                $sql = "INSERT INTO Devices(ID,DeviceTag,AltTag,DeviceType,Manufacturer,Model,SerialNumber,Active,Deleted)
                    Values (".$row['ID'].",'".
                    mysqli_real_escape_string($iAssistDB,$row['LGTag'])."','".
                    mysqli_real_escape_string($iAssistDB,$row['BOCESTag'])."','".
                    mysqli_real_escape_string($iAssistDB,$row['DeviceType'])."','".
                    mysqli_real_escape_string($iAssistDB,$row['Manufacturer'])."','".
                    mysqli_real_escape_string($iAssistDB,$row['Model'])."','".
                    mysqli_real_escape_string($iAssistDB,$row['SerialNumber'])."',".
                    $row['Active'].",".
                    $row['Deleted'].");";
                $iAssistDB->query($sql);
                $completedCount++;

                // Get the newly created device
                $sql = "SELECT * FROM Devices WHERE ID=".$row['ID'].";";
                $dbCheck = $iAssistDB->query($sql);
            }
            else {

                // Count the record if it was skipped meaning it was already in the database
                $skippedCount++;
            }

            // Grab the info about the device
            $existingEntry=$dbCheck->fetch_assoc();

            // Update DeviceTag
            if ($row['LGTag'] != $existingEntry['DeviceTag']) {
                $sql = "UPDATE Devices SET DeviceTag='".mysqli_real_escape_string($iAssistDB,$row['LGTag'])."'
                    WHERE ID=".$row['ID'].";";
                $iAssistDB->query($sql);
                $deviceTagCount++;
            }

            // Insert/Update ComputerName
            if ($row['ComputerName'] != '') {
                if ($row['ComputerName'] != $existingEntry['DeviceName']) {
                    $sql = "UPDATE Devices SET DeviceName='".mysqli_real_escape_string($iAssistDB,$row['ComputerName'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $deviceNameCount++;
                }
            }

            // Insert/Update Notes
            if ($row['Notes'] != '') {
                if ($row['Notes'] != $existingEntry['Notes']) {
                    $sql = "UPDATE Devices SET Notes='".mysqli_real_escape_string($iAssistDB,$row['Notes'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $notesCount++;
                }
            }

            // Insert/Update PurchaseDate
            if ($row['DatePurchased'] != '') {
                if ($row['DatePurchased'] != $existingEntry['PurchaseDate']) {
                    $sql = "UPDATE Devices SET PurchaseDate='".$row['DatePurchased']."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $purchaseDateCount++;
                }
            }

            // Insert/Update Site
            if ($row['Site'] != '') {
                if ($row['Site'] != $existingEntry['Site']) {
                    $sql = "UPDATE Devices SET Site='".mysqli_real_escape_string($iAssistDB,$row['Site'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $siteCount++;
                }
            }

            // Insert/Update Room
            if ($row['Room'] != '') {
                if ($row['Room'] != $existingEntry['Room']) {
                    $sql = "UPDATE Devices SET Room='".mysqli_real_escape_string($iAssistDB,$row['Room'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $roomCount++;
                }
            }

            // Insert/Update LastUser
            if ($row['LastUser'] != '') {
                if ($row['LastUser'] != $existingEntry['LastUser']) {
                    $sql = "UPDATE Devices SET LastUser='".mysqli_real_escape_string($iAssistDB,$row['LastUser'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $lastUserCount++;
                }
            }

            // Insert/Update LastCheckinDate
            if ($row['LastCheckInDate'] != '') {
                if ($row['LastCheckInDate'] != $existingEntry['LastCheckInDate']) {
                    $sql = "UPDATE Devices SET LastCheckInDate='".$row['LastCheckInDate']."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $lastCheckInDateCount++;
                }
            }

            // Insert/Update LastCheckInTime
            if ($row['LastCheckInTime'] != '') {
                if ($row['LastCheckInTime'] != $existingEntry['LastCheckInTime']) {
                    $sql = "UPDATE Devices SET LastCheckInTime='".$row['LastCheckInTime']."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $lastCheckInTimeCount++;
                }
            }

            // Insert/Update OSVersion
            if ($row['OSVersion'] != '') {
                if ($row['OSVersion'] != $existingEntry['OSVersion']) {
                    $sql = "UPDATE Devices SET OSVersion='".mysqli_real_escape_string($iAssistDB,$row['OSVersion'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $oSVersionCount++;
                }
            }

            // Insert/Update InternalIP
            if ($row['InternalIP'] != '') {
                if ($row['InternalIP'] != $existingEntry['InternalIP']) {
                    $sql = "UPDATE Devices SET InternalIP='".mysqli_real_escape_string($iAssistDB,$row['InternalIP'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $internalIPCount++;
                }
            }

            // Insert/Update ExternalIP
            if ($row['ExternalIP'] != '') {
                if ($row['ExternalIP'] != $existingEntry['ExternalIP']) {
                    $sql = "UPDATE Devices SET ExternalIP='".mysqli_real_escape_string($iAssistDB,$row['ExternalIP'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $externalIPCount++;
                }
            }

            // Insert/Update DateAdded
            if ($row['DateAdded'] != '') {
                if ($row['DateAdded'] != $existingEntry['DateAdded']) {
                    $sql = "UPDATE Devices SET DateAdded='".$row['DateAdded']."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $dateAddedCount++;
                }
            }

            // Insert/Update DateDisabled
            if ($row['DateDisabled'] != '') {
                if ($row['DateDisabled'] != $existingEntry['DateDisabled']) {
                    $sql = "UPDATE Devices SET DateDisabled='".$row['DateDisabled']."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $dateDisabledCount++;
                }
            }

            // Insert/Update DateDeleted
            if ($row['DateDeleted'] != '') {
                if ($row['DateDeleted'] != $existingEntry['DateDeleted']) {
                    $sql = "UPDATE Devices SET DateDeleted='".$row['DateDeleted']."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $dateDeletedCount++;
                }
            }

            // Update Active
            if ($row['Active'] != $existingEntry['Active']) {
                $sql = "UPDATE Devices SET Active=".$row['Active']."
                    WHERE ID=".$row['ID'].";";
                $iAssistDB->query($sql);
                $activeCount++;
            }

            // Update Deleted
            if ($row['Active'] != $existingEntry['Active']) {
                $sql = "UPDATE Devices SET Active=".$row['Active']."
                    WHERE ID=".$row['ID'].";";
                $iAssistDB->query($sql);
                $deletedCount++;
            }

        }
        echo "   - Devices imported: ".$completedCount."\n";
        echo "   - Devices skipped: ".$skippedCount."\n";
        echo "   - Device tags updated: ".$deviceTagCount."\n";
        echo "   - Computer names added/updated: ".$deviceNameCount."\n";
        echo "   - Notes added/updated: ".$notesCount."\n";
        echo "   - Purchase dates added/updated: ".$purchaseDateCount."\n";
        echo "   - Site added/updated: ".$siteCount."\n";
        echo "   - Room added/updated: ".$roomCount."\n";
        echo "   - Last user added/updated: ".$lastUserCount."\n";
        echo "   - Last check in dates added/updated: ".$lastCheckInDateCount."\n";
        echo "   - Last check in times added/updated: ".$lastCheckInTimeCount."\n";
        echo "   - OS versions added/updated: ".$oSVersionCount."\n";
        echo "   - Internal IPs added/updated: ".$internalIPCount."\n";
        echo "   - External IPs added/updated: ".$externalIPCount."\n";
        echo "   - Date added added/updated: ".$dateAddedCount."\n";
        echo "   - Date disabled added/updated: ".$dateDisabledCount."\n";
        echo "   - Date deleted added/updated: ".$dateDeletedCount."\n";
        echo "   - Active updated: ".$activeCount."\n";
        echo "   - Deleted updated: ".$deletedCount."\n";
    } 
    else {
        echo "   - No devices found to import\n";
    }
    echo "-----\n";
    echo "\n";
}

function importPeople(){

    // Import people from the old Inventory database

    // Read in the config file
    $configFile="../../config.ini";
    $config = parse_ini_file($configFile);

    // Connect to the databases
    $inventoryDB = inventory_connect();
    $iAssistDB = db_connect();

    // Exit the function if one of the databases isn't found
    if($inventoryDB == FALSE) {echo "Inventory database not found, cannot import people...\n";return;}
    if($iAssistDB == FALSE) {echo "iAssist database not found, cannot import people...\n";return;}

    // Initialize variables
    $completedCount = 0;
    $skippedCount = 0;
    $firstNameCount = 0;
    $lastNameCount = 0;
    $userNameCount = 0;
    $pWordCount = 0;
    $siteCount = 0;
    $phoneCount = 0;
    $roomCount = 0;
    $descriptionCount = 0;
    $notesCount = 0;
    $roleCount = 0;
    $photoIDCount = 0;
    $dOBCount = 0;
    $homeRoomCount = 0;
    $homeRoomEmailCount = 0;
    $externalCheckInCount = 0;
    $internalCheckInCount = 0;
    $internetAccessCount = 0;
    $aUPCount = 0;
    $dateAddedCount = 0;
    $dateDisabledCount = 0;
    $dateDeletedCount = 0;
    $activeCount = 0;
    $deletedCount = 0;

    echo "Importing Users....\n";

    // Grab all the records from the old database
    $sql = "SELECT * FROM People;";
    $results = $inventoryDB->query($sql);

    // Make sure data was found in the old database before moving forward
    if ($results->num_rows > 0) {

        // Loop through the returned records from the old database
        while ($row=$results->fetch_assoc()) {
            
            // See if the record is already in the new database
            $sql = "SELECT * FROM People WHERE ID=".$row['ID'].";";
            $dbCheck = $iAssistDB->query($sql);
            
            // Add the account if it's not found in the database
            if ($dbCheck->num_rows == 0) {

                // Create the user's record in the database 
                $sql = "INSERT INTO People(ID,FirstName,LastName,UserName,Email,Site,
                    PhotoID,AUP,Active,Deleted,Gender)
                    Values (".$row['ID'].",'".
                    mysqli_real_escape_string($iAssistDB,$row['FirstName'])."','".
                    mysqli_real_escape_string($iAssistDB,$row['LastName'])."','".
                    mysqli_real_escape_string($iAssistDB,$row['UserName'])."','".
                    mysqli_real_escape_string($iAssistDB,$row['UserName'])."@".$config['domain']."','".
                    mysqli_real_escape_string($iAssistDB,$row['Site'])."',".
                    $row['StudentID'].",".
                    $row['AUP'].",".
                    $row['Active'].",".
                    $row['Deleted'].",'".
                    mysqli_real_escape_string($iAssistDB,$row['Sex'])."');";
                $iAssistDB->query($sql);
                $completedCount++;

                // Get the newly created person
                $sql = "SELECT * FROM People WHERE ID=".$row['ID'].";";
                $dbCheck = $iAssistDB->query($sql);

            }
            else {

                // Count the record if it was skipped meaning it was already in the database
                $skippedCount++;
            }

            // Grab the info about the person
            $existingEntry=$dbCheck->fetch_assoc();

            // Update FirstName
            if ($row['FirstName'] != $existingEntry['FirstName']) {
                $sql = "UPDATE People SET FirstName='".mysqli_real_escape_string($iAssistDB,$row['FirstName'])."'
                    WHERE ID=".$row['ID'].";";
                $iAssistDB->query($sql);
                $firstNameCount++;
            }

            // Update LastName
            if ($row['LastName'] != $existingEntry['LastName']) {
                $sql = "UPDATE People SET LastName='".mysqli_real_escape_string($iAssistDB,$row['LastName'])."'
                    WHERE ID=".$row['ID'].";";
                $iAssistDB->query($sql);
                $lastNameCount++;
            }

            // Update UserName and Email
            if ($row['UserName'] != $existingEntry['UserName']) {
                $sql = "UPDATE People SET UserName='".mysqli_real_escape_string($iAssistDB,$row['UserName'])."'
                    WHERE ID=".$row['ID'].";";
                $iAssistDB->query($sql);
                $sql = "UPDATE People SET Email='".mysqli_real_escape_string($iAssistDB,$row['UserName'])."@".$config['domain']."'
                    WHERE ID=".$row['ID'].";";
                $iAssistDB->query($sql);
                $userNameCount++;
            }

            // Insert/Update Password
            if ($row['Pword'] != '') {
                if ($row['Pword'] != $existingEntry['Pword']) {
                    $sql = "UPDATE People SET Pword='".mysqli_real_escape_string($iAssistDB,$row['Pword'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $pWordCount++;
                }
            }

            // Update Site
            if ($row['Site'] != '') {
                if ($row['Site'] != $existingEntry['Site']) {
                    $sql = "UPDATE People SET Site='".mysqli_real_escape_string($iAssistDB,$row['Site'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $siteCount++;
                }
            }

            // Insert/Update Phone
            if ($row['PhoneNumber'] != NULL) {
                if ($row['PhoneNumber'] != $existingEntry['Phone']) {
                    $sql = "UPDATE People SET Phone='".mysqli_real_escape_string($iAssistDB,$row['PhoneNumber'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $phoneCount++;
                }
            }

            // Insert/Update Room
            if ($row['RoomNumber'] != NULL) {
                if ($row['RoomNumber'] != $existingEntry['Room']) {
                    $sql = "UPDATE People SET Room='".mysqli_real_escape_string($iAssistDB,$row['RoomNumber'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $roomCount++;
                }
            }

            // Insert/Update Description
            if ($row['Description'] != NULL) {
                if ($row['Description'] != $existingEntry['Description']) {
                    $sql = "UPDATE People SET Description='".mysqli_real_escape_string($iAssistDB,$row['Description'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $descriptionCount++;
                }
            }

            // Insert/Update Notes
            if ($row['Notes'] != NULL) {
                if ($row['Notes'] != $existingEntry['Notes']) {
                    $sql = "UPDATE People SET Notes='".mysqli_real_escape_string($iAssistDB,$row['Notes'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $notesCount++;
                }
            }

            // Insert/Update Role
            if ($row['ClassOf'] != NULL) {
                if ($row['ClassOf'] != $existingEntry['Role']) {
                    $sql = "UPDATE People SET Role='".mysqli_real_escape_string($iAssistDB,$row['ClassOf'])."'
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $roleCount++;
                }
            }

            // Update PhotoID
            if ($row['StudentID'] != NULL) {
                if ($row['StudentID'] != $existingEntry['PhotoID']) {
                    $sql = "UPDATE People SET Role='".mysqli_real_escape_string($iAssistDB,$row['PhotoID'])."'
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $photoIDCount++;
                }
            }

            // Insert/Update DOB
            if ($row['Birthday'] != '') {
                if ($row['Birthday'] != $existingEntry['DOB']) {
                    $sql = "UPDATE People SET DOB='".$row['Birthday']."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $dOBCount++;
                }
            }

            // Insert/Update HomeRoom
            if ($row['HomeRoom'] != NULL) {
                if ($row['HomeRoom'] != $existingEntry['HomeRoom']) {
                    $sql = "UPDATE People SET HomeRoom='".mysqli_real_escape_string($iAssistDB,$row['HomeRoom'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $homeRoomCount++;
                }
            }

            // Insert/Update HomeRoomEmail
            if ($row['HomeRoomEmail'] != NULL) {
                if ($row['HomeRoomEmail'] != $existingEntry['HomeRoomEmail']) {
                    $sql = "UPDATE People SET HomeRoomEmail='".mysqli_real_escape_string($iAssistDB,$row['HomeRoomEmail'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $homeRoomEmailCount++;
                }
            }

             // Insert/Update LastExternalCheckIn 
             if ($row['LastExternalCheckIn'] != NULL) {
                if ($row['LastExternalCheckIn'] != $existingEntry['LastExternalCheckIn']) {
                    $sql = "UPDATE People SET LastExternalCheckIn='".$row['LastExternalCheckIn']."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $externalCheckInCount++;
                }
            }

            // Insert/Update LastInternalCheckIn
            if ($row['LastInternalCheckIn'] != NULL) {
                if ($row['LastExternalCheckIn'] != $existingEntry['LastExternalCheckIn']) {
                    $sql = "UPDATE People SET LastInternalCheckIn='".$row['LastInternalCheckIn']."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $internalCheckInCount++;
                }
            }

            // Insert/Update InternetAccess
            if ($row['InternetAccess'] != '') {
                if ($row['InternetAccess'] != $existingEntry['InternetAccess']) {
                    $sql = "UPDATE People SET InternetAccess='".mysqli_real_escape_string($iAssistDB,$row['InternetAccess'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $internetAccessCount++;
                }
            }

            // Update AUP
            if ($row['AUP'] != $existingEntry['AUP']) {
                $sql = "UPDATE People SET AUP=".$row['AUP']."
                    WHERE ID=".$row['ID'].";";
                $iAssistDB->query($sql);
                $aUPCount++;
            }

            // Insert/Update DateAdded
            if ($row['DateAdded'] != NULL) {
                if ($row['DateAdded'] != $existingEntry['DateAdded']) {
                    $sql = "UPDATE People SET DateAdded='".$row['DateAdded']."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $dateAddedCount++;
                }
            }

            // Insert/Update DateDisabled
            if ($row['DateDisabled'] != NULL) {
                if ($row['DateDisabled'] != $existingEntry['DateDisabled']) {
                    $sql = "UPDATE People SET DateDisabled='".$row['DateDisabled']."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $dateDisabledCount++;
                }
            }

            // Insert/Update DateDeleted
            if ($row['DateDeleted'] != NULL) {
                if ($row['DateDeleted'] != $existingEntry['DateDeleted']) {
                    $sql = "UPDATE People SET DateDeleted='".$row['DateDeleted']."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $dateDeletedCount++;
                }
            }

            // Update Active
            if ($row['Active'] != $existingEntry['Active']) {
                $sql = "UPDATE People SET Active=".$row['Active']."
                    WHERE ID=".$row['ID'].";";
                $iAssistDB->query($sql);
                $activeCount++;
            }

            // Update Deleted
            if ($row['Active'] != $existingEntry['Active']) {
                $sql = "UPDATE People SET Active=".$row['Active']."
                    WHERE ID=".$row['ID'].";";
                $iAssistDB->query($sql);
                $deletedCount++;
            }
        }

        echo "   - People imported: ".$completedCount."\n";
        echo "   - People skipped: ".$skippedCount."\n";
        echo "   - First names updated: ".$firstNameCount."\n";
        echo "   - Last names updated: ".$lastNameCount."\n";
        echo "   - Usernames updated: ".$userNameCount."\n";
        echo "   - Passwords updated: ".$pWordCount."\n";
        echo "   - Sites updated: ".$siteCount."\n";
        echo "   - Phone numbers added/updated: ".$phoneCount."\n";
        echo "   - Room numbers added/updated: ".$roomCount."\n";
        echo "   - Photo IDs updated: ".$photoIDCount."\n";
        echo "   - Descriptions added/updated: ".$descriptionCount."\n";
        echo "   - Notes added/updated: ".$notesCount."\n";
        echo "   - Roles added/updated: ".$roleCount."\n";
        echo "   - DOBs added/updated: ".$dOBCount."\n";
        echo "   - Home room added/updated: ".$homeRoomCount."\n";
        echo "   - Home room email added/updated: ".$homeRoomEmailCount."\n";
        echo "   - External check ins updated: ".$internalCheckInCount."\n"; 
        echo "   - Internal check ins updated: ".$internalCheckInCount."\n";
        echo "   - Internet access updated: ".$internetAccessCount."\n";
        echo "   - AUP updated: ".$aUPCount."\n";
        echo "   - Date Added added/updated: ".$dateAddedCount."\n";
        echo "   - Date Disabled added/updated: ".$dateDisabledCount."\n";
        echo "   - Date Deleted added/updated: ".$dateDeletedCount."\n";
        echo "   - Active updated: ".$activeCount."\n";
        echo "   - Deleted updated: ".$deletedCount."\n";
    } 
    else {
        echo "   - No Users found to import\n";
    }
    
    echo "-----\n";
    echo "\n";

}

function importAssignments(){

    // Import assignments from the old Inventory database
    
    // Read in the config file
    $configFile="../../config.ini";
    $config = parse_ini_file($configFile);

    // Connect to the databases
    $inventoryDB = inventory_connect();
    $iAssistDB = db_connect();

    // Exit the function if one of the databases isn't found
    if($inventoryDB == FALSE) {echo "Inventory database not found, cannot import devices...\n";return;}
    if($iAssistDB == FALSE) {echo "iAssist database not found, cannot import devices...\n";return;}

    // Initialize variables
    $completedCount = 0;
    $skippedCount = 0;
    $deviceTagCount = 0;
    $dateReturnedCount = 0;
    $timeReturnedCount = 0;
    $activeCount = 0;
    $returnedByCount = 0;

    echo "Importing Assignments....\n";

    // Grab all the records from the old database
    $sql = "SELECT * FROM Assignments;";
    $results = $inventoryDB->query($sql);

    // Make sure data was found in the old database before moving forward
    if ($results->num_rows > 0) {

        // Loop through the returned records from the old database
        while ($row=$results->fetch_assoc()) {

            // See if the record is already in the new database
            $sql = "SELECT * FROM Assignments WHERE ID=".$row['ID'].";";
            $dbCheck = $iAssistDB->query($sql);

            // Add the record if it's not found in the database
            if ($dbCheck->num_rows == 0) {

                // Create the devices's record in the database 
                $sql = "INSERT INTO Assignments(ID,DeviceTag,DateIssued,TimeIssued,AssignedTo,IssuedBy,Active)
                    Values (".$row['ID'].",'".
                    mysqli_real_escape_string($iAssistDB,$row['LGTag'])."','".
                    $row['DateIssued']."','".
                    $row['TimeIssued']."',".
                    $row['AssignedTo'].",'".
                    mysqli_real_escape_string($iAssistDB,$row['IssuedBy'])."',".
                    $row['Active'].");";
                $iAssistDB->query($sql);
                $completedCount++;

                // Get the newly created assignment
                $sql = "SELECT * FROM Assignments WHERE ID=".$row['ID'].";";
                $dbCheck = $iAssistDB->query($sql);
            }
            else {

                // Count the record if it was skipped meaning it was already in the database
                $skippedCount++;
            }

            // Grab the info about the Assignment
            $existingEntry=$dbCheck->fetch_assoc();

            // Update DeviceTag
            if ($row['LGTag'] != $existingEntry['DeviceTag']) {
                $sql = "UPDATE Assignments SET DeviceTag='".mysqli_real_escape_string($iAssistDB,$row['LGTag'])."'
                    WHERE ID=".$row['ID'].";";
                $iAssistDB->query($sql);
                $deviceTagCount++;
            }

            // Insert/Update DateReturned
            if ($row['DateReturned'] != '') {
                if ($row['DateReturned'] != $existingEntry['DateReturned']) {
                    $sql = "UPDATE Assignments SET DateReturned='".$row['DateReturned']."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $dateReturnedCount++;
                }
            }

            // Insert/Update TimeReturned
            if ($row['TimeReturned'] != '') {
                if ($row['TimeReturned'] != $existingEntry['TimeReturned']) {
                    $sql = "UPDATE Assignments SET TimeReturned='".$row['TimeReturned']."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $timeReturnedCount++;
                }
            }

            // Insert/Update ReturnedBy
            if ($row['ReturnedBy'] != '') {
                if ($row['ReturnedBy'] != $existingEntry['ReturnedBy']) {
                    $sql = "UPDATE Assignments SET ReturnedBy='".mysqli_real_escape_string($iAssistDB,$row['ReturnedBy'])."' 
                        WHERE ID=".$row['ID'].";";
                    $iAssistDB->query($sql);
                    $returnedByCount++;
                }
            }

            // Update Active
            if ($row['Active'] != $existingEntry['Active']) {
                $sql = "UPDATE Assignments SET Active=".$row['Active']."
                    WHERE ID=".$row['ID'].";";
                $iAssistDB->query($sql);
                $activeCount++;
            }

        }
        echo "   - Assignments imported: ".$completedCount."\n";
        echo "   - Assignments skipped: ".$skippedCount."\n";
        echo "   - Device tags updated: ".$deviceTagCount."\n";
        echo "   - Date returned added/updated: ".$dateReturnedCount."\n";
        echo "   - Time returned added/updated: ".$timeReturnedCount."\n";
        echo "   - Returned bys added/updated: ".$returnedByCount."\n";
        echo "   - Active updated: ".$activeCount."\n";
    } 
    else {
        echo "   - No assignments found to import\n";
    }
    echo "-----\n";
    echo "\n";
}

function importCountHistory(){

    // Import CountHistory from the old Inventory database
    
    // Read in the config file
    $configFile="../../config.ini";
    $config = parse_ini_file($configFile);

    // Connect to the databases
    $inventoryDB = inventory_connect();
    $iAssistDB = db_connect();

    // Exit the function if one of the databases isn't found
    if($inventoryDB == FALSE) {echo "Inventory database not found, cannot import devices...\n";return;}
    if($iAssistDB == FALSE) {echo "iAssist database not found, cannot import devices...\n";return;}

    // Initialize variables
    $completedCount = 0;
    $skippedCount = 0;

    echo "Importing Count History....\n";

    // Grab all the records from the old database
    $sql = "SELECT * FROM CountHistory;";
    $results = $inventoryDB->query($sql);

    // Make sure data was found in the old database before moving forward
    if ($results->num_rows > 0) {

        // Loop through the returned records from the old database
        while ($row=$results->fetch_assoc()) {

            // See if the record is already in the new database
            $sql = "SELECT * FROM CountHistory WHERE ID=".$row['ID'].";";
            $dbCheck = $iAssistDB->query($sql);

            // Add the record if it's not found in the database
            if ($dbCheck->num_rows == 0) {

                
                // If the role is TotalCount change it to 0 since it needs to be an integer
                if ($row['Role'] == "TotalCount") {
                    $role = 0;
                }
                else {
                    $role = $row['Role'];
                }

                // Create the devices's record in the database 
                $sql = "INSERT INTO CountHistory(ID,Role,RecordedDate,StudentCount)
                    Values (".$row['ID'].",".
                    $role.",'".
                    $row['RecordedDate']."',".
                    $row['StudentCount'].");";
                $iAssistDB->query($sql);
                $completedCount++;
            }
            else {

                // Count the record if it was skipped meaning it was already in the database
                $skippedCount++;
            }
        }
        echo "   - Count histories imported: ".$completedCount."\n";
        echo "   - Count histories skipped: ".$skippedCount."\n";
    } 
    else {
        echo "   - No count histories found to import\n";
    }
    echo "-----\n";
    echo "\n";
}

function importTickets(){

    // Import helpdesk tickets from the old Helpdesk database
    
        // Connect to the Helpdesk database
        $helpdeskDB = helpdesk_connect();
    
        $sql = "SELECT * FROM Main;";
        $results = $helpdeskDB->query($sql);
    
        // Return the data if found, otherwise return 0
        if ($results->num_rows > 0) {
            // echo "Data Found!\n";
        } 
        else {
            // echo "No Data Found\n";
        }
    }