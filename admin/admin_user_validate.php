<?php// The source code packaged with this file is Free Software, Copyright (C) 2005 by// Ricardo Galli <gallir at uib dot es>.// It's licensed under the AFFERO GENERAL PUBLIC LICENSE unless stated otherwise.// You can get copies of the licenses here:// affero.org: Affero General Public License version 1 (AGPLv1)// AFFERO GENERAL PUBLIC LICENSE is also included in the file called "COPYING".include_once('../Smarty.class.php');$main_smarty = new Smarty;include('../config.php');include(mnminclude.'html1.php');include(mnminclude.'user.php');include(mnminclude.'smartyvariables.php');include(mnminclude.'admin_config.php');global $db;check_referrer();force_authentication();$canIhaveAccess = 0;$canIhaveAccess = $canIhaveAccess + checklevel('admin');if($canIhaveAccess == 0){//	$main_smarty->assign('tpl_center', '/admin/access_denied');//	$main_smarty->display($template_dir . '/admin/admin.tpl');		header("Location: " . getmyurl('login', $_SERVER['REQUEST_URI']));	die();} // sidebar$main_smarty = do_sidebar($main_smarty);	if(isset($_REQUEST['id'])){		$user_id = $_REQUEST['id'];		if(is_numeric($user_id)){			$user = new User;			$user->id=$user_id;			$user->read();			$db->query(" UPDATE ".table_users." SET `user_modification` = NOW() , `user_lastlogin` = NOW() WHERE `user_id` =".$user_id." LIMIT 1 ");			echo '<div style="padding:8px;margin:14px 2px;border:1px solid #bbb;background:#eee;">    <h2 style="font-size: 18px;margin:0;padding:0;border-bottom:1px solid #629ACB;">Success!</h2>    <p style=\'font:13px arial, "Lucida Grande","Lucida Sans Unicode",Tahoma,Verdana,sans-serif;\'><strong> '.$user->username.'</strong>\'s email address has been confirmed.</p></div>';		}		else die;	}// pagenamedefine('pagename', 'admin_user_validate');$main_smarty->assign('pagename', pagename);?>