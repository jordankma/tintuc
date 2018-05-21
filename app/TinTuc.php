<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    //
    protected $table = 'Tintuc';
    public function loaitin(){
    	return $this->belongsTo('App\LoaiTin','idLoaiTin','id');
    }
    public function comment(){
    	return $this->hasMany('App\Comment','idTinTuc','id');
    }
    public function getTintucByID($id){
    	$tintuc = TinTuc::fnd($id);
    	return $tintuc;
    }
}
