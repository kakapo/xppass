<?php

$GLOBALS['gLang'] = array(
	'title_install' => 'Installation Guide',
	'agreement_yes' => 'Agree',
	'agreement_no' => 'Not Agree',
	'notset' => 'Not limited',

	'message_title' => 'remind message',
	'error_message' => 'Error message',
	'message_return' => 'Back',
	'return' => 'Back',
	'install_wizard' => 'Installation Guide',
	'config_nonexistence' => 'The config file not exists!',
	'nodir' => 'The directory not exists!',
	'short_open_tag_invalid' => 'Sorry! Please set short_open_tag to On in php.ini file.',
	'writeable' => 'writeable',
	'unwriteable' => 'not writeable',
	'old_step' => 'Previout Step',
	'new_step' => 'Next Step',
	
	'database_errno_2003' => 'Error in connecting database. Please check the server address.',
	'database_errno_1044' => 'Error in connecting database. Please check the database name.',
	'database_errno_1045' => 'Error in connecting database. Please check the username and password.',
	'database_connect_error' => 'database connecting errors.',
	'database_errno_1064' => 'SQL spell errors',

	'dbpriv_createtable' => 'No CREATE TABLE privilege..',
	'dbpriv_insert' => 'No INSERT privilege.',
	'dbpriv_select' => 'No  SELECT privilege',
	'dbpriv_update' => 'No UPDATE privilege',
	'dbpriv_delete' => 'No DELETE privilege',
	'dbpriv_droptable' => 'No DROP TABLE privilege',
	'db_not_null' => 'The database exists. Please empty the database.',
	'db_drop_table_confirm' => 'The database will be empty, do you comfirm?',


	'step_env_check_title' => 'Start Checking',
	'step_env_check_desc' => 'Checking directory, file privilege',
	'step_db_init_title' => 'Database Installation',
	'step_db_init_desc' => 'Installing Database',
	
	'step1_file' => 'Directory',
	'step1_need_status' => 'Need Status',
	'step1_status' => 'Current Status',
	'not_continue' => 'Please recorrect all above in red color.',

	'tips_dbinfo' => 'Please insert database information.',
	'tips_dbinfo_comment' => '',
	'tips_admininfo' => 'Please insert administrator information',
	'step_install_check_title' => 'Installed successfully!',
	'step_install_check_desc' => 'Go to Login',

	'ext_info_succ' => 'Installed successfully!',
	'install_locked' => 'It is locked. You had installed Xppass. If you need to reinstall, please delete the file <br />/tmp/install.lock ',
	'error_quit_msg' => 'Please fix all the problems above and continue!',

	'step_set_params_title' => 'Setting run environment',
	'step_set_params_desc' => 'Setting Xppass',

	'click_to_back' => 'Go Back',
	'adminemail' => 'Administrator Email',
	'adminemail_comment' => 'use to send error message report',
	'dbhost_comment' => 'server address, defaults localhost',

	'sso_mode' => 'Single Sign-On Solution',
	'ssomode_label' => 'Online user data storage and share mode',
	'ssomode_invalid' => 'Please select one solution, you can change it after installation',
	'multitable' => 'multi-table for user table?',
	'multitable_label' => 'Hash store user data, defaults table number is 256',
	'multitable_invalid' => '',

	'dbinfo_dbhost_invalid' => 'The database server is empty or wrong formated',
	'dbinfo_dbname_invalid' => 'The database name is empty.',
	'dbinfo_dbuser_invalid' => 'The database username is empty.',
	'dbinfo_dbpw_invalid' => 'he database password is empty',

	'admininfo_invalid' => 'The administrator information is not complete.',
	'dbname_invalid' => 'The database name is empty.',

	'admin_invalid' => 'Your information is not complete.',
	'admininfo_founderpw_invalid' => 'The password can be null, and should be more than 6 charactor',
	'admininfo_founderpw2_invalid' => 'Two password are not the same',
	'admininfo_founderemail_invalid' => 'The email address is wrong!',

	'install_in_processed' => 'Installing...',
	'install_succeed' => 'Database installing finished，Next',

	'license' => '<div class="license">
	<h1>Xppass Installation Permission (The BSD License)</h1>
 <p>Copyright (c) 2009, Zhongshen Wu (kakapowu@gmail.com)
 All rights reserved.</p>
 <p>Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:</p>
<ol>
      <li>Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.</li>
     <li> Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.</li>
     <li> Neither the name of the <ORGANIZATION> nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.</li>
</ol>
  <p>THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.</p>
</div>',

	'i_agree' => 'I have read and agree with all above.',
	'supportted' => 'Supported',
	'unsupportted' => 'Not Supported',
	'max_size' => 'Max Sizes',
	'project' => 'Project',
	'XPpass_required' => 'Xppass basic settings',
	'XPpass_best' => 'Xppass best settings',
	'curr_server' => 'Current server',
	'env_check' => 'Checking environment',
	'os' => 'Operating System',
	'php' => 'PHP Version',
	'attachmentupload' => 'Upload attachments',
	'unlimit' => 'Not Limited',
	'version' => 'Version',
	'gdversion' => 'GD Library',
	'allow' => 'Allowed',
	'unix' => 'Likes Unix',
	'diskspace' => 'Disk Space',
	'priv_check' => 'Checking directory, file privilege',
	'func_depend' => 'Checking function dependency',
	'func_name' => 'Function/ Extended',
	'check_result' => 'Checking Result',
	'suggestion' => 'Suggestion',
	'advice_pdo' => 'Please check if pdo module is loaded?',
	'advice_pdo_mysql' => 'Please check if pdo_mysql is loaded',
	'advice_fopen' => 'The allow_url_fopen should be opened in php.ini file.',
	'advice_file_get_contents' => 'The allow_url_fopen should be opened in php.ini file.',
	'advice_file_put_contents' => 'The allow_url_fopen should be opened in php.ini file.',
	'advice_fsockopen' => 'The allow_url_fopen should be opened in php.ini file.',
	'advice_json' => 'Please check if json module is loaded?',
	'advice_mbstring' => 'Please check if mbstring module is loaded?',
	'advice_memcache' => 'Please check if  memcache module is loaded?',
	'none' => 'Null',

	'dbhost' => 'Database Server',
	'dbuser' => 'Database User',
	'dbpw' => 'Database Password',
	'dbname' => 'Database Name',

	'founderemail' => 'Administrator email',
	'founderpw' => 'Administrator password',
	'founderpw2' => 'Repeated password',

	'create_table' => 'Building Database',
	'succeed' => 'Successfully!',

	'method_undefined' => 'Undefined function',
	'database_nonexistence' => 'The database object not exists.',
);
$GLOBALS['gLang']['user'] = 'Passport';
$GLOBALS['gLang']['pwd'] = 'Password';
$GLOBALS['gLang']['validatecode'] = 'Validate Code';
$GLOBALS['gLang']['anotherone'] = 'Change';
$GLOBALS['gLang']['notclear'] = 'Change';
$GLOBALS['gLang']['autologin'] = 'Auto Sign on';
$GLOBALS['gLang']['signon'] = 'Sign on';
$GLOBALS['gLang']['signup'] = 'Sign up';
$GLOBALS['gLang']['forgetpwd'] = 'Forget your password?';
$GLOBALS['gLang']['emailorusername'] = 'Email/UserName';
$GLOBALS['gLang']['helpmsg1'] = 'Please insert your passport!';
$GLOBALS['gLang']['helpmsg2'] = 'Please insert your password!';
$GLOBALS['gLang']['usernotexist'] = 'The user not exist!';
$GLOBALS['gLang']['codeinvalid'] = "The validate code is wrong!";
$GLOBALS['gLang']['illegalsignon'] = "Illegal sign on!";
$GLOBALS['gLang']['pwdwrong'] = "The password is wrong!";
$GLOBALS['gLang']['userforbidden'] = "The user is forbidden!";
$GLOBALS['gLang']['invalidurl'] = "Invalid url!";
$GLOBALS['gLang']['regbyusername'] = "Registered by Username";
$GLOBALS['gLang']['regbyemail'] = "Registered by Email";
$GLOBALS['gLang']['email'] = "Email";
$GLOBALS['gLang']['username'] = "Username";
$GLOBALS['gLang']['comfirmpwd'] = "Comfirm Password";
$GLOBALS['gLang']['pwdquestion'] = "Protected question";
$GLOBALS['gLang']['selectaquestion'] = "Please select a question";
$GLOBALS['gLang']['q1'] = "What's name of my first school?";
$GLOBALS['gLang']['q2'] = "What's my favorite leisure sport?";
$GLOBALS['gLang']['q3'] = "Who is my favorite sportsman?";
$GLOBALS['gLang']['q4'] = "What's name of my favorites?";
$GLOBALS['gLang']['q5'] = "What's name of my favorite song?";
$GLOBALS['gLang']['q6'] = "What's name of my favorite food?";
$GLOBALS['gLang']['q7'] = "Who is my dearest lover?";
$GLOBALS['gLang']['q8'] = "What's name of my favorite film?";
$GLOBALS['gLang']['q9'] = "Which day is my mum's birthday?";
$GLOBALS['gLang']['q10'] = "When is my firt date?";
$GLOBALS['gLang']['youranswer'] = "Your answer is";
$GLOBALS['gLang']['realname'] = "Realname";
$GLOBALS['gLang']['nickname'] = "Nickname";
$GLOBALS['gLang']['sex'] = "Sex";
$GLOBALS['gLang']['boy'] = "Male";
$GLOBALS['gLang']['girl'] = "Female";
$GLOBALS['gLang']['reset'] = "Reset";
$GLOBALS['gLang']['back'] = "Back";
$GLOBALS['gLang']['userexist'] = "The username exist! Please change another one";
$GLOBALS['gLang']['userisok'] = "It is available!";
$GLOBALS['gLang']['insertpwd'] = "Please insert password!";
$GLOBALS['gLang']['insertemail'] = "Please insert a available email!";
$GLOBALS['gLang']['usernamerule'] = "The username consist of 3-15 characters(a-z), numbers(0-9) or (_). Begin with only characters!";
$GLOBALS['gLang']['pwdnotsame'] = "Two passwords are not the same!";
$GLOBALS['gLang']['nicknamerule'] = "The nickname is empty! Its length should be more than 2 characters, less than 16 characters!";
$GLOBALS['gLang']['sexrule'] = "Please choose the sex!";
$GLOBALS['gLang']['submit'] = "Submit";
$GLOBALS['gLang']['registered'] = "Congratulations! You have successfully registered";
$GLOBALS['gLang']['yourquestion'] = "Your Question";
$GLOBALS['gLang']['youranswer'] = "Your Answer";
$GLOBALS['gLang']['newpwd'] = "New Password";
$GLOBALS['gLang']['newpwd2'] = "New Password Again";
$GLOBALS['gLang']['insertyouranswer'] = "Please insert your answer!";
$GLOBALS['gLang']['pwdrule'] = "Password must be at least 6 characters long!";
$GLOBALS['gLang']['coderule'] = "Please insert validate code";
$GLOBALS['gLang']['realnamerule'] = "Please insert real name";

