<?php
chdir(__DIR__ . '/../');
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '/../');
$requiredVendors = [
	'vendor/rmccue/requests',
	'vendor/smarty/smarty',
	'vendor/phpmailer/phpmailer',
	'vendor/ezyang/htmlpurifier',
	'vendor/symfony/var-dumper',
	'vendor/simshaun/recurr',
];
foreach ($requiredVendors as $dir) {
	if (!file_exists($dir)) {
		echo "Directory not found: $dir. For more information, visit <a href=\"https://yetiforce.com/en/implementer/installation-updates.html\">https://yetiforce.com/en/implementer/installation-updates.html</a>";
		return false;
	}
}
// Adjust error_reporting favourable to deployment.
include_once 'include/RequirementsValidation.php';
require_once('include/main/WebUI.php');
require_once('install/views/Index.php');
require_once('install/models/Utils.php');
require_once('install/models/ConfigFileUtils.php');
require_once('install/models/InitSchema.php');

App\Session::init();

$request = App\Request::init();
$install = new Install_Index_View();
$install->preProcess($request);
$install->process($request);
$install->postProcess($request);
