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
	 * ¸öÈËÊ§Îï×Ü½çÃæ
	 * @return [type] [description]
	 */
	public function index(){
	if($this->checkCookie()){
       	$p = I('p')?I('p'):1;
        // ½øÐÐ·ÖÒ³Êý¾Ý²éÑ¯ ×¢Òâpage·½·¨µÄ²ÎÊýµÄÇ°Ãæ²¿·ÖÊÇµ±Ç°µÄÒ³ÊýÊ¹ÓÃ $_GET[p]»ñÈ¡
        $list = $this->lostmodel->where(array('lost_mobile'=>cookie('user_mobile')))->order('lost_id desc')->page($p.',10')->select();
        $this->assign('list',$list);// ¸³ÖµÊý¾Ý¼¯
        $count      = $this->lostmodel->where(array('lost_mobile'=>cookie('user_mobile')))->count();// ²éÑ¯Âú×ãÒªÇóµÄ×Ü¼ÇÂ¼Êý
        $Page       = new \Think\Page($count,10);// ÊµÀý»¯·ÖÒ³Àà ´«Èë×Ü¼ÇÂ¼ÊýºÍÃ¿Ò³ÏÔÊ¾µÄ¼ÇÂ¼Êý
        $show       = $Page->show();// ·ÖÒ³ÏÔÊ¾Êä³ö
       // var_dump($show);
        $this->assign('page',$show);// ¸³Öµ·ÖÒ³Êä³ö
        $this->assign('count',$count);
        $this->display();
		}else{
			$this->redirect("Home/index/login");
		}
	}

       /**
        * 成功时返回
        * @param  [type] $msg [description]
        * @return [type]      [description]
        */
       private function successReturn($msg){
         $res['success'] = true;
         $res['msg'] = $msg;
         $this->ajaxReturn($res);
        }

       /**
        *´íÎóÊ±·µ»Ø
        */
         private function errorReturn($errmsg){
           $res['success'] = false;
           $res['errmsg'] = $errmsg;
           $this->ajaxReturn($res);
         }
		     /**
		     * ÓÃÓÚ¼ìÑéÊý¾ÝÊÇ·ñÍêÕû
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
	 * ¸ù¾ÝÊÖ»úºÅÀ´²éÑ¯¸öÈËÊ§ÎïÐÅÏ¢£¨±¨Ê§ÁÐ±í£©
	 * @return [type] [description]
	 */
	public function lostlist(){
		if($this->checkCookie()){
       	$p = I('p')?I('p'):1;
        // ½øÐÐ·ÖÒ³Êý¾Ý²éÑ¯ ×¢Òâpage·½·¨µÄ²ÎÊýµÄÇ°Ãæ²¿·ÖÊÇµ±Ç°µÄÒ³ÊýÊ¹ÓÃ $_GET[p]»ñÈ¡
        $list = $this->lostmodel->where(array('lost_mobile'=>cookie('user_mobile')))->order('lost_id desc')->page($p.',5')->select();
        $this->assign('list',$list);// ¸³ÖµÊý¾Ý¼¯
        $count      = $this->lostmodel->where(array('lost_mobile'=>cookie('user_mobile')))->count();// ²éÑ¯Âú×ãÒªÇóµÄ×Ü¼ÇÂ¼Êý
        $Page       = new \Think\Page($count,5);// ÊµÀý»¯·ÖÒ³Àà ´«Èë×Ü¼ÇÂ¼ÊýºÍÃ¿Ò³ÏÔÊ¾µÄ¼ÇÂ¼Êý
        $show       = $Page->show();// ·ÖÒ³ÏÔÊ¾Êä³ö
       // var_dump($show);
        $this->assign('page',$show);// ¸³Öµ·ÖÒ³Êä³ö
        $this->assign('count',$count);
        $this->display(); 
		}else{
			$this->redirect("Home/index/login");
		}
	}





	/**
	 * ¸öÈËÊ§ÎïÏêÇé
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
	 * ¸öÈËÐÂ½¨±¨Ê§
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


	    $upload = new \Think\Upload();// ÊµÀý»¯ÉÏ´«Àà
            $upload->maxSize   =     104857600;// ÉèÖÃ¸½¼þÉÏ´«´óÐ¡
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// ÉèÖÃ¸½¼þÉÏ´«ÀàÐÍ
            $upload->rootPath  =     './Public/Upload/'; // ÉèÖÃ¸½¼þÉÏ´«¸ùÄ¿Â¼
            $upload->savePath  =     ''; // ÉèÖÃ¸½¼þÉÏ´«£¨×Ó£©Ä¿Â¼
            // ÉÏ´«ÎÄ¼þ
            $info   =   $upload->upload();
            //var_dump($info);
            if(!$info) {
                $this->error($upload->getError());
            }else{// ÉÏ´«³É¹¦
               $img_path1 = './Public/Upload/'.$info['img']['savepath'];
                $name= $info['img']['savename'];

                $image = new \Think\Image();
                $image->open($img_path1.$name);
                // °´ÕÕÔ­Í¼µÄ±ÈÀýÉú³ÉÒ»¸ö×î´óÎª100*100µÄËõÂÔÍ¼²¢±£´æÎªthumb.jpg
                $img_xiao = './Public/Upload/thumb/'.$name;
                $image->thumb(100, 100)->save($img_xiao);
                $this->lostmodel->thumb_img = str_replace('./Public/','',$img_xiao);
                $this->lostmodel->img = str_replace('./Public/','',$img_path1.$name);
				$this->lostmodel->add();

			$admin = M('admin')->select();
            foreach ($admin as $key => $value) {
            $this->sendNotice($admin[$key]['mobile']);//¸øËùÓÐµÄ¹ÜÀíÔ±·¢ËÍÍ¨Öª£»
            }
			$this->success('报失提交成功');
			$this->redirect("Home/Personal/index");
		  }
		}else{
			$this->error("账号已过期");
			$this->redirect("Home/index/login");
		}
	}

    public function getlostaddData(){
    	$this->lostmodel->lost_type = I('post.type');
    	$this->lostmodel->lost_name = I('post.name');
    	$this->lostmodel->lost_number = I('post.number');
    	$this->lostmodel->lost_desc = I('post.desc');
    	$this->lostmodel->lost_mobile = cookie('user_mobile');
		$this->lostmodel->time = time();
    }




	/**
	 * ¸öÈË¼ñµ½Ê§Îï
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
		$data = $this->getFindAddAjaxData();//»ñÈ¡Ìá½»µÄÊý¾Ý
		$result = M('Find')->add($data);
		if($result!==false){
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
	 * ¶ÔÒÑÉÏÏßµÄÊ§Îï£¨¼´ lost±íÖÐ temp=1) ½øÐÐÆ¥Åä
	 * ¶ÔÊ§Îï½øÐÐÆ¥Åä£¬Èç¹ûÆ¥Åä³É¹¦¾Í·¢ËÍ¶ÌÐÅ
	 * Æ¥Åä¹æÔò£ºA.ÊÇ°´ÕÕÊ§ÎïÈËµÄÑ§ºÅ¼°Ê§ÎïÀàÐÍ½øÐÐÆ¥ÅäB.ÊÇ°´ÕÕÊ§ÎïÈËµÄÐÕÃû¼°Ê§ÎïÀàÐÍ½øÐÐÆ¥Åä
	 * Èç¹ûÒÑ¾­Æ¥ÅäÁËµÄÊ§Îï£¬¾Í°Ñlost±íÖÐµÄmark±ê¼ÇÎª 1£¨mark=1 ±£´æµ½±íÖÐ£©
	 *²¢ÇÒ½«find ±íÖÐµÄmark±ê¼ÇÎª 1
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
    * ·¢ËÍ¸øÊ§ÎïÈËÐÅÏ¢
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


     /*
    * ·¢ËÍ¸øºóÌ¨¹ÜÀíÔ±µÄÌáÊ¾ÐÅÏ¢
    */
    private function sendNotice($mobile){
        $remote_server = "http://zgz.s1.natapp.cc/lostfoundmsg/sendNotice.php?mobile=".$mobile;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remote_server);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "jb51.net's CURL Example beta");
        $data = curl_exec($ch);
        curl_close($ch);
       // $this->successReturn('³É¹¦');
    }
    /**
     * ÑéÖ¤cookie
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