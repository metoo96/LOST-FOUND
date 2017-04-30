<?php 
namespace Home\Controller;
use Think\Controller;
class AllLostController extends Controller{
	private $lostmodel;
	public function __construct(){
       parent::__construct();
       $this->lostmodel=D('Lost');
	}
	/**
	 * 列出所有失物信息
	 * @return [type] [description]
	 */
	public function lostlist(){
		$p = I('p')?I('p'):1;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $list = $this->lostmodel->order('lost_id desc')->page($p.',5')->select();
        $this->assign('list',$list);// 赋值数据集
        $count      = $this->lostmodel->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
       // var_dump($show);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);
        $this->display(); // 输出模版
	}
	public function lostdetail(){
		$row=$this->lostmodel->find(I('get.lost_id'));
		$this->assign('row',$row);
		$this->display();
	}
}
?>