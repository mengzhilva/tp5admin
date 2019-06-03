<?php
namespace app\admin\controller;

class Index extends Base
{
    public function index()
    {
		return view('/base',['_view'=>'index']);
    }
  
}
