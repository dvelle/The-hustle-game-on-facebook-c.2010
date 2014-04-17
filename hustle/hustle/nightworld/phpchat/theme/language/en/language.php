<?php

$lang['title'] = 'Free PHP Chat Module - Add a chat room to your PHP website - Seamless Integrate 123 Flash Chat Software with PHP Website';
$lang['select_mode_free'] = 'Host chat room free of charge by 123flashchat.com';
$lang['select_mode_host'] = 'Host chat room by 123flashchat official website';
$lang['select_mode_local'] = 'Host chat room on local server';
$lang['select_mode_3rd'] = 'Use the professional 3rd part module';
$lang['fill_room_name'] = 'Please fill the parameter of room name in the following blank';
$lang['param_room_name'] = 'Room Name';
$lang['fill_host_address'] = 'Please fill the parameter of host address in the following blank';
$lang['param_host_address'] = 'Host Client Location:';
$lang['fill_local_address'] =  'Please fill the parameter of local chat server installed directory in the following blank';
$lang['param_local_address'] = 'Chat Server Path:';
$lang['enable_integration'] = 'Do you want to integrate with your database.';
$lang['select_integration_mode'] = 'Please select integration mode.';
$lang['set_db_tip'] = 'Please  configure the database connecting parameters.';
$lang['3rd_part_tip'] = '123 Flash Chat can seamlessly integrate your website or database like Joomla, phpBB, vBulletin, etc. Please select website integration module.';
$lang['install_cancel'] = 'Notice: Sice you select 3rd part module,  it is not necessary for you to install PHP Chat';
$lang['select_db'] = 'Please select your database type';
$lang['move_file_s1'] = ' I want copy it by myself';
$lang['move_file_s1_tip'] = ' Notice: Please have a look at "Configure Instruction" part';
$lang['move_file_s2'] = ' I want to copy it automatically';
$lang['move_file'] = 'Please copy the client folder from chat installed directory';
$lang['login_chat'] = 'Please follow the instruction to integrate user data into your chat admin panel';
$lang['restart_chat'] = 'Please restart your chat server';
$lang['restart_chat_s1'] = 'Auto restart the server';
$lang['restart_chat_s2'] = 'I want to restart it by myself';
$lang['restart_chat_s2_tip'] = 'Please have a look at "configure instruction"';
$lang['unmove_install_attention'] = 'Attention: please remove the install folder';


//--------------------------------error meg--------------------------
$lang['install_error'] = 'PHP Chat install is not successful';
$lang['error_free_room_name'] = 'Please enter chat room name';
$lang['error_host_address'] = 'Please verify your chat host address';
$lang['error_local_server_address'] = 'Please enter a correct local chat server installed path';
$lang['error_local_server_xml'] = ', the file does not exist';
$lang['error_mkdir_configure'] = 'configure folder does not exist';
$lang['error_config_writable'] = 'phpchat/configure/config.php is not writeable';
$lang['error_install_writable'] = 'phpchat/install is not writeable';
$lang['error_local_server_xml_writable'] = ', the file is not writeable';
$lang['error_full_db_param'] = 'Please verify database parameter';
$lang['error_php_module'] = ' module is not loaded in php.ini, so you can not use the database module';
$lang['error_db_table'] = 'User list table does not exist, please make sure the value of table name, Username field, Password field are correct.';



//----------------------------------tip word-------------------------------------
$lang['tip_room_name'] = 'Fill in your favorable room name and click "next" to complete installation';
$lang['tip_host_address'] = 'http://yourHostServerAddress/yourHostName/';
$lang['tip_local_address'] = '<123FlashChat installed directory>/123 Flash Chat ServerX.X/, for example:C:\Program Files\123FlashChatServer7.4 ';							
$lang['tip_integration_yes'] = 'Integrate with database';
$lang['tip_integration_no'] = 'Not integrate with database';
$lang['tip_integration_mode'] = 'Please select integration mode.';
$lang['tip_integration_db'] = 'Please select database type';
$lang['tip_param_db_host'] = 'You need to fill in your database host server ip address. If the database is installed on your local machine, please fill in with "localhost"';	
$lang['tip_param_db_port'] = 'You need to fill in your database host server port. If you are using default port, please leave it blank';
$lang['tip_param_db_name'] = 'You need to fill in database name.';
$lang['tip_param_db_username'] = 'You need to fill in the database username which is allowed to access the database. ';	
$lang['tip_param_db_password'] = 'You need to fill in the database password which is allowed to access the database. ';
$lang['tip_param_db_user_table'] = 'You need to fill in database user list table name of the integrated website.';	
$lang['tip_param_uesrname_field'] = 'You need to fill in its relevant username table name stored in the user list.';
$lang['tip_param_pw_field'] = ' You need to fill in its relevant password table name stored in the user list.';
$lang['tip_param_enablemd5'] = 'This item provides Encryption judgement. In your database, if the user password is encrypted with md5, you should set this item "on". Only do this can it identify he user password is encrypted with md5. If your encryption is not md5 or there is addtional salt parameter, you should go to the API to add your own encryption function.';




