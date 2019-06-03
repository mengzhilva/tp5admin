<?php
namespace app\admin\controller;

use app\admin\model\User;
use think\Request;
use think\Session;


class Member extends \think\Controller
{
	public function _initialize()
	{
		parent::_initialize();
	}
	public function login()
	{
		$where = array();
		$data = array();
		
		return view('/Member/login',['data'=>$data]);
	}

	public function loginin()
	{
		$request = Request::instance();
		$data = $request->param();
		$model = new User();
		$user = $model->getOne(array('username'=>$data['username']));
		if($user&&$user['password'] == md5($data['password'])){
			session::set('userinfo',$user);
			$this->redirect('/admin/Index/index');
		}else{
			$this->error('密码错误');
		}
	
	}
	
}
