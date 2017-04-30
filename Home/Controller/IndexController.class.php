<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	private $usermodel;
	public function __construct(){
		parent::__construct();
		$this->usermodel=D('User');
	}
  public function login(){
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
     * 开始检验验证码
     * @return [type] [description]
     */
     public function checkCodeAjax(){
      $data = $this->getCheckCodeData();
      $this->isPhoneExist($data['user_mobile']);
      if($this->checkUserCode($data['user_mobile'],$data['user_code'])){
        $this->loginSuccess($data['user_mobile']);
      }else {
        $this->errorReturn('验证码错误');
      }
    }
      private function getCheckCodeData(){
      $data['user_mobile'] = I('post.mobile');
      $data['user_code'] = I('post.code');
      $this->CheckData($data);
      return $data;
    }
      /*
    * 检查用户是否存在
    */
    private function isPhoneExist($mobile){
      $user = M('User')->where(array('user_mobile'=>$mobile))->find();
      if(count($user) != 0 && $user != null){
            return true;
      }
      $this->errorReturn('不可预料的错误发生了');
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
      cookie('user_mobile',$mobile);
      $this->successReturn('验证成功');
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
       * 
       * @param  [type] $mobile [description]
       * @return [type]         [description]
       */
      private function setData($mobile){
        $info=M('User')->where(array('user_mobile'=>$mobile))->find();
        if(count($info)==0 || $info==null){
            $this->addNewUser($mobile);
        }else{
            $this->updateUser($mobile);
        }
      }


      
     /**
      * 添加新用户
      * @param [type] $mobile [description]
      */
      private function addNewUser($mobile){
      $data['user_mobile'] = $mobile;
      $data['user_code'] = rand(1001,9999);
      $result = M('User')->add($data);
      if($result!=false){
        //发送验证码
        //$this->sendCode($data['user_mobile'],$data['user_code']);
        $this->successReturn('验证码已成功');
      }else {
        $this->errorReturn('新增用户数据失败');
      }
    }



    /**
      * 添加新用户
      * @param [type] $mobile [description]
      */
      private function updateUser($mobile){
      $data['user_mobile'] = $mobile;
      $data['user_code'] = rand(1001,9999);
      $result = M('User')->where(array('user_mobile'=>$mobile))->save($data);
      if($result!=false){
        //发送验证码
        //$this->sendCode($data['user_mobile'],$data['user_code']);
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

}
?>