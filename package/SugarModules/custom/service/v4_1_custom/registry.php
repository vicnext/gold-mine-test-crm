<?php

if (!defined('sugarEntry')) {
    define('sugarEntry', true);
}

require_once 'service/v4_1/registry.php';

#[\AllowDynamicProperties]
class registry_v4_1_custom extends registry_v4_1
{

    /**
    * registerFunction
    *
    * Registers all the functions on the service class
    */
    protected function registerFunction()
    {
        parent::registerFunction();

        $this->serviceClass->registerFunction(
            'get_report',
            [
               'year'=>'xsd:int',
               'month'=>'xsd:int',
            ],
            [
               'return'=>'xsd:bool',
            ],
        );

        $this->serviceClass->registerFunction(
            'generate_test_data',
            [],
            [],
        );
    }

    /**
     * This method registers all the complex types
     *
     *//*
    protected function registerTypes()
    {
        $this->serviceClass->registerType(
            'get_report_country_entry',
            'complexType',
            'struct',
            'all',
            '',
            [
                'country_id' => ['name'=>'country_id', 'type'=>'xsd:string'],
                'name' => ['name'=>'id', 'type'=>'xsd:string'],
                'target' => ['name'=>'target', 'type'=>'xsd:string'],
                'sum' => ['name'=>'sum', 'type'=>'xsd:int'],
            ]
        );
        $this->serviceClass->registerType(
            'get_report_country_list',
            'complexType',
            'array',
            '',
            'SOAP-ENC:Array',
            [],
            [
                ['ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:get_report_country_entry[]']
            ],
            'tns:get_report_country_entry'
        );
    }*/
}
