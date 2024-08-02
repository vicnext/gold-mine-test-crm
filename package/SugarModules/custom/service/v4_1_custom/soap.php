<?php

if (!defined('sugarEntry')) {
    define('sugarEntry', true);
}

/**
* This is a soap entry point for soap version 4_1 (custom)
*/

chdir('../../..');
require_once('SugarWebServiceImplv4_1_custom.php');

$webservice_class = 'SugarSoapService2';
$webservice_path = 'service/v2/SugarSoapService2.php';
$registry_class = 'registry_v4_1_custom';
$registry_path = 'custom/service/v4_1_custom/registry.php';
$webservice_impl_class = 'SugarWebServiceImplv4_1_custom';
$location = '/custom/service/v4_1_custom/soap.php';

require_once('service/core/webservice.php');
