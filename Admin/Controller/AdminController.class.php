<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller{
	public function index(){
	if($this->checkCookie()){
		$this->display();
	  }else{
	  	$this->redirect('Admin/Login/index');
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
     *待审核失物部分
     * @return [type] [description]
     */
	public function pendingOrder(){
	   if($this->checkCookie()){
       	$p = I('p')?I('p'):1;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $list = M('Lost')->where(array('temp'=>0))->order('time desc')->page($p.',12')->select();
        $this->assign('list',$list);// 赋值数据集
        $count      = M('Lost')->where(array('temp'=>0))->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,12);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); 
        }else{
        $this->redirect('Admin/Login/index');
	    }
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
			$this->checkLostFind();//进行查询操作
			$this->successReturn('通过成功');
		}else{
			$this->errorReturn('通过失败');
		}

	}
	/**
	*一键通过全部
	*/
	public function pendingOrderAllEditAjax(){
		$result=M('Lost')->where(array('temp'=>0))->setField(array('temp'=>1));
		if($result!==false){
			//$this->checkLostFind();//进行查询操作
			$this->successReturn('全部通过成功');
		}else{
			$this->errorReturn('全部通过失败');
		}
	}
     public function pendingOrderAllDelAjax(){
		$result=M('Lost')->where(array('temp'=>0))->delete();
		if($result!==false){
			$this->successReturn('全部关闭成功');
		}else{
			$this->errorReturn('全部关闭失败');
		}
    }

	
	/**
	 * 对已上线的失物（即 lost表中 temp=1) 进行匹配
	 * 对失物进行匹配，如果匹配成功就发送短信
	 * 匹配规则：是按照失物人的学号及失物类型进行匹配
	 * 如果已经匹配了的失物，就把lost表中的mark标记为 1（mark=1 保存到表中）
	 *并且将find 表中的mark标记为 1
	 * @return [type] [description]
	 */
	public function checkLostFind(){
		$lost=M('Lost')->select();
		$find=M('Find')->select();
		foreach($lost as $key=>$value){
			foreach($find as $k=>$v){
				if(($value['lost_number']==$v['lost_number'])&&($value['lost_type']==$v['lost_type'])){

					if(($value['temp']!=0)&&($value['mark']!=1)&&($value['lost_number']!=0)&&($value['lost_name']!=='0')&&($v['mark']!=1)){

				M('Lost')->where(array('lost_id'=>$value['lost_id']))->setField(array('mark'=>1));
        M('find')->where(array('find_id'=>$v['find_id']))->setField(array('mark'=>1));
					    $this->sendMsg($value['lost_mobile'],$v['find_mobile']);
					    //失由于发信息给物人部分未能实现所以暂且不调用
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
        $remote_server = "http://zgz.s1.natapp.cc/lostfoundmsg/sendMsg.php?lostphone=".$lostphone."&findphone=".$findphone;
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
     * 已上线失物部分
     * @return [type] [description]
     */
	public function onlineOrder(){
		if($this->checkCookie()){
	   	$p = I('p')?I('p'):1;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $list = M('Lost')->where(array('temp'=>1))->order('time desc')->page($p.',12')->select();
        $this->assign('list',$list);// 赋值数据集
        $count      = M('Lost')->where(array('temp'=>1))->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,12);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
         }else{
        $this->redirect('Admin/Login/index');
	    } 
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
		 if($this->checkCookie()){
	 	    $p = I('p')?I('p'):1;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $list = M('Lost')->order('time desc')->page($p.',12')->select();
        $this->assign('list',$list);// 赋值数据集
        $count      = M('Lost')->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,12);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); 
        }else{
        $this->redirect('Admin/Login/index');
	    } 
    }
    public function allOrderDetail(){
	    $row=M('Lost')->where(array('lost_id'=>I('get.lost_id')))->find();
		  $this->assign('row',$row);
		  $this->display();
    }


    /**
     * 检验cookie
     */
    public function checkCookie(){
       $admin=M('Admin')->where(array('username'=>cookie('username')))->find();
       if(!empty(cookie('key'))&&!empty(cookie('username'))){
       if(cookie('key')===$admin['cookie']){
       	return true;
       }else{
       	return false;
       }
      }else{
        return false;
      }
    }
}
?>