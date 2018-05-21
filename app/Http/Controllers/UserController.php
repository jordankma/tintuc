<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;
class UserController extends Controller
{
    //
    public function getDanhSach(){
    	$user = User::all();
    	return view('admin.user.danhsach',['user'=>$user]);
    }
    public function getThem(){
    	return view('admin.user.them');

    }
    public function postThem(Request $request){
    	$this->validate($request,
            [
            	'name'=>'required|min:3',
            	'email'=>'required|email|unique:Users,email',
            	'password'=>'required|min:3|max:30',
            	'passwordagain'=>'required|same:password',    
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
                'passwordagain.required'=>'Bạn chưa nhập lại password',
                'passwordagain.same'=>'Mật khẩu không khớp'             
            ]);
    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->quyen = $request->quyen;
    	$user->password = bcrypt($request->password);
    	$user ->save();
    	return redirect('admin/user/danhsach')->with('thongbao','Bạn đã thêm thành công');
    }
    public function getSua($id){
    	$user = User::find($id);
    	return view('admin.user.sua',['user'=>$user]);
    }
    public function postSua(Request $request,$id){
    	$this->validate($request,
            [
            	'name'=>'required|min:3'  
            ],
            [
                'name.required'=>'Bạn chưa nhập tên',
                'name.min'=>"Tên phải tối thiểu 3 ký tự"      
            ]);
    	$user = User::find($id);
    	$user->name = $request->name;
    	$user->quyen = $request->quyen;
    	if($request->changePassword== "on"){
    		$this->validate($request,
            [
            	'password'=>'required|min:3|max:30',
            	'passwordagain'=>'required|same:password',    
            ],
            [
                'password.required'=>'Bạn chưa nhập password',
                'password.min'=>"Password phải tối thiểu 3 ký tự, tối đa 30 ký tự",
                'password.max'=>"Password phải tối thiểu 3 ký tự, tối đa 30 ký tự",
                'passwordagain.required'=>'Bạn chưa nhập lại password',
                'passwordagain.same'=>'Mật khẩu không khớp'             
            ]);
    		$user->password = bcrypt($request->password);
    	}
    	$user ->save();
    	return redirect('admin/user/sua/'.$id)->with('thongbao','Bạn đã sửa thành công');	
    }
    public function getXoa($id){
    	$user = User::find($id);
    	$user->delete();
    	return redirect("admin/user/danhsach")->with('thongbao','Bạn đã xóa thành công');
    }
    public function getDangnhapAdmin(){
        return view('admin.login');
    }
    public function postDangnhapAdmin(Request $request){
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
            return redirect('admin/theloai/danhsach');
        }
        else{
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }
    public function getDangxuatAdmin(){
         return redirect('admin/dangnhap');   
    }
    public function getFilter(Request $request){
        $params['user_name'] = $request->name;
        $params['email'] = $request->username;
        $params['start'] = $request->startDate;
        $params['end'] = $request->endDate;
        $query = User::orderBy('id', 'desc');
        if (!empty($params['user_name']) && $params['user_name'] != null) {
            $query->where('name', 'like', '%' . $params['user_name'] . '%');
        }
        if (!empty($params['email']) && $params['email'] != null) {
            $query->where('email', 'like', '%' . $params['email'] . '%');
        }
        if (!empty($params['email']) && $params['email'] != null) {
            $query->where('email', 'like', '%' . $params['email'] . '%');
        }
        if ((!empty($params['start']) && !empty($params['end'])) && ($params['end'] != null && $params['start'] != null)) {
            $fromDate = date($params['start'] . ' 00:00:00', time());
            $toDate = date($params['end'] . ' 23:59:59', time());
            $query->whereBetween('created_at', array($fromDate, $toDate));
        }
        if (!empty($params['page']) && $params['page'] != null) {
            $page=$params['page'];
        }
        else
        {
            $page=10;
        }
        $data=$query->paginate($page);  
        foreach ($data as $value) {
            $value->name;
        }
        dd($data); 
    }

}
