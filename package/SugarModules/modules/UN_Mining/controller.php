<?php

/**
 * UN_Mining Controller class
 */
class UN_MiningController extends SugarController
{
    /**
     * Get Exceeded Countries View
     *
     */
    public function action_countries()
    {
        list($year, $month) = explode('-', $_REQUEST['month'] ?? '');

        $countries = $this->bean->getCountriesExceeded($year, $month);
        $viewData = [
            'data' => $countries,
            'tpl' => 'modules/UN_Mining/tpls/countries.tpl',
        ];
        $view = ViewFactory::loadView('ajax', $this->bean->module_dir, $this->bean, $viewData);

        $this->jsonResponse($view->display());
    }

    /**
     * Get Companies View of Exceeded Countries
     *
     */
    public function action_companies()
    {
        list($year, $month) = explode('-', $_REQUEST['month'] ?? '');

        $companies = $this->bean->getCompaniesExceeded($year, $month);
        $viewData = [
            'data' => $companies,
            'tpl' => 'modules/UN_Mining/tpls/companies.tpl',
        ];
        $view = ViewFactory::loadView('ajax', $this->bean->module_dir, $this->bean, $viewData);

        $this->jsonResponse($view->display());
    }

    /**
     * Get Companies View of Exceeded Countries
     *
     */
    public function action_generate()
    {
        $bean = BeanFactory::newBean('UN_Mining');
        $bean->generate();
    }

    /**
     * JSON response
     *
     * @param array $data
     */
    protected function jsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PARTIAL_OUTPUT_ON_ERROR);
        exit;
    }
}