$GLOBALS['gLang']['pwdreset'] = "Congratulation! Your password has been reset!";
$GLOBALS['gLang']['failture'] = "Failture! Please try again!";
$GLOBALS['gLang']['answerwrong'] = "Sorry! Your answer is wrong!";
$GLOBALS['gLang']['emailsent'] = "Email had been sent! Please check it!";
$GLOBALS['gLang']['emailsendok'] = "Congratulation! It sent!";
$GLOBALS['gLang']['emailsubject'] = "Get Back Password";
$GLOBALS['gLang']['emailcontent'] = ' Dear &lt; %s &gt; ：<br>
				  You had applied for getting back your password! Please click the url and reset your new password! The url will be disabled after 60 minutes.<br>%s<br>%s';

$GLOBALS['gLang']['web-title'] = "Welcome to &quot;Xppass&quot; Single Sign-on System!";
$GLOBALS['gLang']['menu1'] = 'Index';
$GLOBALS['gLang']['menu2'] = 'Sign-on';
$GLOBALS['gLang']['menu3'] = 'Sign-up';
$GLOBALS['gLang']['menu4'] = 'Administrator';
$GLOBALS['gLang']['menu5'] = 'Help';
$GLOBALS['gLang']['menu6'] = 'Sign-out';
$GLOBALS['gLang']['selectlanguage'] = 'Select Language';
$GLOBALS['gLang']['zh-cn'] = 'Chinese (Simplified)';
$GLOBALS['gLang']['zh-tw'] = 'Chinese (Traditional)';
$GLOBALS['gLang']['en'] = 'English';
$GLOBALS['gLang']['nicknameexist'] = 'The nickname exist! Please change another.';

