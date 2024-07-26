<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

/**
* Class Validation
*
*/
class Validation
{
    /**
    * Request handler
    * Depending on main "action" request parameter matching method of the class
    * is launched
    *
    */
    public function handleRequest($rules, $module, $id, $field, $value)
    {
        $rules = explode(',', $rules);
        $result = '';
        foreach ($rules as $rule) {
            if (method_exists($this, $rule)) {
                $result = $this->$rule($module, $id, $field, $value);
            } else {
                $result = 'Incorrect Rule: ' . $rule;
            }
            if ($result) {
                break;
            }
        }
        $this->jsonResponse($result);
    }

    /**
    * Unique Validation
    *
    */
    public function unique($module, $id, $field, $value)
    {
        $result = '';
        if (!$module) {
            $result = 'No module name';
        } elseif (!$field || !$value) {
            $result = 'No filed name/value';
        } else {
            $bean = BeanFactory::newBean($module);
            if ($bean) {
                $where = $bean->table_name . '.' . $field . ' = "' . $value . '"';
                if ($id) {
                    $where .= ' AND ' . $bean->table_name . '.id != "' . $id . '"';
                }
                $beans = $bean->get_list('', $where);
                if (!empty($beans['list'])) {
                    $result = 'The entry already exists';
                }
            } else {
                $result = 'Incorrect Module Name: ' . $module;
            }
        }

        return $result;
    }

    /**
    * Email Validation
    *
    */
    public function email($module, $id, $field, $value)
    {
        $result = '';
        $filtered = filter_var($value, FILTER_VALIDATE_EMAIL);
        if ($filtered === false) {
            $result = 'Incorrect Email';
        } elseif ($filtered !== $value) {
            $result = 'Incorrect Email format';
        }

        return $result;
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
