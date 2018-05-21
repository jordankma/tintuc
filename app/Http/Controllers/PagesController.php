<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PagesController extends Controller
{
    //
    public function __construct(){
    	$theloai = TheLoai::all();
    	$slide = Slide::all();
    	view()->share('theloai',$theloai);
    	view()->share('slide',$slide);	

        //kiem tra nguoi dung co dang nhap khong
        if(Auth::check()){
            view()->share('nguoidung',Auth::user());
        }
    }
    public function trangchu(){
        // $data_tophome = DB::table('tintuc')->where('NoiBatHome',1)->take(5);
        $tintuc = TinTuc::all();
    	return view('pages.trangchu',['tintuc'=>$tintuc]);
    }
    public function lienhe(){
    	return view('pages.lienhe');
    }
    public function loaitin($idLoaiTin){
    	$loaitin = LoaiTin::find($idLoaiTin);
    	$tintuc = TinTuc::where('idLoaiTin',$idLoaiTin)->paginate(5);
    	return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
    public function tintuc($id){
    	$tintuc = TinTuc::find($id);
    	$tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
    	$tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
    	return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }
    public function getDangnhap(){
        return view('pages.dangnhap');
    }
    public function postDangnhap(Request $request){
        $this->validate($request,
            [
                'password'=>'required',
                'email'=>'required'   
            ],
            [
                'password.required'=>'Bạn chưa nhập password',
                'email.required'=>'Bạn chưa nhập email'            
            ]);  

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('trangchu');
        }
        else{
            return redirect('dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }
    public function getDangxuat(){
        Auth::logout();
        return redirect('trangchu');
    }
    public function getNguoiDung(){
        return view('pages.nguoidung');
    }
    public function postNguoiDung(Request $request){
        $this->validate($request,
            [
                'name'=>'required|min:3'  
            ],
            [
                'name.required'=>'Bạn chưa nhập tên',
                'name.min'=>"Tên phải tối thiểu 3 ký tự"      
            ]);
        $user = Auth::user();
        $user->name = $request->name;
        if($request->changePassword== "on"){
            $this->validate($request,
            [
                'password'=>'required|min:3|max:30',
                'passwordAgain'=>'required|same:password',    
            ],
            [
                'password.required'=>'Bạn chưa nhập password',
                'password.min'=>"Password phải tối thiểu 3 ký tự, tối đa 30 ký tự",
                'password.max'=>"Password phải tối thiểu 3 ký tự, tối đa 30 ký tự",
                'passwordAgain.required'=>'Bạn chưa nhập lại password',
                'passwordAgain.same'=>'Mật khẩu không khớp'             
            ]);
            $user->password = bcrypt($request->password);
        }
        $user ->save();
        return redirect('nguoidung')->with('thongbao','Bạn đã sửa thành công');    
    }
    public function getDangky(){
        return view('pages.dangky');
    }
    public function postDangky(Request $request){
        $this->validate($request,
            [
                'name'=>'required|min:3',
                'email'=>'required|email|unique:Users,email',
                'password'=>'required|min:3|max:30',
                'passwordAgain'=>'required|same:password',    
            ],
            [
                'name.required'=>'Bạn chưa nhập tên',
                'name.min'=>"Tên phải tối thiểu 3 ký tự",
                'email.required'=>'Bạn chưa nhập email',
                'email.email'=>'Bạn chưa nhập đúng định dạng email',
                'email.unique'=>'Email đã dùng để đăng ký mời nhập lại',
                'password.required'=>'Bạn chưa nhập password',
                'password.min'=>"Password phải tối thiểu 3 ký tự, tối đa 30 ký tự",
                'password.max'=>"Password phải tối thiểu 3 ký tự, tối đa 30 ký tự",
                'passwordAgain.required'=>'Bạn chưa nhập lại password',
                'passwordAgain.same'=>'Mật khẩu không khớp'             
            ]);  
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = 0; 
        $user->save();
        return redirect('dangky')->with('thongbao','Đăng ký thành công');     
    }
    public function timkiem(Request $request){
        $tukhoa = $request->tukhoa;
        $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"%$tukhoa%")->orWhere('NoiDung','like',"%$tukhoa%")->take(50)->paginate(5);
        return view('pages.timkiem',['tintuc' => $tintuc,'tukhoa'=>$tukhoa]);
    }
    public function gioithieu(){
        return view('pages.gioithieu');
    }
}
