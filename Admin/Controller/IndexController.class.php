<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    
    }
    /**
     *退出
     * @return [type] [description]
     */
     public function logoutAjax(){
    	cookie('admin',null);
    	cookie('login',null);
    	$this->successReturn('退出成功');
    }

}