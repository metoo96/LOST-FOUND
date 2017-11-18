<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	private $usermodel;
	public function __construct(){
		parent::__construct();
		$this->usermodel=D('User');
	}
  /**
   * 登录处理(及自动登录的实现)
   * @return [type] [description]
   */
  public function login(){
    $result=M('User')->where(array('user_mobile'=>cookie('user_mobile')))->find();
    $s1=$result['user_mobile'];
    $s2=$result['user_salt'];
    $str1=$s1.$s2;
    $str2=cookie('user_mobile').cookie('key');
    if((!empty(cookie('user_mobile')))&&(!empty(cookie('key')))){
     if(md5($str1)===md5($str2)){
       $this->redirect('Home/User/index');//第二次登录时进行的cookie登录
    }else{
       $this->display();//第一次登录
   }
     }else{
      $this->display();//第一次登录
     }
  }

  /**
   *正确时返回
   * @param  [type] $msg [description]
   * @return [type]      [description]
   */
   public function successReturn($msg){
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
      $this->errorReturn('手机号错误');
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
      $data=M('User')->where(array('user_mobile'=>$mobile))->find();
      $key=$data['user_salt'];
      cookie('key',$key,3600*24*30);//设置cookie保留在客户端一个月时间
      cookie('user_mobile',$mobile,3600*24*30);//设置cookie的生命周期为
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
      $data['user_salt'] =$this->randStr(8);
      $result = M('User')->add($data);
      if($result!=false){
        //发送验证码
        $this->sendCode($data['user_mobile'],$data['user_code']);
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
      $data['user_salt'] =$this->randStr(8);
      $result = M('User')->where(array('user_mobile'=>$mobile))->save($data);
      if($result!=false){
        //发送验证码
        $this->sendCode($data['user_mobile'],$data['user_code']);
        $this->successReturn("验证码已成功");
      }else {
        $this->errorReturn('新增用户数据失败');
      }
    }

  


     /*
    * 发送验证码
    */
    private function sendCode($phone,$code){
        $remote_server = "http://zgz.s1.natapp.cc/lostfoundmsg/sendCode.php?mobile=".$phone."&code=".$code;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remote_server);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "jb51.net's CURL Example beta");
        $data = curl_exec($ch);
        curl_close($ch);
        $result = M('User')->where(array('user_mobile'=>$phone))->setField('time',time());//修改登录时间
        if($result!==false){
          $this->successReturn('发送成功');
        }else {
          $this->errorReturn('数据更新失败');
        } 
        return $data;
    }
	
	/**
	*关于我们
	*/
    public function We(){
		$this->display();
	}
  /**
   * 随机产生一个字符串
   */
  public function randStr($length){
    $str="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    return substr(str_shuffle($str),0,$length);
  }
}
?>