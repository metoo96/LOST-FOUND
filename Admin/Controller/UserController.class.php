<?php
namespace Admin\Controller;
user Think\Controller;
class UserController extends Controller{
	public function login(){
		$this->display();
	}
	public function loginAjax(){
		$data=$this->getLoginData();
        $this->checkLogin($data);
	}
	public function getLoginData(){
		 $data['number'] =I('post.number');
		 $data['password'] = I('post.password');
		 $this->checkData($data);
		 return $data;
	}
	public function checkData($data){
		foreach($data as $key => $value){
			if($data[$key]==null || $data['$key'] == ''){
				$this->errorReturn('用户名或密码不全');
			}
		}
	}
	public function checkLogin($data){
		
	}
}