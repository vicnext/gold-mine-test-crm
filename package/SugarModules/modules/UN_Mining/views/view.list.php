<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

#[\AllowDynamicProperties]
class UN_MiningViewList extends ViewList
{
    public function display()
    {
        $tpl = 'modules/UN_Mining/tpls/leaders.tpl';
        $this->ss->assign('data', $this->getMonthDropdownData());

        echo $this->ss->fetch($tpl);

        parent::display();
    }

    private function getMonthDropdownData() {
        $data = [];
        $monthCount = $this->bean::MINING_MONTHS;
        list($year, $month) = explode('-', date('Y-m'));
        while ($monthCount--) {
            $data[sprintf('%04d-%02d', $year, $month)] = date("F", mktime(0, 0, 0, $month, 1)) . ' ' . $year;
            if (--$month < 0) { // for next month
                $month = 12;
                $year--;
            }
        }

        return $data;
    }

}
