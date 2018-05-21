<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function comment(){
        return $this->hasMany('App\Comment','idUser','id');
    }
    public function getSearch($params) {
        $query = self::orderBy('id', 'desc');
        if (!empty($params['user_name']) && $params['user_name'] != null) {
            $query->where('user_name', 'like', '%' . $params['user_name'] . '%');
        }
        if (!empty($params['name']) && $params['name'] != null) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
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
        return $data;
    }
}