//----------------------------------instruction-------------------------------------


$lang['instruction_title'] = 'PHP Chat Instruction';
$lang['instruction_content'] = <<<END
    123 Flash Chat PHP Chat 3rd party module can make your website has its own flash chat room. It also can integrate your website's databases through simple configuration. It is a totally free third party plug-in component.<BR>
	
	Module Support: 
	<a href="http://www.123flashchat.com" target="_blank">www.123flashchat.com->Support Topic</a>
  <a href="http://www.topcmm.com" target="_blank">www.topcmm.com->Support Helpdesk </a>
END;


$lang['instruction_title_setup'] = 'Mode Instruction';
$lang['instruction_content_setup'] = <<<END
If your website comply with the cms, forum,.etc and its type is included in modules selection lists, we recommend you to use 3rd party module for integration because the particular 3rd party module can save your efforts in integration.
END;


$lang['instruction_others_t'] = 'PHP Chat Mode Instruction';
$lang['instruction_others_c'] = <<<END
PHP Chat offers you three integration modules to meet your different requirements for your website chat room.

1) Free mode. If you select Free mode, all you need to do is configure, fill in your room name and complete installation, Then 123flash.com will offer a free chat room for your website. 

2), Only the user who host chat room by 123flashchat.com should choose Host mode. If so, it is very easy for you to integrate host chat room to your website so long as you write your host address and the relevant database information Host mode install instruction.

3) Local mode.If you select Local mode, you should download 123 Flash Chat server software at http://www.123flashchat.com/download.html, fill in your 123 Flash Chat installation address and the relevant database info to integrate the local 123 Flash Chat to your website. Local mode install instruction.
END;

$lang['instruction_param_conf'] = 'Configure Instruction';
$lang['instruction_param_conf_free'] = <<<END
 Fill in your favorable room name and click "next" to complete installation
END;


$lang['instruction_param_conf_host'] = <<<END
The host address format is as follows:

http://yourHostServerAddress/yourHostName/
e.g: http://host71200.123flashchat.com/phpchat/

If you fill in it with a wrong format, you are not able to do the next operation.  
END;




$lang['instruction_param_host_inter'] = <<<END
If you select "No", it indicates that you don\'t want to integrate with database. The chat room and user information will be stored into our database. If the user want to log in chat room, he or she must register with new id or log in with guest.

If you select "yes", it indicates that you want to integrate with the website database and you have to configure the following items.
END;




$lang['instruction_param_conf_local'] = <<<END
 Please download and install 123 Flash Chat, we recommend you to use the version contain JRE

Chat Server Path format should be as below

<123FlashChat installed direcotyr>\123FlashChatServerX.X\
For example
Windows: D:\Program Files\123FlashChatServer7.4\
Linux:      \usr\local\share\123FlashChatServer7.4\

If you fill in it with a wrong format, you are not able to do the next operation. 
END;

$lang['instruction_local_move_file']= <<<END
1), Please select the way how to copy the chat client. We recommend you copy the chat client not automatically but manually, because it really takes time by script! 

    Manually copy mode: search for 123 Flash Chat installation directory and copy the client files to the PHP Chat installation directory. 

2), Please select the way of restarting the 123 Flash Chat server. Auto-start is only available to the version 7.4 or higher version.

Manually restart method:
Windows: search for 123 Flash Chat installation directory, you will see the restart.bat under the server folder, double click it.
Linux: search for 123 Flash Chat installation directory, find the fcserver.sh under the server folder,
			 then type command "./fcserver.sh restart" and press "Enter" with root account.
END;
?>