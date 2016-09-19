<?php

/**
 * standard directories
 */

$ds = DIRECTORY_SEPARATOR;
define("DIR_ROOT", dirname(__DIR__));
define("DIR_APP", DIR_ROOT.$ds."app");
define("DIR_CORE", DIR_APP.$ds."core");
define("DIR_HANDLERS", DIR_APP.$ds."handlers");
define("DIR_MODELS",DIR_APP.$ds."models");
define("DIR_VIEWS",DIR_APP.$ds."views");
define("DIR_CONFIG", DIR_APP.$ds."config");
define("DIR_CUSTOM", DIR_APP.$ds."custom");
define("DIR_DATA", DIR_APP.$ds."data");
define("DIR_SYS_DATA", DIR_APP.$ds."sys_data");
define("DIR_EMAILS", DIR_APP.$ds."emails");
define("DIR_MESSAGES", DIR_APP.$ds."messages");
define("DIR_MESSAGE_TEMPLATES", DIR_MESSAGES.$ds."message_templates");
define("DIR_EMAIL_TEMPLATES", DIR_EMAILS.$ds."email_templates");
