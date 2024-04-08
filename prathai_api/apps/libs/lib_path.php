<?php
// include config variable
require_once "config/config_variable.php";

/****************************************************************/
if (! class_exists ( "AObjects" ))
	require_once PREFIX_PATH.'CoreFramework/AObjects.class.php';

if (! class_exists ( "Integer" ))
	require_once PREFIX_PATH.'CoreFramework/Integer.class.php';

if (! class_exists ( "Charactor" ))
	require_once PREFIX_PATH.'CoreFramework/Charactor.class.php';

if (! class_exists ( "String" ))
	require_once PREFIX_PATH.'CoreFramework/String.class.php';

if (! class_exists ( "DataModel" ))
	require_once PREFIX_PATH.'ActiveSupport/Database/DataModel.class.php';

if (! class_exists ( "Database" ))
	require_once PREFIX_PATH.'ActiveSupport/Database/Database.class.php';

if (! class_exists ( "PreStatement" ))
	require_once PREFIX_PATH.'ActiveSupport/Database/PreStatement.class.php';

if (! class_exists ( "DBConfig" ))
	require_once PREFIX_PATH.'ActiveSupport/DBConfig.class.php';

if (! class_exists ( "File" ))
	require_once PREFIX_PATH.'IO/File.class.php';

if (! class_exists ( "ABootstap" ))
	require_once PREFIX_PATH . "ActiveSupport/Bootstap/ABootstap.php";

if (! class_exists ( "View" ))
	require_once PREFIX_PATH . "ActiveSupport/ViewHelper/View.class.php";

if (! class_exists ( "ViewTemplate" ))
	require_once PREFIX_PATH . "ActiveSupport/ViewHelper/ViewTemplate.class.php";

if (! class_exists ( "AControl" ))
	require_once PREFIX_PATH . "ActiveSupport/Helper/AControl.class.php";

if (! class_exists ( "HttpParameter" ))
	require_once PREFIX_PATH . "HttpParameter/HttpParameter.class.php";

if (! class_exists ( "HttpHeader" ))
	require_once PREFIX_PATH . "HttpParameter/HttpHeader.class.php";

if (! class_exists ( "ServerParameter" ))
	require_once PREFIX_PATH . "HttpParameter/ServerParameter.class.php";

if (! class_exists ( "Toolkit" ))
	require_once PREFIX_PATH . "Toolkits/Toolkit.class.php";

if (! class_exists ( "Language" ))
	require_once PREFIX_PATH . "Configuration/Language.class.php";

if (! class_exists ( "Security" ))
	require_once PREFIX_PATH . "Security/Security.class.php";

 if (! class_exists ( "PHPMailer" ))
 	require_once PREFIX_PATH . 'PHPMailer_v5.1/class.phpmailer.php';

if (! class_exists ( "FormObject" ))
	require_once PREFIX_PATH . 'FormsObject/FormObject.class.php';

if (! class_exists ( "Checkbox" ))
	require_once PREFIX_PATH . 'FormsObject/Checkbox.class.php';

if (! class_exists ( "SelectBox" ))
	require_once PREFIX_PATH . 'FormsObject/Selectbox.class.php';


/**************************** MODELS ************************************/

if (! class_exists ( "Product" ))
    require_once "apps/models/product.class.php";

if(! class_exists("Member"))
    require_once "apps/models/member.class.php";

if(! class_exists("ChatRoom"))
    require_once "apps/models/chat_room.class.php";

if(! class_exists("ChatRoomDetail"))
    require_once "apps/models/chat_room_detail.class.php";


if(! class_exists("ChatInvite"))
    require_once "apps/models/chat_invite.class.php";




/**************************** CONTROLL ************************************/
if (! class_exists ( "MainControls" ))
	require_once "apps/controls/main_controls.class.php";

if (! class_exists ( "ToolkitsControls" ))
	require_once "apps/controls/toolkit_controls.class.php";

/***************************************************************/
if (! class_exists ( "OtherLibrary" ))
	require_once "apps/libs/OtherLibrary.class.php";


?>