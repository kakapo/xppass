<?php

$GLOBALS['gLang'] = array(
	'title_install' => ' 安装向导',
	'agreement_yes' => '我同意',
	'agreement_no' => '我不同意',
	'notset' => '不限制',

	'message_title' => '提示信息',
	'error_message' => '错误信息',
	'message_return' => '返回',
	'return' => '返回',
	'install_wizard' => '安装向导',
	'config_nonexistence' => '配置文件不存在',
	'nodir' => '目录不存在',
	'short_open_tag_invalid' => '对不起，请将 php.ini 中的 short_open_tag 设置为 On，否则无法继续安装。',
	'writeable' => '可写',
	'unwriteable' => '不可写',
	'old_step' => '上一步',
	'new_step' => '下一步',
	
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

	'sso_mode' => '单点登录解决方案',
	'ssomode_label' => '在线用户数据存储和共享方式',
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
$GLOBALS['gLang']['user'] = '帳號';
$GLOBALS['gLang']['pwd'] = '密碼';
$GLOBALS['gLang']['validatecode'] = '驗證碼';
$GLOBALS['gLang']['anotherone'] = '換一張';
$GLOBALS['gLang']['notclear'] = '看不清';
$GLOBALS['gLang']['autologin'] = '記住我';
$GLOBALS['gLang']['signon'] = '登錄';
$GLOBALS['gLang']['signup'] = '注冊';
$GLOBALS['gLang']['forgetpwd'] = '忘記密碼';
$GLOBALS['gLang']['emailorusername'] = '用戶郵箱/用戶名';
$GLOBALS['gLang']['helpmsg1'] = '請輸入您的帳號!';
$GLOBALS['gLang']['helpmsg2'] = '請輸入您的密碼!';
$GLOBALS['gLang']['usernotexist'] = '此用戶不存在!';
$GLOBALS['gLang']['codeinvalid'] = "驗證碼錯誤!";
$GLOBALS['gLang']['illegalsignon'] = "非法登錄!";
$GLOBALS['gLang']['pwdwrong'] = "密碼錯誤!";
$GLOBALS['gLang']['userforbidden'] = "此用戶被禁止!";
$GLOBALS['gLang']['invalidurl'] = "無效地址!";
$GLOBALS['gLang']['regbyusername'] = "采用用戶名注冊";
$GLOBALS['gLang']['regbyemail'] = "采用電子郵箱注冊";
$GLOBALS['gLang']['email'] = "電子郵箱";
$GLOBALS['gLang']['username'] = "用戶名";
$GLOBALS['gLang']['comfirmpwd'] = "確認密碼";
$GLOBALS['gLang']['pwdquestion'] = "密碼保護問題";
$GLOBALS['gLang']['selectaquestion'] = "請選擇一個問題";
$GLOBALS['gLang']['q1'] = "我就讀第一所學校的名稱？";
$GLOBALS['gLang']['q2'] = "我最喜歡的休閑運動是什么？";
$GLOBALS['gLang']['q3'] = "我最喜歡的運動員是誰？";
$GLOBALS['gLang']['q4'] = "我最喜歡的物品的名稱？";
$GLOBALS['gLang']['q5'] = "我最喜歡的歌曲？";
$GLOBALS['gLang']['q6'] = "我最喜歡的食物？";
$GLOBALS['gLang']['q7'] = "我最愛的人的名字？";
$GLOBALS['gLang']['q8'] = "我最愛的電影？";
$GLOBALS['gLang']['q9'] = "我媽媽的生日？";
$GLOBALS['gLang']['q10'] = "我的初戀日期？";
$GLOBALS['gLang']['youranswer'] = "您的答案";
$GLOBALS['gLang']['realname'] = "姓名";
$GLOBALS['gLang']['nickname'] = "昵稱";
$GLOBALS['gLang']['sex'] = "性別";
$GLOBALS['gLang']['boy'] = "男";
$GLOBALS['gLang']['girl'] = "女";
$GLOBALS['gLang']['reset'] = "重置";
$GLOBALS['gLang']['back'] = "返回";
$GLOBALS['gLang']['userexist'] = "此帳號已經存在！請換一個";
$GLOBALS['gLang']['userisok'] = "此帳號可用！";
$GLOBALS['gLang']['insertpwd'] = "輸入密碼！";
$GLOBALS['gLang']['insertemail'] = "請輸入有效的郵箱！";
$GLOBALS['gLang']['usernamerule'] = "用戶名只能由3-15位字母(a-z)、數字(0-9)或下劃線(_)構成，并且只能以字母開頭！";
$GLOBALS['gLang']['pwdnotsame'] = "兩個密碼不一致！";
$GLOBALS['gLang']['nicknamerule'] = "昵稱不能為空，長度在2-16個字";
$GLOBALS['gLang']['sexrule'] = "請選擇性別！";
$GLOBALS['gLang']['submit'] = "提交";
$GLOBALS['gLang']['registered'] = "祝賀！您已經成功注冊！";
$GLOBALS['gLang']['yourquestion'] = "您的密碼保護問題";
$GLOBALS['gLang']['youranswer'] = "請輸入您的答案";
$GLOBALS['gLang']['newpwd'] = "輸入新密碼";
$GLOBALS['gLang']['newpwd2'] = "再次輸入新密碼";
$GLOBALS['gLang']['insertyouranswer'] = "請輸入您的答案";
$GLOBALS['gLang']['pwdrule'] = "密碼長度要大于6位";
$GLOBALS['gLang']['coderule'] = "請輸入驗證碼";
$GLOBALS['gLang']['realnamerule'] = "請輸入真實姓名";

$GLOBALS['gLang']['pwdreset'] = "祝賀！您的密碼已經更新成功。";
$GLOBALS['gLang']['failture'] = "失敗！請重試。";
$GLOBALS['gLang']['answerwrong'] = "對不起！答案錯誤。";
$GLOBALS['gLang']['emailsent'] = "郵件已發送！請查收。";
$GLOBALS['gLang']['emailsendok'] = "祝賀！發送成功。";
$GLOBALS['gLang']['emailsubject'] = "找回密碼";
$GLOBALS['gLang']['emailcontent'] = '親愛的 &lt; %s &gt; ：<br>
				 您申請了找回密碼服務！ 請點擊下面的地址，然后重置您的密碼。此地址60分鐘后失效。<br>%s<br>%s';

$GLOBALS['gLang']['web-title'] = "歡迎使用&quot;Xppass&quot;單點登錄系統";
$GLOBALS['gLang']['menu1'] = '首頁';
$GLOBALS['gLang']['menu2'] = '登錄';
$GLOBALS['gLang']['menu3'] = '注冊新用戶';
$GLOBALS['gLang']['menu4'] = '系統管理';
$GLOBALS['gLang']['menu5'] = '幫助';
$GLOBALS['gLang']['menu6'] = '退出';
$GLOBALS['gLang']['selectlanguage'] = '選擇語言';
$GLOBALS['gLang']['zh-cn'] = '簡體中文';
$GLOBALS['gLang']['zh-tw'] = '繁體中文';
$GLOBALS['gLang']['en'] = '英文';
$GLOBALS['gLang']['nicknameexist'] = '此昵稱已存在，請換一個！';

$GLOBALS['gLang']['run_mode'] = '應用運行狀態';
$GLOBALS['gLang']['app_status_label'] = '遇到錯誤出現時，開發狀態下輸出全部錯誤信息；生產狀態下只提示錯誤編號，并發生通知郵件。';
$GLOBALS['gLang']['timezone'] = '時區';
$GLOBALS['gLang']['timezone_label'] = '默認為系統時區';
$GLOBALS['gLang']['dev_status'] = '開發狀態';
$GLOBALS['gLang']['online_status'] = '生產狀態';
$GLOBALS['gLang']['menu_basicset'] = '基本設置';
$GLOBALS['gLang']['menu_regset'] = '注冊設置';
$GLOBALS['gLang']['menu_emailset'] = '郵件設置';
$GLOBALS['gLang']['menu_client'] = '客戶端管理';
$GLOBALS['gLang']['menu_user'] = '用戶管理';

$GLOBALS['gLang']['system_info'] = '系統信息';
$GLOBALS['gLang']['os_php'] = '操作系統及 PHP';
$GLOBALS['gLang']['webserver'] = '服務器軟件';
$GLOBALS['gLang']['mysql_version'] = 'MySQL 版本';
$GLOBALS['gLang']['upload_size'] = '上傳許可';
$GLOBALS['gLang']['mysql_datasize'] = '當前數據庫尺寸';
$GLOBALS['gLang']['hostname'] = '主機名';
$GLOBALS['gLang']['double_nickname'] = '是否禁止昵稱重復';
$GLOBALS['gLang']['yes'] = '是';
$GLOBALS['gLang']['no'] = '否';
$GLOBALS['gLang']['ban_email'] = '禁止的 Email 地址';
$GLOBALS['gLang']['ban_email_label'] = '禁止使用這些域名結尾的Email地址注冊。<br>只需填寫Email的域名部分，每行一個域名，例如 @hotmail.com';
$GLOBALS['gLang']['ban_username'] = '禁止的用戶名';
$GLOBALS['gLang']['ban_username_label'] = '可以設置通配符，每個關鍵字一行，如 "*admin*"(不會引號)。';
$GLOBALS['gLang']['email_from'] = '郵件來源地址';
$GLOBALS['gLang']['email_from_label'] = '當發送郵件不指定郵件來源時，默認使用此地址作為郵件來源。';
$GLOBALS['gLang']['smtp_server'] = 'SMTP 伺服器';
$GLOBALS['gLang']['smtp_server_label'] = '設置 SMTP 伺服器地址';
$GLOBALS['gLang']['smtp_port'] = 'SMTP 端口';
$GLOBALS['gLang']['smtp_port_label'] = '設置 SMTP 伺服器的端口，默認為 25';
$GLOBALS['gLang']['smtp_account'] = 'SMTP 身份驗證用戶名';
$GLOBALS['gLang']['smtp_password'] = 'SMTP 身份驗證密碼';
$GLOBALS['gLang']['search_domain'] = '搜索域名';
$GLOBALS['gLang']['add_domain'] = '添加域名';
$GLOBALS['gLang']['new_domain'] = '新域名';
$GLOBALS['gLang']['domain'] = '域名';
$GLOBALS['gLang']['domain_list'] = '域名列表';
$GLOBALS['gLang']['domain_delete_comfirm'] = '該操作不可恢復，您確認要刪除嗎？';
$GLOBALS['gLang']['domain_password'] = '密鑰';
$GLOBALS['gLang']['delete'] = '刪除';
$GLOBALS['gLang']['domainexist'] = '此域名已經存在。';

$GLOBALS['gLang']['first_page'] = '首頁';
$GLOBALS['gLang']['last_page'] = '尾頁';
$GLOBALS['gLang']['next_page'] = '下一頁';
$GLOBALS['gLang']['next_page'] = '上一頁';
$GLOBALS['gLang']['next_group'] = '下一組';
$GLOBALS['gLang']['pre_group'] = '上一組';
$GLOBALS['gLang']['success'] = '操作成功';
$GLOBALS['gLang']['failed'] = '操作失敗';
$GLOBALS['gLang']['selectone'] = '請選擇一個';
$GLOBALS['gLang']['invaliddomain'] = '無效的域名';

$GLOBALS['gLang']['search_user'] = '搜索用戶';
$GLOBALS['gLang']['add_user'] = '添加用戶';
$GLOBALS['gLang']['reg_date'] = '注冊日期';
$GLOBALS['gLang']['to'] = '到';
$GLOBALS['gLang']['user_list'] = '用戶列表';
$GLOBALS['gLang']['user_total'] = '用戶總數';
$GLOBALS['gLang']['more'] = '更多';
$GLOBALS['gLang']['edit'] = '編輯';
$GLOBALS['gLang']['view'] = '查看';
$GLOBALS['gLang']['admin_remind'] = '* administrator 不能被刪除';
$GLOBALS['gLang']['lastlogin'] = '最后登錄';
$GLOBALS['gLang']['edituser'] = '編輯用戶資料';
$GLOBALS['gLang']['pwd_label'] = '密碼留空，保持不變。';
$GLOBALS['gLang']['user_label'] = '不能修改';
$GLOBALS['gLang']['backtouserlist'] = '返回用戶列表';
$GLOBALS['gLang']['user_center'] = '用戶管理中心';
$GLOBALS['gLang']['index_name'] = 'PHP開源 SSO系統--Xppass';
$GLOBALS['gLang']['feature'] = '主要特點';
$GLOBALS['gLang']['feature_1'] = '1、提供三種解決方案Cookie方案、Session方案和Ticket方案，根據需求任選其一。';
$GLOBALS['gLang']['feature_2'] = '2、可采用哈希分表設計，支持億萬級別的用戶數據量存儲。';
$GLOBALS['gLang']['feature_3'] = '3、提供用戶名和電子郵箱兩種互補注冊方式。';
$GLOBALS['gLang']['feature_4'] = '4、實現安全登錄技術，采用密碼MD5加密傳輸和Hmac身份驗證。';
$GLOBALS['gLang']['feature_5'] = '5、提供自動安裝程序。';
$GLOBALS['gLang']['feature_6'] = '6、支持多語言版本。';
$GLOBALS['gLang']['cookie_solution'] = '非跨域名Cookie方案';
$GLOBALS['gLang']['session_solution'] = '非跨域名Session方案';
$GLOBALS['gLang']['ticket_solution'] = '跨域名Ticket方案';
$GLOBALS['gLang']['mentality'] = '思路';
$GLOBALS['gLang']['advantage'] = '優點';
$GLOBALS['gLang']['disadvantage'] = '缺點';
$GLOBALS['gLang']['cookie_mentality'] = '<ul><li>采用瀏覽器客戶端的cookie存儲在線用戶信息數據</li>
<li>用戶信息數據加密存儲和傳輸</li>
<li>子域名應用程序共享解密方法和密碼</li>
</ul>';
$GLOBALS['gLang']['session_mentality'] = '<ul>
<li>采用服務器端存儲在線用戶信息數據</li>
<li>子域名共享根域名的session id.</li>
<li>用戶數據無需加密。</li>
<li>web集群服務器需通過數據庫或者memcached共享用戶數據。</li>
</ul>';
$GLOBALS['gLang']['ticket_mentality'] = '<ul>
	<li>用戶訪問應用服務SP，SP判斷用戶是否在本地已經登錄，未登錄則調用sso client api訪問 sso server，帶上數字簽名signature，user_name 和 domain信息。
</li>
<li>sso server 接收到來自client的信息后，先認證client是否合法，即簽名校驗。然后從本機session判斷user_name是否存在，存在則返回session id，即票證ticket；ticket不存在就轉跳到登錄界面。
</li>
<li>用戶在身份認證中心登錄成功后，sso server在session中保存用戶信息。然后轉跳回應用服務SP，URL帶上ticket(session id)。
</li>
<li>應用服務SP通過SSO client 插件,再次帶上ticket，domain和signature(此時signature由 ticket加密得到)訪問 SSO Server，SSO Server先進行授權判斷，然后返回加密的用戶token數據。
</li>
<li>用戶信息數據是加密傳輸，SSO client 插件通過private key解密token數據。
</li>
<li>如果用戶已經在步驟 3 登錄過了，則跳過此步驟。</li>
<ul>';

$GLOBALS['gLang']['cookie_advantage'] = '機制簡單，避免了webserver集群造成的會話數據同步問題。有一定的安全性。';
$GLOBALS['gLang']['session_advantage'] = '安全性高。能解決webserver集群造成的會話數據共享問題。';
$GLOBALS['gLang']['ticket_advantage'] = '實現跨越，安全性高。';
$GLOBALS['gLang']['cookie_disadvantage'] = 'cookie存取的數據量有限。無法跨域。';
$GLOBALS['gLang']['session_disadvantage'] = '無法跨域。稍微復雜，采用數據庫有瓶頸問題，采用memcached需要部署memcached伺服器。';
$GLOBALS['gLang']['ticket_disadvantage'] = '復雜，需要開發客戶端插件。';
$GLOBALS['gLang']['menu_onlineuser'] = '在線用戶';
$GLOBALS['gLang']['online_length'] = '過期時間';
$GLOBALS['gLang']['module_ban'] = '該功能只在Ticket方案下啟用。';
?>