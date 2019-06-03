<?php
namespace app\admin\controller;

use app\admin\model\Settings_module;
use think\Request;
use think\Db;


class Setting extends Base
{
	public function _initialize()
	{
		parent::_initialize();
	}
    public function index()
    {
		return view('/base',['_view'=>'index']);
    }
	public function modulelist()
	{
		$where = array();
		$pagesize = 20;
		$request = Request::instance();
		$data = $request->param();
		$search = $data['keyword'];
		if($search){
			$where['name'] = ['like','%'.$search.'%'];
		}
		$where['online'] = 1;
		$orderby = 'id desc';
		$Settings_module= new Settings_module;
		$list = $Settings_module->getModuleListpage($where,$orderby,$pagesize);
		$data['list'] = $list;
		$page = $list->render();
		$this->assign('page', $page);
		
		return $this->fetch('/base',['_view'=>'setting/list','data'=>$data]);
	}

	public function modulesave()
	{
		$data = array();
		$module = array();
		$request = Request::instance();
		$data = $request->param();
		$opt = isset($data['opt'])?$data['opt']:0;
		$id = isset($data['id'])?$data['id']:0;
		$Settings_module= new Settings_module;
		if(!empty($opt) && $opt=='save'){
			//保存
			$datas = array();
			$datas = $data['data'];
			if($id>0){
				//update
				$Settings_module->updateModule($datas,array('id'=>$id));
            	$this->success('修改成功', 'admin/Setting/modulelist');
			}else{
				//insert
				$Settings_module->addModule($datas);
            	$this->success('新增成功', 'admin/Setting/modulelist');
			}
            $this->success('新增成功', 'admin/Setting/modulelist');
			//header("Location:/manager/settings_modulelist/");
			exit;
		}
	
		if($id>0){
			$module = $Settings_module->getModule(array('id'=>$id));
			//$module = Settings_module::get(array('id'=>$id));
		}
		$data['module'] = $module;
		return $this->fetch('/base',['_view'=>'setting/edit','data'=>$data]);
	}
	public function urllist()
	{
		$where = array();
		$pagesize = 2;
		$request = Request::instance();
		$data = $request->param();
		$search = $data['keyword'];
		$status = $data['status'];
		if($search){
			$where['a.name'] = ['like','%'.$search.'%'];
		}
		if($status!==''&&isset($status)){
			$where['a.online'] = $status;
		}
		$orderby = 'sort asc';
		$Settings_module= new Settings_module;
		$list = $Settings_module->getUrlListpage($where,$orderby,$pagesize);
		$data['list'] = $list;
		$page = $list->render();
		$this->assign('page', $page);
		
		return $this->fetch('/base',['_view'=>'setting/urllist','data'=>$data]);
	}

	public function urlsave()
	{
		$data = array();
		$data['module'] = array();
		$request = Request::instance();
		$data = $request->param();
		$opt = isset($data['opt'])?$data['opt']:0;
		$id = isset($data['id'])?$data['id']:0;
		$Settings_module= new Settings_module;
		$wheres['online'] = 1;
		$modules = $Settings_module->getModuleList($wheres);
		$data['modules'] = $modules;
		if(!empty($opt) && $opt=='save'){
			//保存
			$datas = array();
			$datas = $data['data'];
			if($id>0){
				//update
				$Settings_module->updateUrl($datas,array('id'=>$id));
            	$this->success('修改成功', 'admin/Setting/urllist');
			}else{
				//insert
				$Settings_module->addUrl($datas);
            	$this->success('新增成功', 'admin/Setting/urllist');
			}
			//header("Location:/manager/settings_modulelist/");
			exit;
		}
	
		if($id>0){
			$module = $Settings_module->getUrl(array('id'=>$id));
		}
		$data['module'] = $module;
		return $this->fetch('/base',['_view'=>'setting/urledit','data'=>$data]);
	}
}
