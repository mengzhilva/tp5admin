<?php
namespace app\admin\model;

use think\Model;
use think\db;

class Settings_module extends Model
{
    protected $table = 'settings_module';
    
    function getModuleList($where,$order='',$limit=''){
    	return Db::name('settings_module')->where($where)->order($order)->limit($limit)->select();
    }
    function getModuleListpage($where,$order='',$pagesize=20){
    	return Db::name('settings_module')->where($where)->order($order)->paginate($pagesize);
    }
    function getModule($where){
    	//return $this->where($where)->find()->data;
    	return Db::name('settings_module')->where($where)->find();
    }
    function updateModule($data,$where){
    	return $this->where($where)->update($data);
    	
    }
    function addModule($data,$where){
    	return $this->save($data);
    }
    function getUrlList($where,$order='',$limit=''){
    	return Db::name('settings_url')->alias('a')->join('settings_module b ',' a.module_id=b.id','','left')
    	->field(' a.*,b.name as mname ')
    	->where($where)->order($order)->limit($limit)
    	->select();
    }
    function getUrlListpage($where,$order='',$pagesize=20){
    	return Db::name('settings_url')->alias('a')->join('settings_module b ',' a.module_id=b.id','','left')
    	->field(' a.*,b.name as mname ')
    	->where($where)->order($order)
    	->paginate($pagesize);
    }
    function getUrl($where){
    	//return $this->where($where)->find()->data;
    	return Db::name('settings_url')->where($where)->find();
    }
    function updateUrl($data,$where){
    	return Db::name('settings_url')->where($where)->update($data);
    	
    }
    function addUrl($data,$where){
    	return Db::name('settings_url')->insert($data);
    }
}