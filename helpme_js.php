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


global $_custom_head, $_base_href, $current_help, $savant;

if($_SESSION['member_id']){
    $member_id = $_SESSION['member_id'];
}else if($_SESSION['course_id'] == '-1'){
    $member_id = '-1';
} 

$current_help = queryDB("SELECT help_id FROM %shelpme_user WHERE user_id ='%d'", array(TABLE_PREFIX, $member_id), true);

if(!empty($current_help)){
    $next_help = ($current_help['help_id'] + '1');
}else{
    $next_help = '1';
}

if($_SESSION['valid_user']){
        $_custom_head .="
<link rel=\"stylesheet\" href=\"".$_base_href."mods/helpme/module.css\" type=\"text/css\" />
<script type=\"text/javascript\">
    jQuery(document).ready(function(){ 
       $(\"#delete\").click(function(){
        $(this).parents(\".divClass\").animate({ opacity: 'hide' }, \"slow\");
      });
       $(\"#delete\").click(function(){
        saveData();
        });
    });
    function saveData(){  
    $.ajax({
        type: \"GET\",
        url: \"".$_base_href."mods/helpme/update_helpme.php\",
        data: { user_id: \"".$member_id."\", help_id: \"".$next_help."\" }
        }).done(function( msg ) {
        $('#delete').append(data);
               /* alert( \"Data was saved: \" + \"".$_base_href."mods/helpme/update_helpme.php\" +  \"".$member_id."\" +  \"".$next_help."\");*/
              /*  $(\".divClass\").load(\"".$_base_href."mods/helpme/update_helpme.php?user_id=".$member_id."&next_helpme=".$next_help."\").animate({ opacity: 'show' }, \"10000\"); */
           /* alert( \"Data was saved: \" + \"".$_base_href."mods/helpme/update_helpme.php\" +  \"".$member_id."\" +  \"".($next_help+1)."\" ); */
        });
    }
</script>";
}
?>