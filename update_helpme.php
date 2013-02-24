<?php
/************************************************************************/
/* ATutor																*/
/************************************************************************/
/* Copyright (c) 2013                                                   */
/* ATutorSpaces                                                         */
/* https://atutorspaces.com                                             */
/* This program is free software. You can redistribute it and/or        */
/* modify it under the terms of the GNU General Public License          */
/* as published by the Free Software Foundation.                        */
/************************************************************************/
define('AT_INCLUDE_PATH', '../../include/');
require_once(AT_INCLUDE_PATH.'vitals.inc.php');

if(isset($_GET['next_helpme'])){
     $help_id = $_GET['next_helpme'];
}else{
     $help_id = $_GET['help_id'];
}

if(isset($_GET['user_id'])){
    $member_id = $_GET['user_id'];
} else {
    $member_id = $_SESSION['member_id'];
}

if(isset($_GET['help_id'])){
    queryDB("REPLACE INTO %shelpme_user (`user_id`, `help_id`) VALUES ('%d','%d')", array(TABLE_PREFIX, $member_id, $help_id));
} 
/*
else if(isset($_GET['next_helpme'])){
    //echo "<h2>this is some HTML</h2>";

    global $_base_href, $msg;
   // phpinfo();
    //require($_base_href."mods/helpme/next.php?get_next=1;next_helpme=".($help_id+1).";user_id=".$member_id);

   // header("Location:".$_base_href."mods/helpme/instructor_helpme.php?user_id=1;help_id=7");
   // unset($_SESSION['message']);
   //helpme_msg(array('CREATE_BACKUP', $_base_href.'mods/_core/backups/create.php',$_base_href.'mods/_core/imscp/index.php '), '');  
             $msg->printAll();


}
*/

unset($_SESSION['message']);
?>