<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
       $this->display();
    }
   /**
   *正确时返回
   * @param  [type] $msg [description]
   * @return [type]      [description]
   */
  private function successReturn($msg){
      $res['success'] = true;
      $res['msg'] = $msg;
      $this->ajaxReturn($res);
    }

    /**
     * 手动插入一个用户
     * @return [type] [description]
     */
  public function insertAdmin(){
     $data['username']= 'zhuguozhu';
     $data['password']= md5('1211651004');
     $data['cookie'] = md5($data['username']).md5($data['password']);
     M('admin')->add($data);
  }
 
  /**
   *错误时返回
   * @param  [type] $errmsg [description]
   * @return [type]         [description]
   */
  

    private function errorReturn($errmsg){
      $res['success'] = false;
      $res['errmsg'] = $errmsg;
      $this->ajaxReturn($res);
    }

    /**
     * 登录
     */
    public function checkloginAjax(){
       $data['username']= I('post.username');
       $data['password']= md5(I('post.password'));
       $this->checkData($data);
       $data['cookie'] = md5($data['username']).md5($data['password']);
       $admin=M('Admin')->where(array('username'=>$data['username']))->find();
       if($data['cookie']===$admin['cookie']){
        cookie('key',$admin['cookie']);
        cookie('username',$data['username']);
        $this->successReturn('登录成功');
       }else{
        $this->errorReturn('登录失败');
       }
    }
     /**
     * 用于检验数据是否完整
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    private function checkData($data){
      foreach ($data as $key => $value) {
        if($data[$key] == null || $data[$key] == ''){
          $this->errorReturn('信息不全');
        }
      }
    }
    

    /**
     *退出
     * @return [type] [description]
     */
     public function logoutAjax(){
    	cookie('key',null);
      cookie('username',null);
      $this->redirect('Admin/Login/index');
    }
}