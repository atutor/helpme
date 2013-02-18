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

$help_id = $_GET['help_id'];
$member_id = $_GET['user_id'];
queryDB("REPLACE INTO %shelpme_user (`user_id`, `help_id`) VALUES ('%d','%d')", array(TABLE_PREFIX, $member_id, $help_id));

unset($_SESSION['message']);
?>