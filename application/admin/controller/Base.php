<?php
namespace app\admin\controller;

use app\admin\model\Settings_module;
use think\Request;
use think\Session;

class Base extends \think\Controller
{

	public function _initialize()
	{
		$user = Session::get('userinfo');
		if(empty($user)){
			$this->redirect('/admin/Member/login');
		}
		$Settings_module= new Settings_module;
		$leftlist = $Settings_module->getModuleList();
		$where['is_show'] = 1;
		if($leftlist){
			foreach ($leftlist as $k=>$v){
			$where['module_id'] = $v['id'];
			$urls = $Settings_module->getUrlList($where);
				if($urls){
					$leftlist[$k]['urls'] = $urls;
				}else{
					unset($leftlist[$k]);
				}
			}
		}
		$this->assign('leftlist',$leftlist);
		
		$current_url = $_SERVER['REQUEST_URI'];
		$arr_url = explode('?',$current_url);
		$current_url = $arr_url[0];

		$where = array();
		$where['url'] = $current_url;
		$ParentNav = $Settings_module->getUrl($where);
		//var_dump($ParentNav);
		$this->assign('ParentNav',$ParentNav);
		
		//$url_c = SettingsQuery::getUrl($where);
		//unset($where['url']);

		//$where['id'] = $url_c['father_menu'];
		//$ParentNav = SettingsQuery::getUrl($where);
	}
}