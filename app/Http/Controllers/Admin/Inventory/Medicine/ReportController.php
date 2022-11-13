<?php

namespace App\Http\Controllers\Admin\Inventory\Medicine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;

class ReportController extends Controller
{
    public function monthly($m, $y){
        $my = $m.', '.$y;

        $items = DB::select("SELECT `t2`.`imgn_generic_name`, 
        (IF(ISNULL((SELECT SUM(`imi_quantity`) 
         FROM `inventory_medicine_item`
         WHERE `imgn_id`=`t2`.`imgn_id`
         AND DATE_FORMAT(`imi_date_added`, '%m, %Y') < '".$my."')),0,(SELECT SUM(`imi_quantity`) 
         FROM `inventory_medicine_item`
         WHERE `imgn_id`=`t2`.`imgn_id`
         AND DATE_FORMAT(`imi_date_added`, '%m, %Y') < '".$my."'))
         -
         IF(ISNULL((SELECT SUM(`imt_quantity`)
         FROM `inventory_medicine_transaction` as `a1`
         LEFT JOIN `inventory_medicine_item` as `a2`
         ON `a1`.`imi_id`=`a2`.`imi_id`
         LEFT JOIN `inventory_medicine_generic_name` as `a3`
         ON `a2`.`imgn_id`=`a3`.`imgn_id`
         WHERE `a3`.`imgn_id`=`t2`.`imgn_id`
         AND DATE_FORMAT(`a2`.`imi_date_added`, '%m, %Y') < '".$my."')),0,(SELECT SUM(`imt_quantity`)
         FROM `inventory_medicine_transaction` as `a1`
         LEFT JOIN `inventory_medicine_item` as `a2`
         ON `a1`.`imi_id`=`a2`.`imi_id`
         LEFT JOIN `inventory_medicine_generic_name` as `a3`
         ON `a2`.`imgn_id`=`a3`.`imgn_id`
         WHERE `a3`.`imgn_id`=`t2`.`imgn_id`
         AND DATE_FORMAT(`a2`.`imi_date_added`, '%m, %Y') < '".$my."'))
         ) AS 'initial_quantity',
         
         IF(ISNULL((SELECT SUM(`imi_quantity`)
         FROM `inventory_medicine_item`
         WHERE `imgn_id` = `t2`.`imgn_id`
         AND DATE_FORMAT(`imi_date_added`, '%m, %Y')='".$my."'
        )),0,(SELECT SUM(`imi_quantity`)
         FROM `inventory_medicine_item`
         WHERE `imgn_id` = `t2`.`imgn_id`
         AND DATE_FORMAT(`imi_date_added`, '%m, %Y')='".$my."'
        )) AS 'in_quantity',
        
         IF(ISNULL((SELECT SUM(`imt_quantity`)
         FROM `inventory_medicine_transaction` as `a1`
         LEFT JOIN `inventory_medicine_item` as `a2`
         ON `a1`.`imi_id`=`a2`.`imi_id`
         WHERE `a1`.`imt_type`='dispose'
         AND DATE_FORMAT(`a1`.`imt_date`, '%m, %Y')='".$my."'
         AND `a2`.`imgn_id`=`t2`.`imgn_id`)),0,(SELECT SUM(`imt_quantity`)
         FROM `inventory_medicine_transaction` as `a1`
         LEFT JOIN `inventory_medicine_item` as `a2`
         ON `a1`.`imi_id`=`a2`.`imi_id`
         WHERE `a1`.`imt_type`='dispose'
         AND DATE_FORMAT(`a1`.`imt_date`, '%m, %Y')='".$my."'
         AND `a2`.`imgn_id`=`t2`.`imgn_id`))
         AS 'out_dispose',
         
         IF(ISNULL((SELECT SUM(`imt_quantity`)
         FROM `inventory_medicine_transaction` as `a1`
         LEFT JOIN `inventory_medicine_item` as `a2`
         ON `a1`.`imi_id`=`a2`.`imi_id`
         WHERE `a1`.`imt_type`='dispense'
         AND DATE_FORMAT(`a1`.`imt_date`, '%m, %Y')='".$my."'
         AND `a2`.`imgn_id`=`t2`.`imgn_id`)),0,(SELECT SUM(`imt_quantity`)
         FROM `inventory_medicine_transaction` as `a1`
         LEFT JOIN `inventory_medicine_item` as `a2`
         ON `a1`.`imi_id`=`a2`.`imi_id`
         WHERE `a1`.`imt_type`='dispense'
         AND DATE_FORMAT(`a1`.`imt_date`, '%m, %Y')='".$my."'
         AND `a2`.`imgn_id`=`t2`.`imgn_id`))
         AS 'out_dispense'
        
        FROM `inventory_medicine_item` as `t`
        LEFT JOIN `inventory_medicine_transaction` as `t1`
        ON `t`.`imi_id`=`t1`.`imi_id`
        LEFT JOIN `inventory_medicine_generic_name` as `t2`
        ON `t`.`imgn_id`=`t2`.`imgn_id`
        GROUP BY `t2`.`imgn_id`");

        return $items;
    }

    public function quarterly($qq, $qy){
        if($qq==1){
            $lower = '01, '.$qy;
            $upper = '03, '.$qy;
        }
        else if($qq==2){
            $lower = '04, '.$qy;
            $upper = '06, '.$qy;
        }
        else if($qq==3){
            $lower = '07, '.$qy;
            $upper = '09, '.$qy;
        }
        else if($qq==4){
            $lower = '10, '.$qy;
            $upper = '12, '.$qy;
        }

        $items = DB::select("SELECT `t2`.`imgn_generic_name`, 
        (IF(ISNULL((SELECT SUM(`imi_quantity`) FROM `inventory_medicine_item` 
        WHERE DATE_FORMAT(`imi_date_added`, '%m, %Y') < '".$lower."' AND `imgn_id`=`t2`.`imgn_id`)),0,
        (SELECT SUM(`imi_quantity`) FROM `inventory_medicine_item` 
        WHERE DATE_FORMAT(`imi_date_added`, '%m, %Y') < '".$lower."' AND `imgn_id`=`t2`.`imgn_id`))
        -
        IF(ISNULL((SELECT SUM(`imt_quantity`) FROM `inventory_medicine_transaction` as `a1`
        LEFT JOIN `inventory_medicine_item` as `a2`
        ON `a1`.`imi_id`=`a2`.`imi_id` WHERE DATE_FORMAT(`imt_date`, '%m, %Y') < '".$lower."' AND `a2`.`imgn_id`=`t2`.`imgn_id`)),0,
        (SELECT SUM(`imt_quantity`) FROM `inventory_medicine_transaction` as `a1`
        LEFT JOIN `inventory_medicine_item` as `a2` ON `a1`.`imi_id`=`a2`.`imi_id` 
         WHERE DATE_FORMAT(`imt_date`, '%m, %Y') < '".$lower."' AND `a2`.`imgn_id`=`t2`.`imgn_id`)
        )) as 'initial_quantity',
        
        IF(ISNULL((SELECT SUM(`imi_quantity`) FROM `inventory_medicine_item` 
        WHERE `imgn_id`=`t2`.`imgn_id` AND DATE_FORMAT(`imi_date_added`, '%m, %Y') BETWEEN '".$lower."' AND '".$upper."')),0,
        (SELECT SUM(`imi_quantity`) FROM `inventory_medicine_item` 
        WHERE `imgn_id`=`t2`.`imgn_id` AND DATE_FORMAT(`imi_date_added`, '%m, %Y') BETWEEN '".$lower."' AND '".$upper."')) AS 'in_quantity',
        
        IF(ISNULL((SELECT SUM(`imt_quantity`) FROM `inventory_medicine_transaction` as `a1`
        LEFT JOIN `inventory_medicine_item` as `a2` ON `a1`.`imi_id`=`a2`.`imi_id` 
        WHERE `a2`.`imgn_id`=`t2`.`imgn_id` AND `a1`.`imt_type`='dispose' AND DATE_FORMAT(`imt_date`, '%m, %Y') BETWEEN '".$lower."' AND '".$upper."')),0,
        (SELECT SUM(`imt_quantity`) FROM `inventory_medicine_transaction` as `a1`
        LEFT JOIN `inventory_medicine_item` as `a2` ON `a1`.`imi_id`=`a2`.`imi_id` 
        WHERE `a2`.`imgn_id`=`t2`.`imgn_id` AND `a1`.`imt_type`='dispose' AND DATE_FORMAT(`imt_date`, '%m, %Y') BETWEEN '".$lower."' AND '".$upper."')
        ) AS 'out_dispose',
        
        IF(ISNULL((SELECT SUM(`imt_quantity`) FROM `inventory_medicine_transaction` as `a1`
        LEFT JOIN `inventory_medicine_item` as `a2` ON `a1`.`imi_id`=`a2`.`imi_id` 
        WHERE `a2`.`imgn_id`=`t2`.`imgn_id` AND `a1`.`imt_type`='dispense' AND DATE_FORMAT(`imt_date`, '%m, %Y') BETWEEN '".$lower."' AND '".$upper."')),0,
        (SELECT SUM(`imt_quantity`) FROM `inventory_medicine_transaction` as `a1`
        LEFT JOIN `inventory_medicine_item` as `a2` ON `a1`.`imi_id`=`a2`.`imi_id` 
        WHERE `a2`.`imgn_id`=`t2`.`imgn_id` AND `a1`.`imt_type`='dispense' AND DATE_FORMAT(`imt_date`, '%m, %Y') BETWEEN '".$lower."' AND '".$upper."')
        ) AS 'out_dispense'
        
        FROM `inventory_medicine_item` as `t`
        LEFT JOIN `inventory_medicine_transaction` as `t1`
        ON `t`.`imi_id`=`t1`.`imi_id`
        LEFT JOIN `inventory_medicine_generic_name` as `t2`
        ON `t`.`imgn_id`=`t2`.`imgn_id`
        GROUP BY `t2`.`imgn_id`");

        return $items;
    }

    public function annual($ay){
        $items = DB::select("SELECT `t2`.`imgn_generic_name`, 
        (IF(ISNULL((SELECT SUM(`imi_quantity`) FROM `inventory_medicine_item` 
        WHERE DATE_FORMAT(`imi_date_added`, '%Y') < '".$ay."' AND `imgn_id`=`t2`.`imgn_id`)),0,
        (SELECT SUM(`imi_quantity`) FROM `inventory_medicine_item` 
        WHERE DATE_FORMAT(`imi_date_added`, '%Y') < '".$ay."' AND `imgn_id`=`t2`.`imgn_id`))
        -
        IF(ISNULL((SELECT SUM(`imt_quantity`) FROM `inventory_medicine_transaction` as `a1`
        LEFT JOIN `inventory_medicine_item` as `a2`
        ON `a1`.`imi_id`=`a2`.`imi_id` WHERE DATE_FORMAT(`imt_date`, '%Y') < '".$ay."' AND `a2`.`imgn_id`=`t2`.`imgn_id`)),0,
        (SELECT SUM(`imt_quantity`) FROM `inventory_medicine_transaction` as `a1`
        LEFT JOIN `inventory_medicine_item` as `a2` ON `a1`.`imi_id`=`a2`.`imi_id` 
         WHERE DATE_FORMAT(`imt_date`, '%Y') < '".$ay."' AND `a2`.`imgn_id`=`t2`.`imgn_id`)
        )) as 'initial_quantity',
        
        IF(ISNULL((SELECT SUM(`imi_quantity`) FROM `inventory_medicine_item` 
        WHERE `imgn_id`=`t2`.`imgn_id` AND DATE_FORMAT(`imi_date_added`, '%Y') = '".$ay."')),0,
        (SELECT SUM(`imi_quantity`) FROM `inventory_medicine_item` 
        WHERE `imgn_id`=`t2`.`imgn_id` AND DATE_FORMAT(`imi_date_added`, '%Y') = '".$ay."')) AS 'in_quantity',
        
        IF(ISNULL((SELECT SUM(`imt_quantity`) FROM `inventory_medicine_transaction` as `a1`
        LEFT JOIN `inventory_medicine_item` as `a2` ON `a1`.`imi_id`=`a2`.`imi_id` 
        WHERE `a2`.`imgn_id`=`t2`.`imgn_id` AND `a1`.`imt_type`='dispose' AND DATE_FORMAT(`imt_date`, '%Y') = '".$ay."')),0,
        (SELECT SUM(`imt_quantity`) FROM `inventory_medicine_transaction` as `a1`
        LEFT JOIN `inventory_medicine_item` as `a2` ON `a1`.`imi_id`=`a2`.`imi_id` 
        WHERE `a2`.`imgn_id`=`t2`.`imgn_id` AND `a1`.`imt_type`='dispose' AND DATE_FORMAT(`imt_date`, '%Y') = '".$ay."')
        ) AS 'out_dispose',
        
        IF(ISNULL((SELECT SUM(`imt_quantity`) FROM `inventory_medicine_transaction` as `a1`
        LEFT JOIN `inventory_medicine_item` as `a2` ON `a1`.`imi_id`=`a2`.`imi_id` 
        WHERE `a2`.`imgn_id`=`t2`.`imgn_id` AND `a1`.`imt_type`='dispense' AND DATE_FORMAT(`imt_date`, '%Y')='".$ay."')),0,
        (SELECT SUM(`imt_quantity`) FROM `inventory_medicine_transaction` as `a1`
        LEFT JOIN `inventory_medicine_item` as `a2` ON `a1`.`imi_id`=`a2`.`imi_id` 
        WHERE `a2`.`imgn_id`=`t2`.`imgn_id` AND `a1`.`imt_type`='dispense' AND DATE_FORMAT(`imt_date`, '%Y')='".$ay."')
        ) AS 'out_dispense'
        
        FROM `inventory_medicine_item` as `t`
        LEFT JOIN `inventory_medicine_transaction` as `t1`
        ON `t`.`imi_id`=`t1`.`imi_id`
        LEFT JOIN `inventory_medicine_generic_name` as `t2`
        ON `t`.`imgn_id`=`t2`.`imgn_id`
        GROUP BY `t2`.`imgn_id`");

        return $items;
    }

    public function index(Request $request){
        
        $type = ($request->type) ? $request->type : 'monthly';

        $mm = '';
        $my = '';
        $qq = '';
        $qy = '';
        $ay = '';

        if($type == 'monthly'){
            $mm = ($request->mm) ? $request->mm : date('m');
            $my = ($request->my) ? $request->my : date('Y');
            $items = $this->monthly($mm, $my);
            $title = 'Medicine Inventory Report for: '.date("F", mktime(0, 0, 0, $mm, 10)).', '.$my;
        }
        else if($type == 'quarterly'){
            $qq = $request->qq;
            $qy = $request->qy;
            $items = $this->quarterly($qq, $qy);
            $title = 'Quarterly Medicine Inventory Report for: Quarter '.$qq.', '.$qy;
        }
        else if($type == 'annual'){
            $ay = $request->ay;
            $items = $this->annual($ay);
            $title = 'Annual Medicine Inventory Report for: '.$ay;
        }

        return view('Admin.Inventory.Medicine.Report')
            ->with([
                'items' => $items,
                'title' => $title,
                'type' => $type,
                'mm' => $mm,
                'my' => $my,
                'qq' => $qq,
                'qy' => $qy,
                'ay' => $ay
            ]);
    }

    public function print(Request $request){
        $type = ($request->type) ? $request->type : 'monthly';

        $mm = '';
        $my = '';
        $qq = '';
        $qy = '';
        $ay = '';

        if($type == 'monthly'){
            $mm = ($request->mm) ? $request->mm : date('m');
            $my = ($request->my) ? $request->my : date('Y');
            $items = $this->monthly($mm, $my);
            $title = 'Medicine Inventory Report for: '.date("F", mktime(0, 0, 0, $mm, 10)).', '.$my;
        }
        else if($type == 'quarterly'){
            $qq = $request->qq;
            $qy = $request->qy;
            $items = $this->quarterly($qq, $qy);
            $title = 'Quarterly Medicine Inventory Report for: Quarter '.$qq.', '.$qy;
        }
        else if($type == 'annual'){
            $ay = $request->ay;
            $items = $this->annual($ay);
            $title = 'Annual Medicine Inventory Report for: '.$ay;
        }
            
        $pdf = PDF::loadView('Reports.Inventory.Medicine', compact('items', 'title'));
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf->stream($title);
    }
}
