<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once('service/v4_1/SugarWebServiceImplv4_1.php');
require_once('custom/service/v4_1_custom/SugarWebServiceUtilv4_1_custom.php');

#[\AllowDynamicProperties]
class SugarWebServiceImplv4_1_custom extends SugarWebServiceImplv4_1
{
    /**
     * Class Constructor Object
     *
     */
    public function __construct()
    {
        self::$helperObject = new SugarWebServiceUtilv4_1_custom();
    }

    /**
     * Get monthly Report
     *
     * @param String $session Session ID returned by a previous call to login
     * @param Number $year Year
     * @param Number $month Month
     * @return Array 'country_list' Array - Country records
     */
    public function get_report($session, $year, $month)
    {
        $GLOBALS['log']->info('Begin: SugarWebServiceImpl->get_report');
        self::$helperObject = new SugarWebServiceUtilv4_1_custom();
        global $beanList, $beanFiles;
        $error = new SoapError();
        $module = 'UN_Mining';

        if (!self::$helperObject->checkSessionAndModuleAccess(
            $session,
            'invalid_session',
            $module,
            'read',
            'no_access',
            $error
        )
        ) {
            $GLOBALS['log']->info('End: SugarWebServiceImpl->get_report');

            return;
        }

        $bean = BeanFactory::newBean($module);

        if (!self::$helperObject->checkACLAccess($bean, 'DetailView', $error, 'no_access')) {
            $GLOBALS['log']->info('End: SugarWebServiceImpl->get_report');

            return;
        }

        $result = $bean->getCountriesExceeded($year, $month);
        //$result['company_list'] = $bean->getCompaniesExceeded($year, $month);

        $GLOBALS['log']->info('End: SugarWebServiceImpl->get_report');

        return $result;
    }

    /**
     * Get monthly Report
     *
     * @param String $session Session ID returned by a previous call to login
     */
    public function generate_test_data($session)
    {
        $GLOBALS['log']->info('Begin: SugarWebServiceImpl->generate_test_data');
        self::$helperObject = new SugarWebServiceUtilv4_1_custom();
        global $beanList, $beanFiles;
        $error = new SoapError();
        $module = 'UN_Mining';

        if (!self::$helperObject->checkSessionAndModuleAccess(
            $session,
            'invalid_session',
            $module,
            'read',
            'no_access',
            $error
        )
        ) {
            $GLOBALS['log']->info('End: SugarWebServiceImpl->generate_test_data');

            return;
        }

        $bean = BeanFactory::newBean($module);

        if (!self::$helperObject->checkACLAccess($bean, 'EditView', $error, 'no_access')) {
            $GLOBALS['log']->info('End: SugarWebServiceImpl->generate_test_data');

            return;
        }

        $bean->generate();

        $GLOBALS['log']->info('End: SugarWebServiceImpl->generate_test_data');
    }
}
