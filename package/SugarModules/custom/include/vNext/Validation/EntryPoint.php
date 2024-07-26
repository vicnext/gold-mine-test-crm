<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once 'custom/include/vNext/Validation/Validation.php';

$rules = $_REQUEST['rules'] ?? '';
$module = $_REQUEST['module'] ?? '';
$record = $_REQUEST['record'] ?? '';
$field = $_REQUEST['field'] ?? '';
$value = $_REQUEST['value'] ?? '';

$validation = new Validation();
$validation->handleRequest($rules, $module, $record, $field, $value);
