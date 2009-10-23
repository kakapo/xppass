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
	
	'database_errno_2003' => '无法连接数据库，请检查数据库是否启动，数据库服务器地址是否正确',
	'database_errno_1044' => '无法创建新的数据库，请检查数据库名称填写是否正确',
	'database_errno_1045' => '无法连接数据库，请检查数据库用户名或者密码是否正确',
	'database_connect_error' => '数据库连接错误',
	'database_errno_1064' => 'SQL 语法错误',

	'dbpriv_createtable' => '没有CREATE TABLE权限，无法继续安装',
	'dbpriv_insert' => '没有INSERT权限，无法继续安装',
	'dbpriv_select' => '没有SELECT权限，无法继续安装',
	'dbpriv_update' => '没有UPDATE权限，无法继续安装',
	'dbpriv_delete' => '没有DELETE权限，无法继续安装',
	'dbpriv_droptable' => '没有DROP TABLE权限，无法安装',
	'db_not_null' => '数据库中已经安装过 Xppass, 继续安装会清空原有数据。',
	'db_drop_table_confirm' => '继续安装会清空全部原有数据，您确定要继续吗?',


	'step_env_check_title' => '开始安装',
	'step_env_check_desc' => '环境以及文件目录权限检查',
	'step_db_init_title' => '安装数据库',
	'step_db_init_desc' => '正在执行数据库安装',
	
	'step1_file' => '目录文件',
	'step1_need_status' => '所需状态',
	'step1_status' => '当前状态',
	'not_continue' => '请将以上红叉部分修正再试',

	'tips_dbinfo' => '填写数据库信息',
	'tips_dbinfo_comment' => '',
	'tips_admininfo' => '填写管理员信息',
	'step_install_check_title' => '安装成功',
	'step_install_check_desc' => '点击进入登陆',

	'ext_info_succ' => '安装成功',
	'install_locked' => '安装锁定，已经安装过了，如果您确定要重新安装，请到服务器上删除<br />/tmp/install.lock ',
	'error_quit_msg' => '您必须解决以上问题，安装才可以继续',

	'step_set_params_title' => '设置运行环境',
	'step_set_params_desc' => '设置 Xppass',

	'click_to_back' => '点击返回上一步',
	'adminemail' => '系统信箱 Email',
	'adminemail_comment' => '用于发送程序错误报告',
	'dbhost_comment' => '数据库服务器地址, 一般为 localhost',
	'tablepre_comment' => '同一数据库运行多个论坛时，请修改前缀',
	'forceinstall_check_label' => '我要删除数据，强制安装 !!!',

	'sso_mode' => 'Single Sign-On Solution',
	'ssomode_label' => 'Online user data storage and share mode',
	'ssomode_invalid' => '选择一种方案，可修改。',
	'multitable' => '是否分表',
	'multitable_label' => '将用户数据分散存储，默认数256个',
	'multitable_invalid' => '',

	'dbinfo_dbhost_invalid' => '数据库服务器为空，或者格式错误，请检查',
	'dbinfo_dbname_invalid' => '数据库名为空，或者格式错误，请检查',
	'dbinfo_dbuser_invalid' => '数据库用户名为空，或者格式错误，请检查',
	'dbinfo_dbpw_invalid' => '数据库密码为空，或者格式错误，请检查',

	'admininfo_invalid' => '管理员信息不完整，请检查管理员账号，密码，邮箱',
	'dbname_invalid' => '数据库名为空，请填写数据库名称',

	'admin_invalid' => '您的信息管理员信息没有填写完整，请仔细填写每个项目',
	'admininfo_founderpw_invalid' => '管理员密码不能为空，并且不能少于6位',
	'admininfo_founderpw2_invalid' => '两次密码不一致，请检查',
	'admininfo_founderemail_invalid' => '创始人邮箱地址格式错误，请检查',

	'install_in_processed' => '正在安装...',
	'install_succeed' => '数据安装成功，下一步',

	'license' => '<div class="license">
	<h1>Xppass 安装许可证</h1>

<h3>感谢您选择 Xppass 单点登录系统。</h3>

