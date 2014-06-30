<?php
/*******
 * doesn't allow this file to be loaded with a browser.
 */
if (!defined('AT_INCLUDE_PATH')) { exit; }

/******
 * this file must only be included within a Module obj
 */
if (!isset($this) || (isset($this) && (strtolower(get_class($this)) != 'module'))) { exit(__FILE__ . ' is not a Module'); }
global $_base_href;

/*******
 * assign the instructor and admin privileges to the constants.
 */
//define('AT_PRIV_HELPME',       $this->getPrivilege());
define('AT_ADMIN_PRIV_HELPME', $this->getAdminPrivilege());

/*******
 * add the admin pages when needed.
 */
if (admin_authenticate(AT_ADMIN_PRIV_HELPME, TRUE) || admin_authenticate(AT_ADMIN_PRIV_ADMIN, TRUE)) {
    $this->_pages[AT_NAV_ADMIN] = array('mods/helpme/index_admin.php');
    $this->_pages['mods/helpme/index_admin.php']['title_var'] = 'helpme';
    $this->_pages['mods/helpme/index_admin.php']['parent']    = AT_NAV_ADMIN;
}
if (admin_authenticate(AT_ADMIN_PRIV_ADMIN, TRUE)) {
global $helpme_total;
$helpme_total = '10'; 
}

if($_SESSION['is_admin']){
global $helpme_total;
$helpme_total = '7'; 
}
global $_config, $_custom_head;
$helpme_enabled = queryDB("SELECT dir_name from %smodules WHERE dir_name='helpme' && status='2'", array(TABLE_PREFIX), TRUE);

if(!empty($helpme_enabled)){
	if(!isset($_config['disable_helpme'])){
		require("helpme_js.php");
		if($_SESSION['course_id'] == '-1'){
			//Admin 
			require("admin_helpme.php");
		} else if($_SESSION['member_id']) {
			//Instructor
			$is_instructor = queryDB("SELECT status FROM %smembers WHERE member_id='%d' AND status='3'", array(TABLE_PREFIX, $_SESSION['member_id']), true);
			if(!empty($is_instructor)){
			   require("instructor_helpme.php");
			} else{
			// student
			}
		}
	}	
}
function helpme_msg($helpmsg, $help_url){
    global $msg;
    if($_SESSION['valid_user']){
		if(is_array($helpmsg)){
			$msg->addHelp($helpmsg);
		}else{
			$msg->addHelp(array($helpmsg, $help_url));
		}
    } 
}

?>