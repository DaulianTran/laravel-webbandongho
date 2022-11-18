<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hotro;
use App\Models\Traloicauhoi;
use Illuminate\Http\Request;
use App\Http\Requests\SupportRequest;
use DB;

class SupportController extends Controller
{
    protected $SupportPerPage = 15;

    public function getFAQ(){
        return DB::table('traloicauhoi')->get();
    }

    public function getFAQTitle(){
        return DB::table('traloicauhoi')->select('idcauhoi','noidungcauhoi')->get();
    }

    public function index(){
        return view('admin.support.index')->with('SupportNums',$this->getSupportNums())
                                          ->with('Support',$this->getSupportByPage())
                                          ->with('FAQ',$this->getFAQTitle());
    }

    public function addSupportPage(){
        return view('admin.support.add');
    }

    // public function addSupport(SupportRequest $request){
    //     $hotro = new hotro;
    //     $hotro->tieude = $request->tieude;
    //     $hotro->noidungngan = $request->noidungngan;
    //     $hotro->noidungchitiet = $request->noidungchitiet;
    //     $hotro->tacgia = $request->tacgia;

    //     if($request->trangthai != null)
    //         $hotro->trangthai = 1;
    //     else
    //         $hotro->trangthai = 0;

    //     if ($request->hasFile('hinhanh')) {
    //         $destination = 'public/uploads/support';
    //         $get_image = $request->file('hinhanh');
    //         $get_name_image = time()."_".$get_image->getClientOriginalName();
    //         $hotro->hinhanh = $get_name_image;
    //         $get_image->move($destination, $get_name_image);
    //     } else {
    //         $sanpham->hinhanh = "DefaultSupportPicture.jpg";
    //     }

    //     if($hotro->save()){
    //         toastr()->success('Thêm hỗ trợ <b>'. $hotro->tieude. '</b> thành công');
    //         return redirect('/admin/support');
    //     } else {
    //     toastr()->error('Thêm hỗ trợ thất bại!');
    //     }
    // }

    public function updateSupportPage($SupportID){
        return view('admin.support.update')->with('supportDetail',$this->getSupportById($SupportID));
    }

    public function  updateSupport(SupportRequest $request, $idSupport){
        $hotro = hotro::find($idSupport);
        $hotro->tieude = $request->tieude;
        $hotro->noidungngan = $request->noidungngan;
        $hotro->noidungchitiet = $request->noidungchitiet;
        $hotro->tacgia = $request->tacgia;

        if($request->trangthai != null)
            $hotro->trangthai = 1;
        else
            $hotro->trangthai = 0;

        if ($request->hasFile('hinhanh')) {
            $destination = 'public/uploads/support';
            $get_image = $request->file('hinhanh');
            $get_name_image = time()."_".$get_image->getClientOriginalName();
            $hotro->hinhanh = $get_name_image;
            $get_image->move($destination, $get_name_image);
        }

        if($hotro->save()){
            toastr()->success('Cập nhật hỗ trợ <b>'. $hotro->tieude. '</b> thành công!');
            return redirect('/admin/support');
        } else {
        toastr()->error('Cập nhật hỗ trợ <b>'. $hotro->tieude. '</b> thất bại!');
        }
    }

    public function deleteSupport($idSupport){
        $hotro = hotro::find($idSupport);
        if($hotro->delete()){
            toastr()->success('Xóa hỗ trợ <b>'. $hotro->tieude. '</b> thành công!');
            return redirect('/admin/support');
        } else {
            toastr()->error('Xóa hỗ trợ thất bại!');
            return redirect('/admin/support');
        }
    }

    public function getSupportNums(){
        return DB::table('hotro')->count();
    }

    public function getSupportByPage(){
        return DB::table('hotro')->paginate($this->SupportPerPage);
    }

    public function getSupport(){
        return DB::table('hotro')->get();
    }

    public function getSupportById($SupportID){
        return DB::table('hotro')->where('idhotro', $SupportID)->first();
    }
}
