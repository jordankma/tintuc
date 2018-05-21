<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
class AjaxController extends Controller
{
    //
    public function getLoaiTin($idTheLoai){
        $loaitin = LoaiTin::where('idTheLoai',$idTheLoai)->get();
        foreach ($loaitin as $lt ) {        
            echo "<option value='".$lt->id."'>".$lt->Ten."</option>";
        }
    }
    public function getTin1($TuKhoaTin1){
        $tintuc = TinTuc::where('TieuDe','like',"%$TuKhoaTin1%")->get();
        foreach ($tintuc as $tt ) {        
            echo "<option value='".$tt->id."'>".$tt->TieuDe."</option>";
        }
        //echo "le van tuan";
    }   
}
?>