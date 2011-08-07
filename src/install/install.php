<?PHP
////////////////////////////////////////////////////////
//													  //
//				   by: Kevin A. Hoogheem              //
//                 (kevin@hoogheem.net)               //
//                                                    //
////////////////////////////////////////////////////////

/**
 * Project Name : Apple Push Notification Service using PHP & MySQL
 *
 * @package className
 * @subpackage subclassName
 * @author $Author$
 * @copyright $Copyright$
 * @version $Revision$
 * @lastrevision $Date$
 * @modifiedby $LastChangedBy$
 * @lastmodified $LastChangedDate$
 * @license $License$
 * @filesource $URL$
*/
    
    function check_port($port, $host) {
        $conn = @fsockopen($host, $port, $errno, $errstr, 0.2);
        if ($conn) {
            return true;
        }
        fclose($conn);
    }
        
    if (isset($_GET['step']))
        $step = $_GET['step'];
    else
        $step = "welcome";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="install.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
    <div id="content">
<?PHP
    switch($step){
        case "welcome";
?>
<title>EasyAPNS Installer Script</title>

    <div id="left-nav">
        <ul>
        <li><b>Welcome</b></li>
        <li>Push Server</li>
        <li>Environment</li>
        <li>Database</li>
        </ul>
    </div>

    <div id="main">
        <h1>EasyAPNS - Push Notification Server</h1>

        <p>Thank you for downloading EasyAPNS.</p>

        <p>Copyright (c) 2008 - 2010, Manifest Interactive, LLC. All rights reserved.</p>

        <p>This license is a legal agreement between you and Manifest Interactive, LLC. for the use of Manifest Interactive Software (the "Software"). By obtaining the Software you agree to comply with the terms and conditions of this license.
        <p>

        <form method="post" action="?step=push_check">
        <?php 
            if (file_exists("../../license.txt")){
                include "../../license.txt";
            }else{ ?>
        <textarea readonly="readonly" >
        PERMITTED USE You are permitted to use, copy, modify, and distribute the Software and its documentation, with or without modification, for any purpose, provided that the following conditions are met: 

        1. A copy of this license agreement must be included with the distribution. 

        2. Redistributions of source code must retain the above copyright notice in all source code files. 

        3. Redistributions in binary form must reproduce the above copyright notice in the documentation and/or other materials provided with the distribution. 

        4. Any files that have been modified must carry notices stating the nature of the change and the names of those who changed them. 

        5. Products derived from the Software must include an acknowledgment that they are derived from Manifest Interactive in their documentation and/or other materials provided with the distribution. 

        6. Products derived from the Software may not be called "Manifest Interactive", nor may "Manifest Interactive" appear in their name, without prior written permission from Manifest Interactive, LLC. 

        INDEMNITY You agree to indemnify and hold harmless the authors of the Software and any contributors for any direct, indirect, incidental, or consequential third-party claims, actions or suits, as well as any related expenses, liabilities, damages, settlements or fees arising from your use or misuse of the Software, or a violation of any terms of this license. 

        DISCLAIMER OF WARRANTY THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, WARRANTIES OF QUALITY, PERFORMANCE, NON-INFRINGEMENT, MERCHANTABILITY, OR FITNESS FOR A PARTICULAR PURPOSE. 

        LIMITATIONS OF LIABILITY YOU ASSUME ALL RISK ASSOCIATED WITH THE INSTALLATION AND USE OF THE SOFTWARE. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS OF THE SOFTWARE BE LIABLE FOR CLAIMS, DAMAGES OR OTHER LIABILITY ARISING FROM, OUT OF, OR IN CONNECTION WITH THE SOFTWARE. LICENSE HOLDERS ARE SOLELY RESPONSIBLE FOR DETERMINING THE APPROPRIATENESS OF USE AND ASSUME ALL RISKS ASSOCIATED WITH ITS USE, INCLUDING BUT NOT LIMITED TO THE RISKS OF PROGRAM ERRORS, DAMAGE TO EQUIPMENT, LOSS OF DATA OR SOFTWARE PROGRAMS, OR UNAVAILABILITY OR INTERRUPTION OF OPERATIONS. 
        </textarea>
        <?php } ?>
        <p>
        <p><input class="button" type="submit" value="Next"></p>
        </FORM>

    <div class="clear"></div>

    </div>
<?PHP
    break;
    case "push_check";
?>
<title>EasyAPNS Installer - Checking Push Server Status</title>
<?php $fail = FALSE ?>

        <div id="left-nav">
        <ul>
            <li>Welcome</li>
            <li><b>Push Server</b></li>
            <li>Environment</li>
            <li>Database</li>
        </ul>
        </div>

        <div id="main">
        <h2>Push Server Communications</h2>

        <table>
            <tr>
                <td>Production Push Server</td>
                <?php if (check_port(2195, "gateway.push.apple.com")): ?>
                    <td class=success>Connected</td>
                <?php else: $fail = TRUE ?>
                    <td class=error>Error reaching production Push Server.. Make sure you can use port 2195 on your server</td>
                <?php endif ?>
            </tr>
            <tr>
                <td>Production Feedback Server</td>
                <?php if (check_port(2196, "feedback.push.apple.com")): ?>
                    <td class=success>Connected</td>
                <?php else: $fail = TRUE ?>
                    <td class=error>Error reaching production Feedback Server.. Make sure you can use port 2196 on your server,/td>
                <?php endif ?>
            </tr>
            <tr>
                <td>Sandbox Push Server</td>
                <?php if (check_port(2195, "gateway.sandbox.push.apple.com")): ?>
                    <td class=success>Connected</td>    
                <?php else: $fail = TRUE ?>
                    <td class=error>Error reaching production Sandbox Push Server.. Make sure you can use port 2195 on your server</td>
                <?php endif ?>
            </tr>
            <tr>
                <td>Sandbox Feedback Server</td>
                <?php if (check_port(2196, "feedback.sandbox.push.apple.com")): ?>  
                    <td class=success>Connected</td>
                <?php else: $fail = TRUE ?>
                    <td class=error>Error reaching production Sandbox Feedback Server.. Make sure you can use port 2195 on your server</td>
                <?php endif ?>
            </tr>
        </table>

        <?php if ($fail === TRUE): ?>
            <p class=error>One or more errors occured with connectivity to the Apple Push Notification Servers.  Please insure your server allows communication on ports 2195 and 2196.</p>
        <?php else: ?>
            <p class="success">Connection to all APNS servers were passed.<br />
        <?php endif ?>

        <FORM method="post" action="?step=welcome">
            <input class="back_button" type="submit" value="back" >
        </FORM>
        <FORM method="post" action="?step=env_tests">
            <input class="button" type="submit" value="Next">
        </FORM>

        <div class="clear"></div>
        </div>
<?PHP
    break;
    case "env_tests";
?>
<title>EasyAPNS Installer - Checking Enviroment</title>
<?php $fail = FALSE ?>
    
        <div id="left-nav">
        <ul>
            <li>Welcome</li>
            <li>Push Server</li>
            <li><b>Environment</b></li>
            <li>Database</li>
        </ul>
        </div>

        <div id="main">
        <h2>Environment Checks</h2>

        <table>
            <tr>
                <td>PHP Version</td>
                <?php if (version_compare(PHP_VERSION, '5.2.0', '>=')): ?>
                    <td class="success"><?php echo PHP_VERSION ?></td>
                <?php else: $fail = TRUE ?>
                    <td class="error">EasyAPNS requires PHP 5.2.3 or newer, this version is <?php echo PHP_VERSION ?>.</td>
                <?php endif ?>
            </tr>
            <tr>
                <td>Config Directory</th>
                <?php if (is_dir('../php/config/') AND is_writable('../php/config/')): ?>
                    <td class="success">/php/config/</td>
                <?php else: $failed = TRUE ?>
                    <td class="error">The /php/config/ directory is not writable.</td>
                <?php endif ?>
            </tr>
            <tr>
                <td>DB Files</td>
                <?php if (file_exists('../sql/apns.sql') AND file_exists('../sql/apns_alt.sql')): ?>
                    <td class="success">SQL Files found</td>
                <?php else: $fail = TRUE ?>
                    <td class="error">Could not find the SQL files need to setup the database.  Please insure they are downloaded and in the sql folder.</td>
                <?php endif ?>
            </tr>
            <tr>
                <td>json_encode</td>
                <?php if (function_exists('json_encode')): ?>
                    <td class="success">pass</td>
                <?php else: $fail = TRUE ?>
                    <td class="error">json_encode function not found</td>
                <?php endif ?>
            </tr>
            <tr>
            <td>MySQLi</td>
            <?php if (function_exists('mysqli_connect_errno')): ?>
                <td class="success">pass</td>
            <?php else: $fail = TRUE ?>
                <td class="error">EasyAPNS requires <a href="http://www.php.net/manual/en/mysqli.installation.php" target="_new">MySQLi</a> for database access.</td>
            <?php endif ?>
            </tr>
        </table>

        <?php if ($fail == TRUE): ?>
            <p class="error">Some test have failed. EasyAPNS may not work correctly with your environment. Please address the issues before moving on.</p>
        <?php else: ?>
            <p class="success">Your environment passed all requirements.<br />
            <FORM method="post" action="?step=db_details">
                <input class="button" type="submit" value="Next">
            </FORM>
        <?php endif ?>


        <FORM method="post" action="?step=push_check">
            <input class="back_button" type="submit" value="back" >
        </FORM>

        <div class="clear"></div>
        </div>

<?PHP
    break;
    case "db_details";
    $error  = trim($_GET['error']);
?>
<title>EasyAPNS Installer - Database Settings</title>
<?php $fail = FALSE ?>

        <div id="left-nav">
        <ul>
            <li>Welcome</li>
            <li>Push Server</li>
            <li>Environment</li>
            <li><b>Database</b></li>
        </ul>
        </div>

        <div id="main">
        <h2>Database Settings</h2>

        <p>Enter in your database connection details.  Please contact your host admin if you are not sure of any of the settings.</p>

        <?php if ($error): ?>
            <div class="error"><?PHP echo $error; ?></div>
        <?php endif ?>

        <FORM method="post" action="?step=db_tests">
        <b>Database Name</b>
            <p><input name="db_name" type="text" size="25" value="" /><br />
            The name of the database you want to run your script in.</p>

        <h4>User Name</h4>
            <p><input name="db_username" type="text" size="25" value="" /><br />
            Your MySQL username.</p>

        <h4>Password</h4>
            <p><input name="db_password" type="password" size="25" value="" /><br />
            Your MySQL password.</p>

        <h4>Database Host</h4>
            <p><input name="db_host" type="text" size="25" value="localhost" /><br />
            Hostname of the MySQL server.</p>

            <input class="button" type="submit" value="Next">
        </FORM>
        <FORM method="post" action="?step=env_tests">
            <input class="back_button" type="submit" value="back" >
        </FORM>
        
        <div class="clear"></div>
        </div>
<?PHP
    break;
    case "db_tests";
    $fail = FALSE;
    
    $db_host        = trim($_POST['db_host']);
    $db_name        = trim($_POST['db_name']);
    $db_username    = trim($_POST['db_username']);
    $db_password    = trim($_POST['db_password']);
    
    $error = "<ul>";
    if ($db_name == ""){
        $error .= "<li>Database Name needs to be set.</li>";
        $fail = TRUE;
    }
    if ($db_username == ""){
        $error .= "<li>Database Username needs to be set.</li>";
        $fail = TRUE;
    }
    if ($db_password == ""){
        $error .= "<li>Database Password needs to be set.</li>";
        $fail = TRUE;
    }
    $error .= "</ul>";
    ($fail == TRUE)? header("Location: ?step=db_details&error=$error"): $fail = FALSE;
    
    //OK information has been put into all fields, now lets start the DB tests.
    //
    // ERRORS: 
    // 1044 - Access denied for user
    // 1049 - Database Does not Exist
    // 2002 - No Such File
    function check_dbConnection($db_host, $db_username, $db_password){
        $query = mysql_connect($db_host, $db_username, $db_password);
        if (!$query) { 
            //echo "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query\n<br>";
            $sql_error = array('Text' => mysql_error(), 'Code' => mysql_errno());

            return $sql_error;
        }        
    }
    
    function check_dbExists($db_name, $link){
        $query = mysql_select_db($db_name, $link);
        if (!$query){ 
            //echo "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query\n<br>";
            $sql_error = array('Text' => mysql_error(), 'Code' => mysql_errno());
            
            return $sql_error;
        }        
    }
    
    function create_database($db_name, $db_host, $db_username, $db_password){
        $link = mysql_connect($db_host, $db_username, $db_password);
        if (!$link){ 
            //echo "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query\n<br>";
            $sql_error = array('Text' => mysql_error(), 'Code' => mysql_errno());
            
            return $sql_error;
        }        
        $query="CREATE DATABASE IF NOT EXISTS $db_name";
        if (!mysql_query("$query")) {
            $sql_error = array('Text' => mysql_error(), 'Code' => mysql_errno());
            
            return $sql_error;
        }
    }

    function mysqlVerison($db_name, $db_host, $db_username, $db_password){
        $link = mysql_connect($db_host, $db_username, $db_password);
        $query="SELECT VERSION()";
        $row = mysql_fetch_row(mysql_query("$query"));
        return $row[0];
    }
    
    function checkTrigger($db_name, $db_host, $db_username, $db_password){
        $link = mysql_connect($db_host, $db_username, $db_password);
        mysql_select_db("$db_name");

        $query = "CREATE TABLE `apns_test` (  `appname` varchar(255) NOT NULL);";
        $result = mysql_query("$query");
        //Test if TRIGGER is Granted for User
        $query = "CREATE TRIGGER `Archive` BEFORE UPDATE ON `apns_test` FOR EACH ROW INSERT INTO `apns_test` VALUES (
        NULL);";
        $result= mysql_query("$query");
        if (!$result){
            $sql_error = array('Text' => mysql_error(), 'Code' => mysql_errno());
        }
        $query = "drop TABLE `apns_test`;";
        $result = mysql_query("$query");
        return $sql_error;
    }

    
    function createDBConfig($db_name, $db_host, $db_username, $db_password){    
        $handle = fopen('../php/config/db.php', 'w');
        $source = "
        define('DB_HOST', \"R_HOSTNAME\" );
        define('DB_USERNAME', \"R_USERNAME\" );
        define('DB_PASSWORD', \"R_PASSWORD\" );
        define('DB_DATABASE', \"R_DATABASENAME\" );
        ";
        $search = array ( R_DATABASENAME, R_USERNAME, R_PASSWORD, R_HOSTNAME);
        $replace = array ($db_name, $db_username, $db_password, $db_host);

        $source_start = "<?PHP";
        $source = str_replace ( $search, $replace, $source );
        $config_file = "<?php $source ";
        fwrite($handle, $config_file);
    }
    
    function  setupDBTables($trigger, $db_name, $db_host, $db_username, $db_password){
        // Trigger TRUE - can use triggers
        $sqlFileToExecute = ($trigger == TRUE ? '../sql/apns.sql' :'../sql/apns_alt.sql');        
        
        $link = mysql_connect($db_host, $db_username, $db_password);
        if (!$link){ 
            $sql_error = array('Text' => mysql_error(), 'Code' => mysql_errno());
            return $sql_error;
        }        

        mysql_select_db("$db_name");
        //Lets get the sql files
        $f = fopen($sqlFileToExecute,"r");
        $sqlFile = fread($f,filesize($sqlFileToExecute));
        $sqlArray = explode(';',$sqlFile);
        fclose($f);
        
        //Process the sql file by statements
        foreach ($sqlArray as $stmt) {
            if (strlen($stmt)>3){
                $result = mysql_query($stmt);
                if (!$result){
                    $sql_error = array('Text' => mysql_error(), 'Code' => mysql_errno());
                    return $sql_error;
                }
            }
        }
        
    }
    
?>
<title>EasyAPNS Installer - Database Setup</title>
<?php $fail = FALSE ?>

        <div id="left-nav">
        <ul>
            <li>Welcome</li>
            <li>Push Server</li>
            <li>Environment</li>
            <li><b>Database</b></li>
        </ul>
        </div>

        <div id="main">
        <h2>Database Setup</h2>
        
        <table>
        <tr>
        <td>Host Check</td>
        <?php if (check_port(3306, "$db_host")): ?>  
            <td class="success">Connected -  <?php echo $db_host; ?></td>
        <?php else: $fail = TRUE ?>
            <td class="error">Having issues connecting to the database host - <?php echo $db_host; ?></td>
        <?php endif ?>
        </tr>
        <tr>
        <td>Database Connection</td>
        <?php if (!$sql_error = check_dbConnection($db_host, $db_username, $db_password)): ?>  
            <td class="success">Connected <?php echo $sql_error['Text']; ?></td>
        <?php else: $fail = TRUE ?>
            <td class="error">MySQL Error - <?php echo $sql_error['Text']; ?></td>
        <?php endif ?>
        </tr>
        <tr>
        <td>Database Exists</td>
        <?php $link = mysql_connect($db_host, $db_username, $db_password); ?>

        <?php if (!$sql_error = check_dbExists($db_name, $link)): ?>  
            <td class="success">Connection is good.</td>
        <?php else: $fail = TRUE ?>
            <td class="error">MySQL Error - <?php echo $sql_error['Text']; ?></td>
        <?php endif ?>
        </tr>
        <?php if ($sql_error['Code'] == 1049): ?>
        <tr>
        <td>Create Database</td>
        <?php if (!$sql_error = create_database($db_name, $db_host, $db_username, $db_password)): ?>  
            <td class="success">We were able to create the database - <?php echo $db_name; ?></td>
            <?php $fail = FALSE; ?>
        <?php else: $fail = TRUE ?>
            <td class="error">MySQL Error - <?php echo $sql_error['Text']; ?></td>
        <?php endif ?>
        </tr>
        <?php endif ?>
        <tr>
        <td>MySQL Version</td>
        <?php $mysqlVer = mysqlVerison($db_name, $db_host, $db_username, $db_password); ?>
        <?php if (version_compare($mysqlVer, '5.0.2', '>=')): ?>
            <?php $trigger = TRUE ?>
            <td class="success">Version <?php echo $mysqlVer; ?> - will attempt using TRIGGERS</td>
        <?php else: $trigger = FALSE ?>
            <td class="warning">Version <?php echo $mysqlVer; ?> - does not look like your verison supports TRIGGERS. We will use alt SQL. Device history will not be added to database.</td>
        <?php endif ?>
        </tr>

        <?php if ($trigger == TRUE): ?>
        <tr>
        <td>Trigger Check</td>
        <?php if( !$sql_error = checkTrigger($db_name, $db_host, $db_username, $db_password)): ?>
            <td class="success">User has TRIGGER access.</td>
        <?php else: $trigger = FALSE ?>
            <td class="warning">Will use alt SQL File. <?php echo $sql_error['Text']; ?></td>
        </tr>
        <?php endif ?>
        <?php endif ?>

        <?php if ($fail == FALSE): ?>
        <tr>
        <?php createDBConfig($db_name, $db_host, $db_username, $db_password); ?>
            <td>Config File</d>
            <td class="success">Config Setup.  Please change permissions back to readonly on config folder.</td>
        </tr>
        <?php endif ?>

        <?php if ($fail == FALSE): ?>
        <tr>
        <td>Setup Tables</td>
        <?php if (!$sql_error = setupDBTables($trigger, $db_name, $db_host, $db_username, $db_password)): ?>
            <td class="success">Tables Setup.</td>
            <?php $fail = FALSE ?>
        <?php else: $fail = TRUE ?>
            <td class="error">Error Creating Tables - <?php echo $sql_error['Text']; ?></td>
        <?php endif ?>
        </tr>
        <?php endif ?>
        </table>


        <?php if ($fail == TRUE): ?>
            <p class="error">Some database configs have failed. Please address the issues before moving on.</p>
        <?php else: ?>
            <p class="success">Database is setup.<br />
            <FORM method="post" action="?step=finish">
                <input class="button" type="submit" value="Next">
            </FORM>
        <?php endif ?>

        <FORM method="post" action="?step=db_details">
            <input class="back_button" type="submit" value="Back">
        </FORM>

        <div class="clear"></div>
        </div>

<?PHP
    break;
    case "finish";
?>
<title>EasyAPNS Installer - Finish</title>

    <div id="left-nav">
    <ul>
        <li>Welcome</li>
        <li>Push Server</li>
        <li>Environment</li>
        <li>Database</li>
        <li><b>Complete</b></li>
        </ul>
    </div>

    <div id="main">
    <h2>Finished - All Setup</h2>

    <p>Congratulations!  EasyAPNS has been installed and is ready to start pushing messages.</p>

    <p>You should remove the install directory and set the config directory back to readonly.</p>

    <div class="clear"></div>
    </div>

<?PHP
    break;
}
?>
    </div>
</div>
</body>
</html>