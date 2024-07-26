<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_modifier_format_tons($value)
{
    $postfix = '';
    if ($value > 1000) {
        $postfix = 'kg';
        $value /= 1000;
        if ($value > 1000) {
            $postfix = 'T';
            $value /= 1000;
        }
    }

    return round($value, 0) . ' ' . $postfix;
}
