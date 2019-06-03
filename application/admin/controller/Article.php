<?php
namespace app\admin\controller;

use app\admin\model\Settings_module;
class Article
{
    public function index()
    {
		return view('/base',['_view'=>'article/list']);
    }
	public function modulelist()
	{
		$where = array();
		$where['online'] = 1;
		$orderby = ' order by sort asc';
		$Settings_module= new Settings_module;
		$list = $Settings_module->getModuleList($where);
		var_dump($list);
		
		return view('/base',['_view'=>'setting/list']);
	}
	
    public function edit()
    {
		return view('/base',['_view'=>'article/edit']);
    }
}
