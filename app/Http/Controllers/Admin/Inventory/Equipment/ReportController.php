<?php

namespace App\Http\Controllers\Admin\Inventory\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PDF;
use Storage;

class ReportController extends Controller
{
    
    public function get_records($year){
        $items = DB::select("SELECT `ieid`.`ieid_category`, COUNT(CONCAT(`ieid`.`ieid_id`,'-',t.`iep_id`)) as 'qty', ieid.`ieid_unit`, ien.`ien_name`, iet.`iet_type`, ieb.`ieb_brand`, iep.`iep_place`,
        COUNT(CASE WHEN t.`jan`=1 AND t.`jan_del`=0 THEN t.`jan` END) as 'jan_1',
        COUNT(CASE WHEN t.`jan`=0 AND t.`jan_del`=0 THEN t.`jan` END) as 'jan_0',
        COUNT(CASE WHEN t.`feb`=1 AND t.`feb_del`=0 THEN t.`feb` END) as 'feb_1',
        COUNT(CASE WHEN t.`feb`=0 AND t.`feb_del`=0 THEN t.`feb` END) as 'feb_0',
        COUNT(CASE WHEN t.`mar`=1 AND t.`mar_del`=0 THEN t.`mar` END) as 'mar_1',
        COUNT(CASE WHEN t.`mar`=0 AND t.`mar_del`=0 THEN t.`mar` END) as 'mar_0',
        COUNT(CASE WHEN t.`apr`=1 AND t.`apr_del`=0 THEN t.`apr` END) as 'apr_1',
        COUNT(CASE WHEN t.`apr`=0 AND t.`apr_del`=0 THEN t.`apr` END) as 'apr_0',
        COUNT(CASE WHEN t.`may`=1 AND t.`may_del`=0 THEN t.`may` END) as 'may_1',
        COUNT(CASE WHEN t.`may`=0 AND t.`may_del`=0 THEN t.`may` END) as 'may_0',
        COUNT(CASE WHEN t.`jun`=1 AND t.`jun_del`=0 THEN t.`jun` END) as 'jun_1',
        COUNT(CASE WHEN t.`jun`=0 AND t.`jun_del`=0 THEN t.`jun` END) as 'jun_0',
        COUNT(CASE WHEN t.`jul`=1 AND t.`jul_del`=0 THEN t.`jul` END) as 'jul_1',
        COUNT(CASE WHEN t.`jul`=0 AND t.`jul_del`=0 THEN t.`jul` END) as 'jul_0',
        COUNT(CASE WHEN t.`aug`=1 AND t.`aug_del`=0 THEN t.`aug` END) as 'aug_1',
        COUNT(CASE WHEN t.`aug`=0 AND t.`aug_del`=0 THEN t.`aug` END) as 'aug_0',
        COUNT(CASE WHEN t.`sep`=1 AND t.`sep_del`=0 THEN t.`sep` END) as 'sep_1',
        COUNT(CASE WHEN t.`sep`=0 AND t.`sep_del`=0 THEN t.`sep` END) as 'sep_0',
        COUNT(CASE WHEN t.`oct`=1 AND t.`oct_del`=0 THEN t.`oct` END) as 'oct_1',
        COUNT(CASE WHEN t.`oct`=0 AND t.`oct_del`=0 THEN t.`oct` END) as 'oct_0',
        COUNT(CASE WHEN t.`nov`=1 AND t.`nov_del`=0 THEN t.`nov` END) as 'nov_1',
        COUNT(CASE WHEN t.`nov`=0 AND t.`nov_del`=0 THEN t.`nov` END) as 'nov_0',
        COUNT(CASE WHEN t.`dec`=1 AND t.`dec_del`=0 THEN t.`dec` END) as 'dec_1',
        COUNT(CASE WHEN t.`dec`=0 AND t.`dec_del`=0 THEN t.`dec` END) as 'dec_0'
        FROM 
        (SELECT CONCAT(`iei_id`,'-',`iep_id`) AS 'id', `iei_id`, `iep_id`, 
        ( IF(ISNULL(( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 1 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-01'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 1 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'jan',
        ( IF(ISNULL(( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 1 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-01'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 1 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'jan_del',
        ( IF(ISNULL(( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 2 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-02'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 2 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'feb',
        ( IF(ISNULL(( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 2 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-02'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 2 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'feb_del',
        ( IF(ISNULL(( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 3 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-03'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 3 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'mar',
        ( IF(ISNULL(( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 3 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-03'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 3 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'mar_del',
        ( IF(ISNULL(( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 4 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-04'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 4 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'apr',
        ( IF(ISNULL(( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 4 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-04'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 4 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'apr_del',
        ( IF(ISNULL(( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 5 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-05'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 5 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'may',
        ( IF(ISNULL(( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 5 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-05'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 5 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'may_del',
        ( IF(ISNULL(( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 6 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-06'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 6 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'jun',
        ( IF(ISNULL(( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 6 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-06'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 6 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'jun_del',
        ( IF(ISNULL(( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 7 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-07'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 7 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'jul',
        ( IF(ISNULL(( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 7 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-07'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 7 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'jul_del',
        ( IF(ISNULL(( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 8 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-08'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 8 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'aug',
        ( IF(ISNULL(( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 8 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-08'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 8 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'aug_del',
        ( IF(ISNULL(( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 9 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-09'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 9 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'sep',
        ( IF(ISNULL(( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 9 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-09'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 9 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'sep_del',
        ( IF(ISNULL(( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 10 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-10'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 10 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'oct',
        ( IF(ISNULL(( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 10 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-10'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 10 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'oct_del',
        ( IF(ISNULL(( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 11 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-11'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 11 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'nov',
        ( IF(ISNULL(( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 11 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-11'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 11 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'nov_del',
        ( IF(ISNULL(( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 12 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-12'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `ieuc_to_condition` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 12 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'dec',
        ( IF(ISNULL(( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
            AND MONTH(t3.`ieuc_id`) = 12 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`))),
                ( SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE DATE_FORMAT(t3.`ieuc_id`, '%Y-%m')
                    = (SELECT MAX(DATE_FORMAT(t4.`ieuc_id`, '%Y-%m')) FROM inventory_equipment_update_condition t4
                        WHERE CONCAT(t4.`iei_id`,'-',t4.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`) 
                        AND DATE_FORMAT(t4.`ieuc_id`, '%Y-%m') <= CONCAT(".$year.",'-12'))
                AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)),
                (SELECT `is_deleted` FROM inventory_equipment_update_condition t3 WHERE YEAR(t3.`ieuc_id`) = ".$year." 
                    AND MONTH(t3.`ieuc_id`) = 12 AND CONCAT(t3.`iei_id`,'-',t3.`iep_id`) = CONCAT(t1.`iei_id`,'-',t1.`iep_id`)))
        ) as 'dec_del'
        FROM `inventory_equipment_update_condition` as t1
        WHERE YEAR(`ieuc_date`) <= ".$year."
        GROUP BY CONCAT(t1.iei_id,'-',t1.iep_id)) t 
        LEFT JOIN inventory_equipment_item as iei 
        ON t.iei_id = iei.iei_id
        LEFT JOIN inventory_equipment_item_details as ieid 
        ON iei.ieid_id = ieid.ieid_id
        LEFT JOIN inventory_equipment_name as ien
        ON ieid.ien_id = ien.ien_id
        LEFT JOIN inventory_equipment_type as iet 
        ON ieid.iet_id = iet.iet_id
        LEFT JOIN inventory_equipment_brand ieb 
        ON ieid.ieb_id = ieb.ieb_id 
        LEFT JOIN inventory_equipment_place iep 
        ON iei.iep_id = iep.iep_id
        GROUP BY CONCAT(ieid.ieid_id,'-',t.iep_id)
        ORDER BY ieid.ieid_category, ien.ien_name;");

        // echo json_encode($items);

        return $items;
    }

    public function index($year){
        $items = $this->get_records($year);

        return view('Admin.Inventory.Equipment.Report')
            ->with(['items' => $items, 'year' => $year]);
    }

    public function print($year){
        $items = $this->get_records($year);
        $view = \View::make('Reports.Inventory.Equipment')
            ->with([
                'year' => $year,
                'items' => $items
            ]);
        $html_content = $view->render();
        
        PDF::SetTitle('Inventory_Equipment_Report_'.$year);
        PDF::AddPage('L', 'in', array(8,13));
        PDF::writeHTML($html_content, true, false, true, false, '');
        PDF::Output('Inventory_Equipment_Report');


    }
}
