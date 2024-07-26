<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

#[\AllowDynamicProperties]
class UN_MiningViewList extends ViewList
{
    public function display()
    {
        $data = [];
        $monthCount = $this->bean::MINING_MONTHS;
        while ($monthCount--) {
            $date = strtotime('-' . $monthCount . ' month');
            $data[date('Y-m', $date)] = date('F Y', $date);
        }
        krsort($data);

        $tpl = 'modules/UN_Mining/tpls/leaders.tpl';
        $this->ss->assign('data', $data);

        echo $this->ss->fetch($tpl);

        parent::display();
    }
}
