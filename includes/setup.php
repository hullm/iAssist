<?php

// Create connection to the database server, not the database
$conn = new mysqli($config['servername'],$config['username'],$config['password']);

// Verify the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database
$sql = "CREATE DATABASE ". $config['dbname']. ";";
if ($conn->query($sql) === TRUE) {
    echo "<div>Database created successfully...</div>";
} else {
    echo "<div>Database already exists...</div>";
}

// Close the connection to the database server
$conn->close();

// Connect to the database
$connection = db_connect();

// Create the Devices table
$sql = "CREATE TABLE `Devices` (
    `ID` INTEGER NOT NULL AUTO_INCREMENT, 
    `DeviceTag` VARCHAR(255), 
    `AltTag` VARCHAR(255),
    `DeviceType` VARCHAR(255),
    `Manufacturer` VARCHAR(255), 
    `Model` VARCHAR(255), 
    `SerialNumber` VARCHAR(255), 
    `DeviceName` VARCHAR(255), 
    `Notes` LONGTEXT, 
    `PurchaseDate` DATETIME, 
    `Site` VARCHAR(255), 
    `Room` VARCHAR(255), 
    `Assigned` TINYINT(1) DEFAULT 0, 
    `LastUser` VARCHAR(255), 
    `LastCheckInDate` DATETIME, 
    `LastCheckInTime` DATETIME,
    `OSVersion` VARCHAR(255), 
    `InternalIP` VARCHAR(255), 
    `ExternalIP` VARCHAR(255), 
    `DateAdded` DATETIME, 
    `DateDisabled` DATETIME, 
    `DateDeleted` DATETIME, 
    `Active` TINYINT(1) DEFAULT 0,
    `Deleted` TINYINT(1),
    INDEX (`ID`),
    UNIQUE (`DeviceTag`), 
    PRIMARY KEY (`ID`)
    ) ENGINE=myisam DEFAULT CHARSET=utf8;";

if ($connection->query($sql) === TRUE) {
    echo "<div>Devices table created...</div>";
} else {
    echo "<div>Devices table already exists...</div>";
}

// Create the People table
$sql = "CREATE TABLE `People` (
    `ID` INTEGER NOT NULL AUTO_INCREMENT, 
    `FirstName` VARCHAR(255), 
    `LastName` VARCHAR(255), 
    `UserName` VARCHAR(255),
    `Pword` VARCHAR(255),
    `Email` VARCHAR(255),
    `Site` VARCHAR(255), 
    `Phone` VARCHAR(255),
    `Room` VARCHAR(255),
    `Description` VARCHAR(255), 
    `Notes` LONGTEXT, 
    `Role` INTEGER DEFAULT 0,  
    `PhotoID` INTEGER DEFAULT 0,
    `Gender` VARCHAR(255), 
    `DOB` DATETIME, 
    `HomeRoom` VARCHAR(255), 
    `HomeRoomEmail` VARCHAR(255), 
    `PWordLastSet` DATETIME, 
    `PWordNeverExpires` TINYINT(1) DEFAULT 1,
    `LastExternalCheckIn` DATETIME, 
    `LastInternalCheckIn` DATETIME, 
    `InternetAccess` VARCHAR(255), 
    `HasDevice` TINYINT(1) DEFAULT 0,
    `DeviceCount` INTEGER DEFAULT 0, 
    `AUP` TINYINT(1) DEFAULT 0,
    `DateAdded` DATETIME, 
    `DateDisabled` DATETIME, 
    `DateDeleted` DATETIME, 
    `Active` TINYINT(1) DEFAULT 1, 
    `Deleted` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`ID`), 
    INDEX (`UserName`)
  ) ENGINE=myisam DEFAULT CHARSET=utf8;";

if ($connection->query($sql) === TRUE) {
    echo "<div>People table created...</div>";
} else {
    echo "<div>People table already exists...</div>";
}

// Create the Assignments table
$sql = "CREATE TABLE `Assignments` (
    `ID` INTEGER NOT NULL AUTO_INCREMENT, 
    `DeviceTag` VARCHAR(255), 
    `DateIssued` DATETIME, 
    `TimeIssued` DATETIME, 
    `DateReturned` DATETIME, 
    `TimeReturned` DATETIME, 
    `Active` TINYINT(1) DEFAULT 0, 
    `AssignedTo` INTEGER DEFAULT 0, 
    `ReturnedBy` VARCHAR(255), 
    `IssuedBy` VARCHAR(255), 
    `DateDeleted` DATETIME,
    `Deleted` TINYINT(1),
    PRIMARY KEY (`ID`)
  ) ENGINE=myisam DEFAULT CHARSET=utf8;";

if ($connection->query($sql) === TRUE) {
    echo "<div>Assignments table created...</div>";
} else {
    echo "<div>Assignments table already exists...</div>";
}

// Create the Tickets table
$sql = "CREATE TABLE `Tickets` (
    `ID` INTEGER NOT NULL AUTO_INCREMENT, 
    `UserID` VARCHAR(50),  
    `DeviceTag` VARCHAR(255),
    `Site` VARCHAR(50), 
    `Problem` LONGTEXT, 
    `Notes` LONGTEXT,
    `SubmitDate` DATETIME, 
    `SubmitTime` DATETIME, 
    `Status` VARCHAR(50), 
    `LastUpdatedDate` DATETIME, 
    `LastUpdatedTime` DATETIME, 
    `Category` VARCHAR(50), 
    `Tech` VARCHAR(50), 
    `OpenTime` VARCHAR(50), 
    `PhoneNumber` VARCHAR(255),
    `RoomNumber` VARCHAR(255), 
    `DateDeleted` DATETIME,
    `Deleted` TINYINT(1), 
    INDEX (`ID`), 
    PRIMARY KEY (`ID`)
  ) ENGINE=myisam DEFAULT CHARSET=utf8;";

if ($connection->query($sql) === TRUE) {
    echo "<div>Tickets table created...</div>";
} else {
    echo "<div>Tickets table already exists...</div>";
}

// Create the Events table
$sql = "CREATE TABLE `Events` (
    `ID` INTEGER NOT NULL AUTO_INCREMENT, 
    `DeviceTag` VARCHAR(255), 
    `UserID` INTEGER DEFAULT 0, 
    `Type` VARCHAR(255), 
    `Site` VARCHAR(255), 
    `Notes` LONGTEXT, 
    `SubmitDate` DATETIME, 
    `SubmitTime` DATETIME,  
    `Status` VARCHAR(50),  
    `LastUpdatedDate` DATETIME, 
    `LastUpdatedTime` DATETIME,
    `Category` VARCHAR(255), 
    `EnteredBy` VARCHAR(255), 
    `Warranty` TINYINT(1), 
    `CompletedBy` VARCHAR(255), 
    `DateDeleted` DATETIME,
    `Deleted` TINYINT(1), 
    PRIMARY KEY (`ID`)
  ) ENGINE=myisam DEFAULT CHARSET=utf8;";

if ($connection->query($sql) === TRUE) {
    echo "<div>Events table created...</div>";
} else {
    echo "<div>Events table already exists...</div>";
}

?>