<p>Copyright (c) 2009 著作权由吴仲深(kakapowu@gmail.com)所有。著作权人保留一切权利。</p>

<p>这份授权条款，在使用者符合以下三条件的情形下，授予使用者使用及再散播本软件原代码及二进位代码的权利，无论此包装是否经改作皆然：<p>
<ol>
<li> 对于本软件源代码的再散播，必须保留上述的版权宣告、此三条件表列，以及下述的免责声明。</li>
<li> 对于本套件二进位可执行形式的再散播，必须连带以文件以及／或者其他附于散播包装中的媒介方式，重制上述之版权宣告、此三条件表列，以及下述的免责声明。</li>
<li> 未获事前取得书面许可，不得使用柏克莱加州大学或本软件贡献者之名称，来为本软件之衍生物做任何表示支持、认可或推广、促销之行为。</li>
</ol>
<p>
免责声明：本软件是由本软件之贡献者以现状（"as is"）提供，本软件包装不负任何明示或默示之担保责任，包括但不限于就适售性以及特定目的的适用性为默示性担保。本软件之贡献者，无论任何条件、无论成因或任何责任、无论此责任为因合约关系、无过失责任或因非违约之侵权（包括过失或其他原因等）而起，对于任何因使用本软件包装所产生的任何直接性、间接性、偶发性、特殊性、惩罚性或任何结果的损害（包括但不限于替代商品或劳务之购用、使用损失、资料损失、利益损失、业务中断等等），不负任何责任，即在该种使用已获事前告知可能会造成此类损害的情形下亦然。
</p>
</div>',

	'i_agree' => '我已仔细阅读，并同意上述条款中的所有内容',
	'supportted' => '支持',
	'unsupportted' => '不支持',
	'max_size' => '支持/最大尺寸',
	'project' => '项目',
	'XPpass_required' => 'Xppass 所需配置',
	'XPpass_best' => 'Xppass 最佳',
	'curr_server' => '当前服务器',
	'env_check' => '环境检查',
	'os' => '操作系统',
	'php' => 'PHP 版本',
	'attachmentupload' => '附件上传',
	'unlimit' => '不限制',
	'version' => '版本',
	'gdversion' => 'GD 库',
	'allow' => '允许',
	'unix' => '类Unix',
	'diskspace' => '磁盘空间',
	'priv_check' => '目录、文件权限检查',
	'func_depend' => '函数对象依赖性检查',
	'func_name' => '函数/扩展名称',
	'check_result' => '检查结果',
	'suggestion' => '建议',
	'advice_pdo' => '请检查 pdo 模块是否正确加载',
	'advice_pdo_mysql' => '请检查 pdo_mysql 模块是否正确加载',
	'advice_fopen' => '该函数需要 php.ini 中 allow_url_fopen 选项开启。请联系空间商，确定开启了此项功能',
	'advice_file_get_contents' => '该函数需要 php.ini 中 allow_url_fopen 选项开启。请联系空间商，确定开启了此项功能',
	'advice_file_put_contents' => '该函数需要 php.ini 中 allow_url_fopen 选项开启。请联系空间商，确定开启了此项功能',
	'advice_fsockopen' => '该函数需要 php.ini 中 allow_url_fopen 选项开启。请联系空间商，确定开启了此项功能',
	'advice_json' => '请检查 json 模块是否正确加载',
	'advice_mbstring' => '请检查 mbstring 模块是否正确加载',
	'advice_memcache' => '请检查 memcache 模块是否正确加载',
	'none' => '无',

	'dbhost' => '数据库服务器',
	'dbuser' => '数据库用户名',
	'dbpw' => '数据库密码',
	'dbname' => '数据库名',

	'founderemail' => '创始人电子邮箱',
	'founderpw' => '创始人密码',
	'founderpw2' => '重复创始人密码',

	'create_table' => '建立数据表',
	'succeed' => '成功',

	'method_undefined' => '未定义方法',
	'database_nonexistence' => '数据库操作对象不存在',
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

$GLOBALS['gLang']['double_nickname'] = 'Whether to allow duplicate nickname';
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
?>