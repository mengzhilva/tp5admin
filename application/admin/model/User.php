<?php
namespace app\admin\model;

use think\Model;
use think\db;

class User extends Model
{
    protected $table = 'user';
    
    function getList($where){
    	return Db::name('user')->where($where)->select();
    }
    function getOne($where){
    	//return $this->where($where)->find()->data;
    	return Db::name('user')->where($where)->find();
    }
    function updatedata($data,$where){
    	return Db::name('user')->where($where)->update($data);
    	
    }
    function adddata($data){
    	return Db::name('user')->insert($data);
    }
 
}