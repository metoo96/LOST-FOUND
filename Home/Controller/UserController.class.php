<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
     private $usermodel;
     public function __construct(){
          parent::__construct();
          $this->usermodel=D('User');
     }



     public function index(){
          $this->display();
     }



     public function fullMsg(){
          $user = $this->usermodel->where(array('user_mobile'=>cookie('user_mobile')))->find();
          $this->assign('user',$user);
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
     * 开始获取验证码
     * @return [type] [description]
     */
     public function getCodeAjax(){
      $data = $this->getMobileData();//获取手机号码
      $this->setData($data['user_mobile']);//将数据添加到数据库
    }




     /*
    * 获取手机的数据
    */
    private function getMobileData(){
      $data['user_mobile'] = I('post.mobile');
      if($data['user_mobile']==null||$data['user_mobile']==''){
        $this->errorReturn('手机号不能为空');//返回时已经就结束了
      }
      return $data;
    }



      
      /**
       * 更新
       * @param  [type] $mobile [description]
       * @return [type]         [description]
       */
      private function setData($mobile){
        $this->updateUser($mobile);
    }





      private function updateUser($mobile){
      $data['user_mobile'] = $mobile;
      $data['user_code'] = rand(1001,9999);
      $result = M('User')->where(array('user_mobile'=>cookie('user_mobile')))->save($data);
      if($result!=false){
        //发送验证码
        //$this->sendCode($data['user_mobile'],$data['user_code']);
        //由于发送验证码部分未能成功实现暂且不调用
        $this->successReturn("验证码已成功");
      }else {
        $this->errorReturn('新增用户数据失败');
      }
    }

  



     /*
    * 发送验证码
    */
    private function sendCode($phone,$code){
        $remote_server = "http://www.cybergear-cn.com/ACM/send.php?phone=".$phone."&code=".$code;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remote_server);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "jb51.net's CURL Example beta");
        $data = curl_exec($ch);
        curl_close($ch);
        $result = M('User')->where(array('user_mobile'=>$phone))->setField('time',time());
        if($result!==false){
          $this->successReturn('发送成功');
        }else {
          $this->errorReturn('数据更新失败');
        } 
        return $data;
    }








     /**
     * 开始检验验证码
     * @return [type] [description]
     */
     public function checkCodeAjax(){
      //手机号不修改与修改的情况
      if(cookie('user_mobile')==I('post.mobile')){
        $data['user_number']=I('post.number');
        $data['user_name']=I('post.name');
        $data['user_mobile']=I('post.mobile');
        $this->checkData($data);
        M('User')->where(array('user_mobile'=>cookie('user_mobile')))->save($data);
        $this->loginSuccess($data['user_mobile']);
      }else{
      $data = $this->getCheckData();
      if($this->checkUserCode($data['user_mobile'],$data['user_code'])){
        M('User')->where(array('user_mobile'=>cookie('user_mobile')))->save($data);
        M('Lost')->where(array('lost_mobile'=>cookie('user_mobile')))->setField(array('lost_mobile'=>$data['user_mobile']));
        M('Lost')->where(array('find_mobile'=>cookie('user_mobile')))->setField(array('find_mobile'=>$data['user_mobile']));
        $this->loginSuccess($data['user_mobile']);
      }else {
        $this->errorReturn('验证码错误');
      }
     }
    }




      private function getCheckData(){ 
      $data['user_number'] = I('post.number');
      $data['user_name'] = I('post.name');
      $data['user_mobile'] = I('post.mobile');
      $data['user_code'] = I('post.code');
      $this->checkData($data);
      return $data;
    }




     private function checkData($data){
     if(($data['user_number']==null||$data['user_number']=='')||($data['user_number']==null||$data['user_number']=='')||($data['user_mobile']==null||$data['user_mobile']=='')){
         $this->errorReturn('学号，姓名，手机号不能为空');
     }
    }
    




     private function checkUserCode($mobile,$Code){
      $data = M('User')->where(array('user_mobile'=>$mobile))->find();
      if(count($data) != 0 && $user != null){
        $this->errorReturn('不可预料的错误发生了');
      }else {
        return $data['user_code'] == $Code;
      }
    }



     /*
    * 用户登录
    */
    public function loginSuccess($mobile){
      cookie('user_mobile',null);
      cookie('user_mobile',$mobile);
      $this->successReturn('验证成功');
    }
}
?>