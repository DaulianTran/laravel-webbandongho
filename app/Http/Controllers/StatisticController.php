<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class StatisticController extends Controller
{
    public function index(){
        return view('admin.statistic.index');
    }

    public function profitByDateRange(Request $request){
        if ($request->ajax()) {
            $fromDate = $request->get('fromDate');
            $toDate = $request->get('toDate');
        }

        if($fromDate == null)
        $fromDate = 0;
        if($toDate == null)
        $toDate = now();

        $chart_data = [];
        $DateList = DB::table('hoadon')->select('created_at')
                                       ->whereDate('created_at', '>=', $fromDate)
                                       ->whereDate('created_at', '<=', $toDate)
                                       ->oldest()->distinct()->get();
        foreach($DateList as $row){
            $SaleByDate = DB::table('hoadon')->select('hoadon.idhoadon','chitiethoadon.gia','chitiethoadon.soluong','chitiethoadon.giamgia')
                                             ->whereDate('hoadon.created_at',$row->created_at)
                                             ->join('chitiethoadon', 'chitiethoadon.idhoadon', '=', 'hoadon.idhoadon')
                                             ->get()->toArray();
            $doanhthu = 0;
            foreach($SaleByDate as $subrow){
                $doanhthu += $subrow->gia * $subrow->soluong;
            }
            $chart_data[] = array(
                'date' => $row->created_at,
                'sales' => $doanhthu
            );
        }
        return json_encode($chart_data);
    }
}