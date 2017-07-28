<?php
namespace Home\Controller;
use Think\Controller;
class PersonalController extends Controller{
	private $lostmodel;
	public function __construct(){
		parent::__construct();
		$this->lostmodel=D('Lost');
	}
	/**
	 * 个人失物总界面
	 * @return [type] [description]
	 */
	public function index(){
		if($this->checkCookie()){
       	$p = I('p')?I('p'):1;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $list = $this->lostmodel->where(array('lost_mobile'=>cookie('user_mobile')))->order('lost_id desc')->page($p.',5')->select();
        $this->assign('list',$list);// 赋值数据集
        $count      = $this->lostmodel->where(array('lost_mobile'=>cookie('user_mobile')))->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
       // var_dump($show);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);
        $this->display();
		}else{
			$this->redirect("Home/index/login");
		}
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
	 * 根据手机号来查询个人失物信息（报失列表）
	 * @return [type] [description]
	 */
	public function lostlist(){
		if($this->checkCookie()){
       	$p = I('p')?I('p'):1;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $list = $this->lostmodel->where(array('lost_mobile'=>cookie('user_mobile')))->order('lost_id desc')->page($p.',5')->select();
        $this->assign('list',$list);// 赋值数据集
        $count      = $this->lostmodel->where(array('lost_mobile'=>cookie('user_mobile')))->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
       // var_dump($show);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);
        $this->display(); 
		}else{
			$this->redirect("Home/index/login");
		}
	}





	/**
	 * 个人失物详情
	 * @return [type] [description]
	 */
	public function lostdetail(){
		if($this->checkCookie()){
		$row=$this->lostmodel->find(I('get.lost_id'));
		$this->assign('row',$row);
		$this->display();
		}else{
			$this->redirect("Home/index/login");
		}
	}
	public function lostdetailAjax(){
	   if($this->checkCookie()){
       $data['lost_desc']=I('post.desc');
       $data['lost_number']=I('post.number');
       $this->checkData($data);
       $result=M('Lost')->where(array('lost_id'=>I('post.id')))->setField(array('lost_desc'=>$data['lost_desc']));
       if($result!==false){
       	$this->successReturn('修改备注成功');
		$this->redirect("Home/Personal/index");
       }else{
       	$this->errorReturn('修改失败');
       }
	   }else{
		  $this->redirect("Home/index/login");
	   }
	}






	/**
	 * 个人新建报失
	 * @return [type] [description]
	 */
	public function lostadd(){
		if($this->checkCookie()){
		$this->display();
		}else{
			$this->redirect("Home/index/login");
		}
	}
	 
	public function lostaddAjax(){
		if($this->checkCookie()){
		$data = $this->getlostaddData();
		$result=M('Lost')->add($data);
		if($result!==false){
			$this->successReturn('报失提交成功');
			$this->redirect("Home/Personal/index");
		}else{
			$this->errorReturn('报失提交失败');
		}
		}else{
			$this->redirect("Home/index/login");
		}
	}
    public function getlostaddData(){
    	$data['lost_type'] = I('post.type');
    	$data['lost_name'] = I('post.name');
    	$data['lost_number'] = I('post.number');
    	$data['lost_desc'] = I('post.desc');
    	$data['lost_mobile'] = cookie('user_mobile');
		$data['time'] = time();
    	$this->checkData($data);
    	return $data;
    }




	/**
	 * 个人捡到失物
	 * @return [type] [description]
	 */
	public function findadd(){
		if($this->checkCookie()){
		$this->display();
		}else{
			$this->redirect("Home/index/login");
		}
	}
	public function findaddAjax(){
		if($this->checkCookie()){
		$data = $this->getFindAddAjaxData();
		$result = M('Find')->add($data);
		if($result!==false){
			//进行查询
			$this->checkLostFind();
			$this->successReturn('提交成功');
			$this->redirect("Home/User/index");
		}else{
			$this->errorReturn('提交失败');
		}
		}else{
			$this->redirect("Home/index/login");
		}
	}
	public function getFindAddAjaxData(){
		$data['lost_number'] = I('post.lnumber');
		$data['lost_name'] = I('post.lname');
		$data['lost_type'] = I('post.ltype');
       	$data['lost_desc'] = I('post.ldesc');
       	$data['find_number'] = I('post.fnumber');
       	$data['find_name'] = I('post.fname');
       	$data['find_desc'] = I('post.fdesc');
       	$data['find_mobile'] = cookie('user_mobile');
       	$this->checkData($data);
		return $data;
	}




	/**
	 * 对已上线的失物（即 lost表中 temp=1) 进行匹配
	 * 对失物进行匹配，如果匹配成功就发送短信
	 * 匹配规则：A.是按照失物人的学号及失物类型进行匹配B.是按照失物人的姓名及失物类型进行匹配
	 * 如果已经匹配了的失物，就把lost表中的mark标记为 1（mark=1 保存到表中）
	 *并且将find 表中的mark标记为 1
	 * @return [type] [description]
	 */
	public function checkLostFind(){
		$lost=M('Lost')->select();
		$find=M('Find')->select();
		foreach($lost as $key=>$value){
			foreach($find as $k=>$v){
				if((($value['lost_number']==$v['lost_number'])&&($value['lost_type']==$v['lost_type']))||(
				($value['lost_name']==$v['lost_name'])&&($value['lost_type']==$v['lost_type']))){

					if(($value['temp']!=0)&&($value['mark']!=1)&&($value['lost_number']!=0)&&($value['lost_name']!=='0')&&($v['mark']!=1)){

				     M('Lost')->where(array('lost_id'=>$value['lost_id']))->setField(array('mark'=>1));
				     M('find')->where(array('find_id'=>$v['find_id']))->
				     setField(array('mark'=>1));
					    $this->sendMsg($value['lost_mobile'],$v['find_mobile']);
					    $this->successReturn('查询有这个');
					}
				}
			}
		}
	}



     /*
    * 发送给失物人信息
    */
    private function sendMsg($lostphone,$findphone){
        $remote_server = "http://www.cybergear-cn.com/ACM/official/sendMsg.php?lostphone=".$lostphone."&findphone=".$findphone;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remote_server);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "jb51.net's CURL Example beta");
        $data = curl_exec($ch);
        curl_close($ch);
        $result = M('User')->where(array('user_mobile'=>$lostphone))->setField('time',time());
        if($result!==false){
          $this->successReturn('发送信息成功');
        }else {
          $this->errorReturn('数据更新失败');
        } 
        return $data;
    }
    /**
     * 验证cookie
     */
    public function checkCookie(){
    $result=M('User')->where(array('user_mobile'=>cookie('user_mobile')))->find();
    $s1=$result['user_mobile'];
    $s2=$result['user_salt'];
    $str1=$s1.$s2;
    $str2=cookie('user_mobile').cookie('key');
    if((!empty(cookie('user_mobile')))&&(!empty(cookie('key')))){
     if(md5($str1)===md5($str2)){
       return true;
    }else{
    	return false;
     }
    }
    return false;
    }
}
?>