$GLOBALS['gLang']['run_mode'] = 'Application Running Status';
$GLOBALS['gLang']['app_status_label'] = 'If error occurs, all information will be output under development status; Error code number will be output and reporting email will be sent under production status.';
$GLOBALS['gLang']['timezone'] = 'Timezone';
$GLOBALS['gLang']['timezone_label'] = 'Defaults as system timezone';
$GLOBALS['gLang']['dev_status'] = 'Development Status';
$GLOBALS['gLang']['online_status'] = 'Production Status';
$GLOBALS['gLang']['menu_basicset'] = 'Basic Sets';
$GLOBALS['gLang']['menu_regset'] = 'Register Sets';
$GLOBALS['gLang']['menu_emailset'] = 'Email Sets';
$GLOBALS['gLang']['menu_client'] = 'Client Management';
$GLOBALS['gLang']['menu_user'] = 'User Management';

$GLOBALS['gLang']['system_info'] = 'System　Info.';
$GLOBALS['gLang']['os_php'] = 'OS and PHP Version';
$GLOBALS['gLang']['webserver'] = 'Webserver Software';
$GLOBALS['gLang']['mysql_version'] = 'MySQL Version';
$GLOBALS['gLang']['upload_size'] = 'Max Upload Sizes';
$GLOBALS['gLang']['mysql_datasize'] = 'Current Database Sizes';
$GLOBALS['gLang']['hostname'] = 'Host Name';

