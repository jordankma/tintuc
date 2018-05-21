<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\Http\Requests;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\TinTuc;
class CommentController extends Controller
{
    //
    public function getXoa($id,$idTinTuc){
    	$comment = Comment::find($id);
        $comment -> delete();
        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao','Xóa comment thành công');
    } 
    public function postComment($id,Request $request){
        if(Request::ajax()){
        	$idTinTuc = $id;
        	$tintuc = TinTuc::find($id);
        	$comment = new Comment();
        	$comment -> idTinTuc = $idTinTuc;
        	$comment -> idUser = Auth::user()->id;
        	$comment -> NoiDung = $request->NoiDung;
        	$comment->save();
            $response = array(
                'status' => 'success',
                'msg' => 'Setting created successfully',
            );
            return 'yea';
            }else{
                return 'no';
            }
        	//return redirect("tintuc/".$id."/".$tintuc->TieuDeKhongDau.".html");
        
    }
}
