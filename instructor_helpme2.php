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

global $msg, $_base_href, $savant,$_base_path;
$current_help = queryDB("SELECT help_id FROM %shelpme_user WHERE user_id ='%d'", array(TABLE_PREFIX, $member_id), true);
$myhelp = "";

if($current_help['help_id'] <= $helpme_total){
    if($_SESSION['course_id'] == 0){
        $myhelp .= helpme_msg('CREATE_COURSE', $_base_path."mods/_core/courses/users/create_course.php");

    } else if ($_SESSION['course_id'] > 0){
        $myhelp .= helpme_msg('COURSE_TOOLS', $_base_href."mods/_standard/course_tools/modules.php");
        $myhelp .= helpme_msg('COURSE_PROPERTIES', $_base_path."mods/_core/properties/course_properties.php");
        $myhelp .= helpme_msg('CREATE_CONTENT', $_base_href."mods/_core/editor/add_content.php");
        $myhelp .= helpme_msg('ADD_USERS', $_base_href."mods/_core/enrolment/create_course_list.php");
        $myhelp .= helpme_msg(array('CREATE_BACKUP', $_base_href.'mods/_core/backups/create.php',$_base_href.'mods/_core/imscp/index.php '), ''); 
        $myhelp .= helpme_msg(array('READ_HANDBOOK', '<a target="_new" onclick="ATutor.poptastic(\''.$_base_href.'documentation/instructor/index.php?en\'); return false;" href="documentation/index_list.php?lang=en">'._AT('atutor_handbook').'</a>', $_base_href.'help/index.php'),'');
    }

    if($next_help ==0) $next_help = 1;
    $savant->assign('helpme_count', $next_help);
    $savant->assign('helpme_total', $helpme_total);
}
?>