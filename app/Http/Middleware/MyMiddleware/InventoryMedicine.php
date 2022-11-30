<?php

namespace App\Http\Middleware\MyMiddleware;

use Closure;
use Illuminate\Http\Request;
use DB;
use Session;

class InventoryMedicine
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $total_expiry = '';
        $total_expired = '';
        $expiry = DB::select("SELECT ((SELECT SUM(t1.imi_quantity) FROM inventory_medicine_item as t1 WHERE t1.imi_id IN (SELECT DISTINCT(t2.imi_id) FROM inventory_medicine_item as t2 WHERE datediff(t2.`imi_expiration`,NOW()) BETWEEN 1 AND 14))-IFNULL(SUM(imt.imt_quantity),0)) AS 'total_expiry'
        FROM `inventory_medicine_item` as imi 
        LEFT JOIN `inventory_medicine_transaction` as imt 
        ON imi.imi_id=imt.imi_id
        WHERE datediff(imi.`imi_expiration`,NOW()) BETWEEN 1 AND 14
        HAVING (SUM(DISTINCT imi.imi_quantity)-IFNULL(SUM(imt.imt_quantity),0)) > 0");
        
        $expired = DB::select("SELECT ((SELECT SUM(t1.imi_quantity) FROM inventory_medicine_item as t1 WHERE t1.imi_id IN (SELECT DISTINCT(t2.imi_id) FROM inventory_medicine_item as t2 WHERE t2.`imi_expiration` <= NOW()))-IFNULL(SUM(imt.imt_quantity),0)) AS total_expiry
        FROM `inventory_medicine_item` as imi 
        LEFT JOIN `inventory_medicine_transaction` as imt 
        ON imi.imi_id=imt.imi_id
        WHERE imi.`imi_expiration` <= NOW()
        ");

        foreach($expiry as $e){
            $total_expiry = $e->total_expiry;
        }

        foreach($expired as $e){
            $total_expired = $e->total_expiry;
        }

        Session::put('total_expiry', $total_expiry);
        Session::put('total_expired', $total_expired);
        // Session::save();
        return $next($request);
    }
}
