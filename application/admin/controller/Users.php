<?php
namespace app\admin\controller;

use app\admin\model\User;
use think\Request;


class Users extends Base
{
	public function _initialize()
	{
		parent::_initialize();
	}
	public function lists()
	{
		$where = array();
		$user= new User;
		$list = $user->getList($where);
		$data['list'] = $list;
		
		return $this->fetch('/base',['_view'=>'user/list','data'=>$data]);
	}

	public function usersave()
	{
		$data = array();
		$module = array();
		$request = Request::instance();
		$data = $request->param();
		$opt = isset($data['opt'])?$data['opt']:0;
		$id = isset($data['id'])?$data['id']:0;
		$user= new User;
		if(!empty($opt) && $opt=='save'){
			//保存
			$datas = array();
			$datas = $data['data'];
			$datas['password'] = md5($datas['password']);
			if($id>0){
				//update
				$user->updatedata($datas,array('id'=>$id));
            	$this->success('修改成功', 'admin/users/lists');
			}else{
				//insert
				$user->adddata($datas);
            	$this->success('新增成功', 'admin/users/lists');
			}
			//header("Location:/manager/settings_modulelist/");
			exit;
		}
	
		if($id>0){
			$module = $user->getOne(array('id'=>$id));
			//$module = Settings_module::get(array('id'=>$id));
		}
		$data['module'] = $module;
		return $this->fetch('/base',['_view'=>'user/edit','data'=>$data]);
	}
	
}
