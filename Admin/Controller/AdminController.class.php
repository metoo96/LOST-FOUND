<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller{
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
     *待审核失物部分
     * @return [type] [description]
     */
	public function pendingOrder(){
       $list=M('Lost')->where(array('temp'=>0))->select();
	   $this->assign('list',$list);
       $this->display();
	}
	public function pendingOrderDetail(){
	    $row=M('Lost')->where(array('lost_id'=>I('get.lost_id')))->find();
		$this->assign('row',$row);
		$this->display();

	}
	public function pendingOrderDelAjax(){
    	$data['lost_id'] = I('post.id');
		$result=M('Lost')->where(array('lost_id'=>$data['lost_id']))->delete();
		if($result!==false){
			$this->successReturn('关闭成功');
		}else{
			$this->errorReturn('关闭失败');
		}
    }
	public function pendingOrderEditAjax(){
		$data['lost_id'] = I('post.id');
		$result=M('Lost')->where(array('lost_id'=>$data['lost_id']))->setField(array('temp'=>1));
		if($result!==false){
			$this->checkLostFind();
			$this->successReturn('通过成功');
		}else{
			$this->errorReturn('通过失败');
		}

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



    /**
     * 已上线失物部分
     * @return [type] [description]
     */
	public function onlineOrder(){
	   $list=M('Lost')->where(array('temp'=>1))->select();
	   $this->assign('list',$list);
       $this->display();
	}
	public function onlineOrderDetail(){
	    $row=M('Lost')->where(array('lost_id'=>I('get.lost_id')))->find();
		$this->assign('row',$row);
		$this->display();

	}
	public function onlineOrderDelAjax(){
		$data['lost_id'] = I('post.id');
		$result=M('Lost')->where(array('lost_id'=>$data['lost_id']))->delete();
		if($result!==false){
			$this->successReturn('关闭成功');
		}else{
			$this->errorReturn('关闭失败');
		}
	}


   
    /**
     * 全部失物部分
     * @return [type] [description]
     */
	public function allOrder(){
		$list=M('Lost')->select();
		$this->assign('list',$list);
		$this->display();
    }
    public function allOrderDetail(){
	    $row=M('Lost')->where(array('lost_id'=>I('get.lost_id')))->find();
		$this->assign('row',$row);
		$this->display();
    }
}
?>