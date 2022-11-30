<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index(){
        // accounts
            $accounts = DB::select("SELECT 
                (SELECT COUNT(`acc_id`) FROM `accounts` WHERE is_verified=1 AND position='patient') AS 'patient',
                (SELECT COUNT(`acc_id`) FROM `accounts` WHERE is_verified=0) AS 'request',
                (SELECT COUNT(`acc_id`) FROM `accounts` WHERE is_verified=1 AND position!='patient') AS 'employee'
                FROM `accounts` 
                LIMIT 1"
            );

            foreach($accounts as $a){
                $acc = $a;
            }
        // accounts

        // medicine
            $medicines = DB::select("SELECT SUM(qty_left) AS 'quantity', imi_status
                FROM 
                (SELECT (i.imi_quantity-IFNULL((SELECT SUM(imt_quantity) FROM inventory_medicine_transaction WHERE imi_id=i.imi_id),0)) AS 'qty_left', imi_status
                FROM `inventory_medicine_item` AS i 
                LEFT JOIN `inventory_medicine_transaction` AS t 
                ON i.imi_id=t.imi_id) t1
                GROUP BY imi_status
            ");

            $ma = [];
            foreach($medicines as $b){
                if($b->imi_status==0){
                    $ma["onhold"] = $b->quantity;
                }
                else{
                    $ma["fordispensing"] = $b->quantity;
                }
            }
        // medicine
        
        // equipments
            $equipments = DB::select("SELECT iei_condition AS 'condition', COUNT(iei_condition) AS 'total'
                FROM `inventory_equipment_item`
                GROUP BY iei_condition"
            );
            $ea = [];
            foreach($equipments as $c){
                if($c->condition==0){
                    $ea['not'] = $c->total;
                }
                else{
                    $ea['working'] = $c->total;
                }
            }
        // equipments

        // forms
            $forms = [];
            $ftoday = DB::Select("SELECT COUNT(`form_id`) AS 'count'
                FROM `forms` 
                WHERE `form_date_created`='".date('Y-m-d')."';"
            );
            foreach($ftoday as $ft){
                $ftd = $ft->count;
            }
            $forms['ftd'] = $ftd;

            $ftweek = DB::Select("SELECT COUNT(`form_id`) AS 'count'
                FROM `forms` 
                WHERE yearweek(`form_date_created`)=yearweek(curdate());"
            );
            foreach($ftweek as $ftw){
                $ftw = $ftw->count;
            }
            $forms['ftw'] = $ftw;

            $ftmonth = DB::Select("SELECT COUNT(`form_id`) AS 'count' 
                FROM `forms` 
                WHERE MONTH(`form_date_created`) = MONTH(CURRENT_DATE())
                AND YEAR(`form_date_created`) = YEAR(CURRENT_DATE())"
            );
            foreach($ftmonth as $ftm){
                $ftm = $ftm->count;
            }
            $forms['ftm'] = $ftm;

            $ftyear = DB::Select("SELECT COUNT(`form_id`) AS 'count' 
                FROM `forms` 
                WHERE 
                YEAR(`form_date_created`) = YEAR(CURRENT_DATE())"
            );
            foreach($ftyear as $fty){
                $fty = $fty->count;
            }
            $forms['fty'] = $fty;
        // forms

        // transaction
            $ttd = [];
            $ttd_trans = DB::SELECT("SELECT 
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='BP' AND `trans_date`='".date('Y-m-d')."') AS 'b',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Consultation' AND `trans_date`='".date('Y-m-d')."') AS 'c',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Medical Certificate' AND `trans_date`='".date('Y-m-d')."') AS 'mc',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Medicine' AND `trans_date`='".date('Y-m-d')."') AS 'm',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Others' AND `trans_date`='".date('Y-m-d')."') AS 'o'
                FROM `transaction` 
                LIMIT 1"
            );
            foreach($ttd_trans as $ttdti){
                $ttd['b'] = $ttdti->b;
                $ttd['c'] = $ttdti->c;
                $ttd['mc'] = $ttdti->mc;
                $ttd['m'] = $ttdti->m;
                $ttd['o'] = $ttdti->o;
            }

            $ttw = [];
            $ttw_trans = DB::SELECT("SELECT 
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='BP' AND yearweek(`trans_date`)=yearweek(curdate())) AS 'b',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Consultation' AND  yearweek(`trans_date`)=yearweek(curdate())) AS 'c',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Medical Certificate' AND  yearweek(`trans_date`)=yearweek(curdate())) AS 'mc',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Medicine' AND  yearweek(`trans_date`)=yearweek(curdate())) AS 'm',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Others' AND  yearweek(`trans_date`)=yearweek(curdate())) AS 'o'
                FROM `transaction` 
                LIMIT 1"
            );
            foreach($ttw_trans as $ttwti){
                $ttw['b'] = $ttwti->b;
                $ttw['c'] = $ttwti->c;
                $ttw['mc'] = $ttwti->mc;
                $ttw['m'] = $ttdti->m;
                $ttw['o'] = $ttwti->o;
            }
            
            $ttm = [];
            $ttm_trans = DB::SELECT("SELECT 
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='BP' AND MONTH(`trans_date`) = MONTH(CURRENT_DATE()) AND YEAR(`trans_date`) = YEAR(CURRENT_DATE())) AS 'b',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Consultation' AND MONTH(`trans_date`) = MONTH(CURRENT_DATE()) AND YEAR(`trans_date`) = YEAR(CURRENT_DATE())) AS 'c',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Medical Certificate' AND MONTH(`trans_date`) = MONTH(CURRENT_DATE()) AND YEAR(`trans_date`) = YEAR(CURRENT_DATE())) AS 'mc',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Medicine' AND MONTH(`trans_date`) = MONTH(CURRENT_DATE()) AND YEAR(`trans_date`) = YEAR(CURRENT_DATE())) AS 'm',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Others' AND MONTH(`trans_date`) = MONTH(CURRENT_DATE()) AND YEAR(`trans_date`) = YEAR(CURRENT_DATE())) AS 'o'
                FROM `transaction` 
                LIMIT 1"
            );
            foreach($ttm_trans as $ttmti){
                $ttm['b'] = $ttmti->b;
                $ttm['c'] = $ttmti->c;
                $ttm['mc'] = $ttmti->mc;
                $ttm['m'] = $ttmti->m;
                $ttm['o'] = $ttmti->o;
            }

            $tty = [];
            $tty_trans = DB::SELECT("SELECT 
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='BP' AND MONTH(`trans_date`) = MONTH(CURRENT_DATE()) AND YEAR(`trans_date`) = YEAR(CURRENT_DATE())) AS 'b',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Consultation' AND MONTH(`trans_date`) = MONTH(CURRENT_DATE()) AND YEAR(`trans_date`) = YEAR(CURRENT_DATE())) AS 'c',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Medical Certificate' AND MONTH(`trans_date`) = MONTH(CURRENT_DATE()) AND YEAR(`trans_date`) = YEAR(CURRENT_DATE())) AS 'mc',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Medicine' AND MONTH(`trans_date`) = MONTH(CURRENT_DATE()) AND YEAR(`trans_date`) = YEAR(CURRENT_DATE())) AS 'm',
                (SELECT COUNT(`trans_id`) FROM transaction WHERE `trans_purpose`='Others' AND MONTH(`trans_date`) = MONTH(CURRENT_DATE()) AND YEAR(`trans_date`) = YEAR(CURRENT_DATE())) AS 'o'
                FROM `transaction` 
                LIMIT 1"
            );
            foreach($tty_trans as $ttyti){
                $tty['b'] = $ttyti->b;
                $tty['c'] = $ttyti->c;
                $tty['mc'] = $ttyti->mc;
                $tty['m'] = $ttyti->m;
                $tty['o'] = $ttyti->o;
            }
        // transaction

        // transaction frequency
            $trans_fre = [];
            $transaction_freq = DB::select("SELECT 
                YEAR(`trans_date`) AS 'year',
                SUM(CASE MONTH(`trans_date`) WHEN 1 THEN 1 ELSE 0 END) AS 'jan',
                SUM(CASE MONTH(`trans_date`) WHEN 2 THEN 1 ELSE 0 END) AS 'feb',
                SUM(CASE MONTH(`trans_date`) WHEN 3 THEN 1 ELSE 0 END) AS 'mar',
                SUM(CASE MONTH(`trans_date`) WHEN 4 THEN 1 ELSE 0 END) AS 'apr',
                SUM(CASE MONTH(`trans_date`) WHEN 5 THEN 1 ELSE 0 END) AS 'may',
                SUM(CASE MONTH(`trans_date`) WHEN 6 THEN 1 ELSE 0 END) AS 'jun',
                SUM(CASE MONTH(`trans_date`) WHEN 7 THEN 1 ELSE 0 END) AS 'jul',
                SUM(CASE MONTH(`trans_date`) WHEN 8 THEN 1 ELSE 0 END) AS 'aug',
                SUM(CASE MONTH(`trans_date`) WHEN 9 THEN 1 ELSE 0 END) AS 'sep',
                SUM(CASE MONTH(`trans_date`) WHEN 10 THEN 1 ELSE 0 END) AS 'oct',
                SUM(CASE MONTH(`trans_date`) WHEN 11 THEN 1 ELSE 0 END) AS 'nov',
                SUM(CASE MONTH(`trans_date`) WHEN 12 THEN 1 ELSE 0 END) AS 'dec'
            FROM
                `transaction`
            GROUP BY YEAR(`trans_date`) 
            ORDER BY YEAR(`trans_date`) DESC;"
                );
        // transaction frequency

        // dispense medicine
        $dftda[0]['qty'] = 0; $dftda[1]['qty'] = 0; $dftda[2]['qty'] = 0; $dftda[3]['qty'] = 0; $dftda[4]['qty'] = 0;
        $dftda[0]['gn'] = ''; $dftda[1]['gn'] = ''; $dftda[2]['gn'] = ''; $dftda[3]['gn'] = ''; $dftda[4]['gn'] = '';
        $dftd = DB::select("SELECT gn.imgn_generic_name, SUM(t.imt_quantity) AS 'total_dispense'
            FROM `inventory_medicine_transaction` AS t 
            LEFT JOIN `inventory_medicine_item` AS i 
            ON t.imi_id=i.imi_id 
            LEFT JOIN `inventory_medicine_generic_name` AS gn 
            ON i.imgn_id=gn.imgn_id 
            WHERE t.imt_type='dispense'
            GROUP BY gn.imgn_id 
            ORDER BY SUM(t.imt_quantity) DESC
            LIMIT 5;
        ");
        $i = 0;
        foreach($dftd as $dftdi){
            $dftda[$i]['gn'] = $dftdi->imgn_generic_name;
            $dftda[$i]['qty'] = $dftdi->total_dispense;
            $i++;
        }
        // dispense medicine

        // vaxxx
            $vaxx = [];
            $vaxx_items = DB::Select("SELECT 
                (SELECT COUNT(`vs_id`)
                FROM `vaccination_status` 
                WHERE `vs_status` = 'unvaccinated') AS 'unvaxx',
                (SELECT COUNT(`vs_id`)
                FROM `vaccination_status` 
                WHERE `vs_status` = 'partially vaccinated') AS 'par_vaxx',
                (SELECT COUNT(`vs_id`)
                FROM `vaccination_status` 
                WHERE `vs_status` = 'fully vaccinated') AS 'fully_vaxx',
                (SELECT COUNT(`vs_id`)
                FROM `vaccination_status` 
                WHERE `vs_status` = 'boosted') AS 'boosted'
                FROM `vaccination_status` 
                LIMIT 1"
            );
            foreach($vaxx_items as $vi){
                $vaxx['unvaxx'] = $vi->unvaxx;
                $vaxx['par_vaxx'] = $vi->par_vaxx;
                $vaxx['fully_vaxx'] = $vi->fully_vaxx;
                $vaxx['boosted'] = $vi->boosted;
            }
        // vaxxx
        return view('Admin.Dashboard')
            ->with([
                'accounts' => $a,
                'medicines' => (object)$ma,
                'equipments' => (object)$ea,
                'forms' => (object)$forms,
                'ttd' => (object)$ttd,
                'ttw' => (object)$ttw,
                'ttm' => (object)$ttm,
                'tty' => (object)$tty,
                'transaction_freq' => $transaction_freq,
                'vaxx' => (object)$vaxx,
                'dftda' => $dftda
            ]);
        // echo json_encode($dftda);

    }
}
