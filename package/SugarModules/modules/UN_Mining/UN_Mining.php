<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2018 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */


class UN_Mining extends Basic
{
    public const MINING_MONTHS = 6;
    public const MINING_PER_MONTH = 50;
    public const MINING_WEIGHT_MIN = 100;
    public const MINING_WEIGHT_MAX = 10000000;

    public $new_schema = true;
    public $module_dir = 'UN_Mining';
    public $object_name = 'UN_Mining';
    public $table_name = 'un_mining';
    public $importable = false;

    public $id;
    public $name;
    public $date_entered;
    public $date_modified;
    public $modified_user_id;
    public $modified_by_name;
    public $created_by;
    public $created_by_name;
    public $description;
    public $deleted;
    public $created_by_link;
    public $modified_user_link;
    public $assigned_user_id;
    public $assigned_user_name;
    public $assigned_user_link;
    public $SecurityGroups;
    public $company_id;
    public $company;
    public $date_mine;
    public $mined;

    public function bean_implements($interface)
    {
        switch($interface)
        {
            case 'ACL':
                return true;
        }

        return false;
    }

    public function getCountriesExceeded($year, $month)
    {
        $dbFormat = 'Y-m-d H:i:s';
        $dateFrom = sprintf('%04d-%02d-01 00:00:00', $year, $month);
        $dateTo = DateTime::createFromFormat($dbFormat, $dateFrom)->modify('+1 month')->format($dbFormat);

        $sql = 'SELECT country_id, un_country.name, un_country.target, SUM(mined) sum'
            . ' FROM un_mining'
            . ' LEFT JOIN un_company ON un_mining.company_id = un_company.id'
            . ' LEFT JOIN un_country ON un_company.country_id = un_country.id'
            . ' WHERE date_mine >= "' . $dateFrom . '" AND date_mine < "' . $dateTo . '"'
            . ' GROUP BY country_id HAVING sum > un_country.target'
            . ' ORDER BY sum DESC';
        $result = $this->db->query($sql);
        $data = [];
        while ($row = $this->db->fetchByAssoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getCompaniesExceeded($year, $month)
    {
        $dbFormat = 'Y-m-d H:i:s';
        $dateFrom = sprintf('%04d-%02d-01 00:00:00', $year, $month);
        $dateTo = DateTime::createFromFormat($dbFormat, $dateFrom)->modify('+1 month')->format($dbFormat);

        $sql = 'SELECT company_id, un_company.name, country_id,'
                . ' un_country.name country_name, un_country.target, SUM(mined) sum'
            . ' FROM un_mining'
            .'  LEFT JOIN un_company ON un_mining.company_id = un_company.id'
            . ' LEFT JOIN un_country ON un_company.country_id = un_country.id'
            . ' WHERE date_mine >= "' . $dateFrom . '" AND date_mine < "' . $dateTo . '"'
            . ' GROUP BY company_id HAVING country_id IN'
                . ' (SELECT country_id FROM (SELECT country_id, un_country.name, un_country.target, SUM(mined) sum'
                . ' FROM un_mining'
                . ' LEFT JOIN un_company ON un_mining.company_id = un_company.id'
                . ' LEFT JOIN un_country ON un_company.country_id = un_country.id'
                . ' WHERE date_mine >= "' . $dateFrom . '" AND date_mine < "' . $dateTo . '"'
                . ' GROUP BY country_id HAVING sum > un_country.target) tmp)'
            . ' ORDER BY sum DESC';
        $result = $this->db->query($sql);
        $data = [];
        while ($row = $this->db->fetchByAssoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function generate()
    {
        set_time_limit(0);

        $format = '%04d-%02d-%02d %02d:%02d:%02d';
        $companies = BeanFactory::newBean('UN_Company')->get_full_list();
        foreach ($companies as $company) {
            list($year, $month, $dayEnd) = explode('-', date('Y-m-d'));
            $monthCount = self::MINING_MONTHS;
            while ($monthCount--) {
                $mineCount = rand(1, self::MINING_PER_MONTH);
                while ($mineCount--) {
                    $day = rand(1, $dayEnd);
                    $hour = rand(0, 23);
                    $min = rand(0, 59);
                    $sec = rand(0, 59);

                    $mining = BeanFactory::newBean('UN_Mining');
                    $mining->date_mine = sprintf($format, $year, $month, $day, $hour, $min, $sec);
                    $mining->company_id = $company->id;
                    $mining->mined = rand(self::MINING_WEIGHT_MIN, self::MINING_WEIGHT_MAX);
                    $mining->name = $company->name . ' ' . $mining->date_mine;
                    $mining->save();
                }
                if (--$month < 0) { // for next month
                    $month = 12;
                    $year--;
                }
                $dayEnd = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            }
        }
    }
}