$GLOBALS['gLang']['double_nickname'] = 'Whether to prohibit duplicate nickname';
$GLOBALS['gLang']['yes'] = 'Yes';
$GLOBALS['gLang']['no'] = 'No';
$GLOBALS['gLang']['ban_email'] = 'Email address prohibited';
$GLOBALS['gLang']['ban_email_label'] = 'These domain names are prohibited. <br> Simply fill out email domain per line, for example, @hotmail.com';
$GLOBALS['gLang']['ban_username'] = 'Username prohibited';
$GLOBALS['gLang']['ban_username_label'] = 'You can set a wildcard(*), each keyword per line such as "*admin*" (without quotation(") marks).';

$GLOBALS['gLang']['email_from'] = 'From Email Address';
$GLOBALS['gLang']['email_from_label'] = 'Default email from';
$GLOBALS['gLang']['smtp_server'] = 'SMTP Server';
$GLOBALS['gLang']['smtp_server_label'] = 'SMTP server address.';
$GLOBALS['gLang']['smtp_port'] = 'SMTP Port';
$GLOBALS['gLang']['smtp_port_label'] = 'Defaults 25';
$GLOBALS['gLang']['smtp_account'] = 'SMTP Authentication Account';
$GLOBALS['gLang']['smtp_password'] = 'SMTP Authentication Password';
$GLOBALS['gLang']['search_domain'] = 'Search';
$GLOBALS['gLang']['add_domain'] = 'Add';
$GLOBALS['gLang']['new_domain'] = 'New Domain';
$GLOBALS['gLang']['domain'] = 'Domain';
$GLOBALS['gLang']['domain_list'] = 'Domain List';
$GLOBALS['gLang']['domain_delete_comfirm'] = 'The action can not be restored. Do you confirm to delete?';
$GLOBALS['gLang']['domain_password'] = 'Private Key';
$GLOBALS['gLang']['delete'] = 'Delete';
$GLOBALS['gLang']['domainexist'] = 'The domain already exists!';

$GLOBALS['gLang']['first_page'] = 'First Page';
$GLOBALS['gLang']['last_page'] = 'Last Page';
$GLOBALS['gLang']['next_page'] = 'Next Page';
$GLOBALS['gLang']['next_page'] = 'Previous Page';
$GLOBALS['gLang']['next_group'] = 'Next Group';
$GLOBALS['gLang']['pre_group'] = 'Previous Group';
$GLOBALS['gLang']['success'] = 'Successfully!';
$GLOBALS['gLang']['failed'] = 'Failed!';
$GLOBALS['gLang']['selectone'] = 'Please select one!';
$GLOBALS['gLang']['invaliddomain'] = 'Invalid domain!';

