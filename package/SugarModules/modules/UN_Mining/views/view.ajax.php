<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

#[\AllowDynamicProperties]
class UN_MiningViewAjax extends SugarView
{
    public function display()
    {
        $tpl = $this->view_object_map['tpl'] ?? '';
        foreach ($this->view_object_map as $key => $value) {
            if ($key !== 'tpl') {
                $this->ss->assign($key, $value);
            }
        }

        return $this->ss->fetch($tpl);
    }
}
