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
	 * 根据手机号来查询个人失物信息（报失列表）
	 * @return [type] [description]
	 */
	public function lostlist(){
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
	}





	/**
	 * 个人失物详情
	 * @return [type] [description]
	 */
	public function lostdetail(){
		$row=$this->lostmodel->find(I('get.lost_id'));
		$this->assign('row',$row);
		$this->display();
	}
	public function lostdetailAjax(){
       $data['lost_desc']=I('post.desc');
       $data['lost_number']=I('post.number');
       $this->checkData($data);
       $result=M('Lost')->where(array('lost_id'=>I('post.id')))->setField(array('lost_desc'=>$data['lost_desc']));
       if($result!==false){
       	$this->successReturn('修改备注成功');
       }else{
       	$this->errorReturn('修改失败');
       }

	}





	/**
	 * 个人新建报失
	 * @return [type] [description]
	 */
	public function lostadd(){
		$this->display();
	}
	 
	public function lostaddAjax(){
		$data = $this->getlostaddData();
		$result=M('Lost')->add($data);
		if($result!==false){
			$this->successReturn('报失提交成功');
		}else{
			$this->errorReturn('报失提交失败');
		}

	}
    public function getlostaddData(){
    	$data['lost_type'] = I('post.type');
    	$data['lost_name'] = I('post.name');
    	$data['lost_number'] = I('post.number');
    	$data['lost_desc'] = I('post.desc');
    	$data['lost_mobile'] = cookie('user_mobile');
    	$this->checkData($data);
    	return $data;
    }




	/**
	 * 个人捡到失物
	 * @return [type] [description]
	 */
	public function findadd(){
		$this->display();
	}
	public function findaddAjax(){
		$data = $this->getFindAddAjaxData();
		$result = M('Find')->add($data);
		if($result!==false){
			//进行查询
			$this->checkLostFind();
			$this->successReturn('提交成功');
		}else{
			$this->errorReturn('提交失败');
		}
	}
	public function getFindAddAjaxData(){
		$data['lost_number'] = I('post.lnumber');
		$data['lost_name'] = I('post.lname');
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
	 * 匹配规则：是按照失物人的学号进行匹配
	 * 如果已经匹配了的失物，就把lost表中的mark标记为 1（mark=1 保存到表中）
	 *
	 * @return [type] [description]
	 */
	public function checkLostFind(){
		$lost=M('Lost')->select();
		$find=M('Find')->select();
		foreach($lost as $key=>$value){
			foreach($find as $k=>$v){
				if($value['lost_number']==$v['lost_number']){
					if(($value['temp']!=0)&&($value['mark']!=1)){
				M('Lost')->where(array('lost_id'=>$value['lost_id']))->setField(array('mark'=>1));
					    //$this->sendCode();
					    //由于发信息给失物人部分未能实现所以暂且不调用
					    $this->successReturn('查询有这个');
					}
				}
			}
		}
	}



     /*
    * 发送给失物人信息
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