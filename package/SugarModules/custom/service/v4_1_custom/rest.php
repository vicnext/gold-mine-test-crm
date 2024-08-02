<?php

if (!defined('sugarEntry')) {
    define('sugarEntry', true);
}

/**
* This is a rest entry point for rest version 4.1 (custom)
*/

chdir('../../..');
require_once('SugarWebServiceImplv4_1_custom.php');

$webservice_class = 'SugarRestService';
$webservice_path = 'service/core/SugarRestService.php';
$webservice_impl_class = 'SugarWebServiceImplv4_1_custom';
$registry_class = 'registry_v4_1_custom';
$location = '/custom/service/v4_1_custom/rest.php';
$registry_path = 'custom/service/v4_1_custom/registry.php';

require_once('service/core/webservice.php');
