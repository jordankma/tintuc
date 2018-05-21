<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Comment;
class TinTucController extends Controller
{
    //
    public function getDanhSach(){
    	$tintuc = TinTuc::all();
    	return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }
    public function getThem(){
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postThem(Request $request){
    	 $this->validate($request,
            [
                'LoaiTin'=>'required',
                'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
                'TomTat'=>'required|min:3',
                'NoiDung'=>'required'
            ],
            [
                'LoaiTin.required'=>'Bạn chưa chọn loại tin',
                'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
                'TieuDe.min'=>'Bạn phải nhập ít nhất 3 ký tư',
                'TieuDe.unique'=>'Tiêu đề đã trùng',
                'TomTat.required'=>'Bạn chưa nhập tóm tắt',
                'Noidung.required'=>'Bạn chưa nhập nội dung'
            ]);
         $tintuc = new TinTuc();
         $tintuc ->TieuDe = $request->TieuDe;
         $tintuc ->TieuDeKhongDau = changeTitle($request->TieuDe);
         $tintuc ->idLoaiTin = $request->LoaiTin;
         $tintuc ->TomTat = $request -> TomTat;
         $tintuc ->NoiDung = $request ->NoiDung;
         $tintuc ->SoLuotXem = 0;
         $tintuc -> NoiBat = $request->NoiBat;
         $tintuc -> NoiBatHome = $request->NoiBatHome;
         $tintuc ->updated_at = date('Y-m-d H:i:s');
         if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png' ){
                return redirect("admin/tintuc/them")->with('loi','Bạn đã chọn không phải file ảnh');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/tintuc/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            $tintuc -> Hinh = $Hinh;
         }
         else{
            $tintuc->Hinh= "";
         }
         $tintuc->save();
         return redirect("admin/tintuc/them")->with('thongbao','Bạn đã thêm thành công');
    }
    public function getSua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        return view("admin.tintuc.sua",["tintuc"=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);			
    }
    public function postSua(Request $request , $id){
    	$tintuc = TinTuc::find($id);
        $this->validate($request,
            [
                'LoaiTin'=>'required',
                'TieuDe'=>'required|min:3',
                'TomTat'=>'required|min:3',
                'NoiDung'=>'required'
            ],
            [
                'LoaiTin.required'=>'Bạn chưa chọn loại tin',
                'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
                'TieuDe.min'=>'Bạn phải nhập ít nhất 3 ký tư',
                'TomTat.required'=>'Bạn chưa nhập tóm tắt',
                'Noidung.required'=>'Bạn chưa nhập nội dung'

            ]);
         $tintuc ->TieuDe = $request->TieuDe;
         $tintuc ->TieuDeKhongDau = changeTitle($request->TieuDe);
         $tintuc ->idLoaiTin = $request->LoaiTin;
         $tintuc ->TomTat = $request -> TomTat;
         $tintuc ->NoiDung = $request ->NoiDung;
         $tintuc -> NoiBat = $request->NoiBat;
         $tintuc -> NoiBatHome = $request->NoiBatHome;
         $tintuc ->updated_at = date('Y-m-d H:i:s');
         if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png' ){
                return redirect("admin/tintuc/them")->with('loi','Bạn đã chọn không phải file ảnh');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/tintuc/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }

            $file->move("upload/tintuc",$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc -> Hinh = $Hinh;
         }
         $tintuc->save();
         return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Sửa thành công');

    }
    public function getXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Xóa thành công');
    }
}