$GLOBALS['gLang']['search_user'] = 'Search User';
$GLOBALS['gLang']['add_user'] = 'Add User';
$GLOBALS['gLang']['reg_date'] = 'Register Date';
$GLOBALS['gLang']['to'] = 'To';
$GLOBALS['gLang']['user_list'] = 'User List';
$GLOBALS['gLang']['user_total'] = 'Total User';
$GLOBALS['gLang']['more'] = 'More';
$GLOBALS['gLang']['edit'] = 'Edit';
$GLOBALS['gLang']['view'] = 'View';
$GLOBALS['gLang']['admin_remind'] = '* administrator can not be deleted.';
$GLOBALS['gLang']['lastlogin'] = 'Last Login';
$GLOBALS['gLang']['edituser'] = 'Edit User';
$GLOBALS['gLang']['pwd_label'] = 'Password not change if it is blank.';
$GLOBALS['gLang']['user_label'] = 'Read Only';
$GLOBALS['gLang']['backtouserlist'] = 'Back to User List';
$GLOBALS['gLang']['user_center'] = 'User Center';
$GLOBALS['gLang']['index_name'] = 'PHP OpenSource SSO software--Xppass';
$GLOBALS['gLang']['feature'] = 'Features';
$GLOBALS['gLang']['feature_1'] = '1. Provide three solutions: Cookie、Session and Ticket, choose one according to requirement.';
$GLOBALS['gLang']['feature_2'] = '2. Use hash multi-table designment in supporting hundreds of millions of user data storage.';
$GLOBALS['gLang']['feature_3'] = '3. Provides two ways to register: user name and email.';
$GLOBALS['gLang']['feature_4'] = '4. To achieve security sign-on technology, using MD5 encrypted password in transmission and hmac authentication.';
$GLOBALS['gLang']['feature_5'] = '5. Automated installation program.';
$GLOBALS['gLang']['feature_6'] = '6. Supports multi-language versions.';
$GLOBALS['gLang']['cookie_solution'] = 'Cookie Solution';
$GLOBALS['gLang']['session_solution'] = 'Session solution';
$GLOBALS['gLang']['ticket_solution'] = 'Ticket solution';
$GLOBALS['gLang']['mentality'] = 'Mentality';
$GLOBALS['gLang']['advantage'] = 'Advantage';
$GLOBALS['gLang']['disadvantage'] = 'Disadvantage';
$GLOBALS['gLang']['cookie_mentality'] = '<ul><li>Online user data stored in the browser cookie.</li>
<li>User data transmission and storage using encryption</li>
<li>Sub-domain sharing decrypt arithmetic and password.</li>
</ul>';
$GLOBALS['gLang']['session_mentality'] = '<ul>
<li>Online users data stored in the server side.</li>
<li>Sub-domain application sharing the session id of root domain.</li>
<li>User data without encryption.</li>
<li>Webserver cluster use the database or memcached to share user data.</li>
</ul>';
$GLOBALS['gLang']['ticket_mentality'] = '<ul>
	<li>When the user visit Application Service (AS), AS determine whether the user has logged locally. If no, AS call SSO client api to access sso server, taking a digital signature, user_name, and domain information.
</li>
<li>When SSO server receives the information from the client, it certified the legality of the signature verification first, 
and then determine whether user_name exists in session. If yes, it return session id (as ticket), or redirecting to login page.
</li>
<li>	
After the user logged in successfully at authentication center, SSO server saved user data in session. Then jump back to application service, URL belt with ticket (session id).
</li>
<li>	
The SSO client, take ticket, domain, and signature (the signature encrypted by the ticket) to visited the SSO Server. SSO Server authorizes first, and then returns the encrypted data named as user token.
</li>
<li>	
User data is encrypted in transmission. SSO client uses the private key to decrypt the token data.
</li>
<li>	
If the user has been logged in step 3, and then skip this step.</li>
<ul>';

$GLOBALS['gLang']['cookie_advantage'] = 'Simple, Safe, to avoid webserver cluster problem, such as sharing user data';
$GLOBALS['gLang']['session_advantage'] = 'Very Safe, be able to resolve webserver cluster problem.';
$GLOBALS['gLang']['ticket_advantage'] = 'Cross-domain,　very Safe.';
$GLOBALS['gLang']['cookie_disadvantage'] = 'Non-cross-domain,the size of cookie data is limited.';
$GLOBALS['gLang']['session_disadvantage'] = 'Non-cross-domain, a little complicated.';
$GLOBALS['gLang']['ticket_disadvantage'] = 'Complicated, need clients';

$GLOBALS['gLang']['menu_onlineuser'] = 'Online Users';
$GLOBALS['gLang']['online_length'] = 'Expiry Time';
$GLOBALS['gLang']['module_ban'] = 'This module is only active under ticket solution.';
?>