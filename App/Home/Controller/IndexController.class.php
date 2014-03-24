<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
		$M = M('baby');
		$top = $M->limit(0,3)->order('praise desc')->select();	
		foreach($top as $key=>$val){
			$top[$key]['rank'] = ($M->where('praise>%d',$val['praise'] )->count()+1);//计算排名
		}
		
		$data = $M->limit(0,4)->where('id <> %d AND id <> %d AND id <> %d',array($top[0]['id'],$top[1]['id'],$top[2]['id']))->order('data desc')->select();	
		foreach($data as $key=>$val){
			$data[$key]['rank'] = ($M->where('praise>%d',$val['praise'] )->count()+1);//计算排名
		}
		$this->assign('top',$top);
		$this->assign('data',$data);		
		$this->display();
	}
	
	public function publish(){
		$M = M('baby');
		$count = $M->order('id desc')->find();
		$this->assign('count',$count[id]+1);
		$this->display();
	}
	
	public function ajaxSearch(){
		$keywords = $_POST['keywords'];
		
		$str = trim($keywords); //截取字符串中的数字
		$temp=array('1','2','3','4','5','6','7','8','9','0');
		$result='';
		for($i=0;$i<strlen($str);$i++){
        if(in_array($str[$i],$temp)){
            $result.=$str[$i];
			}
		}

		$M = M('baby');
		$data = $M->where('id=%d',$result)->find();
		$rank = $M->where('praise>%d',$data['praise'] )->count();
		//echo $M->getLastSql();
		if($data){
			$content = "<li class=\"green bounceInDown\">						
					<dl>
						<div id=\"praise\"><p class=\"noPraise\">".$data['praise']."</p><p class=\"rank\">".($rank+1)."</p></div>
							<a href=\"__CONTROLLER__/show/id/".$data['id']."\"><img src=\"".$data['pic1']."\" /></a>
						<div class=\"caption\">
						   <h3>参赛宣言：".$data['content']."</h3>
						</div>
					</dl>
				</li>";
		}
		echo $content;
	}
	
	public function AddPublish(){
		$name = $_POST['name'];
		$tel = $_POST['tel'];
		$content = $_POST['content'];
		$pic = $_POST['pic'];
		foreach($pic as $key=>$val){//遍历得到的图片数据
			$data['pic'.$key] = $val;
		}
		$data['name'] = $name;
		$data['tel'] = $tel;
		$data['content'] = $content;
		$data['data'] = time();
		$M = M('baby');
		$M->add($data);
		var_dump($data);
	}
	
	public function ajaxShow(){//ajax滚动数据
		$page = $_GET['page'];
		$M = M('baby');
		$top = $M->limit(0,3)->order('praise desc')->select();	
		$data = $M->where('id <> %d AND id <> %d AND id <> %d',array($top[0]['id'],$top[1]['id'],$top[2]['id']))->order('data desc')->limit(($page-1)*4,4)->select();	
		foreach($data as $key=>$val){
			$data[$key]['rank'] = ($M->where('praise>%d',$val['praise'] )->count()+1);//计算排名
		}
		$contents="";
		foreach($data as $key){
			$contents .="<li class=\"green bounceInDown\">						
					<dl>
						<div id=\"praise\">
						<table>
						<tr>
							<td><div style=\"width:5px;float:left;\">排名</div></td>
							<td>".$key['rank']."</td>
						</tr>
						<tr>
							<td>赞</td>
							<td>".$key['praise']."</td>
						</tr>
						</table>
						</div>
							<a href=\"__CONTROLLER__/show/id/".$key['id']."\"><img src=\"".$key['pic1']."\" /></a>
						<div class=\"caption\">
						   <h3>参赛宣言：".$key['content']."</h3>
						</div>
					</dl>
				</li>";
		}
		echo $contents;
	}
	
	public function ajaxUpload(){		
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath  =      '/baby/'.$_SESSION['class']."/"; // 设置附件上传目录
		// 上传文件 
		$info   =   $upload->uploadOne($_FILES['uploadFile']);//upload();
		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());
		}else{// 上传成功
			echo json_encode($info);
		}
		//var_dump($_FILES['photo']);
	}
	
	public function ajaxPraise(){
		$openid = $_POST['openid'];
		$id = $_POST['id'];
		$praise = M('praise');
		if(empty($openid)){
			$openid=0;
		}
		$isPraise = $praise->where("bid=%d AND openid='%s'",array($id,$openid))->order('data desc')->find();
		//var_dump($isPraise);
		if(!$IsPraise){
			if(date("YDM", time()) != date("YDM", $isPraise['data'])){//同一天
				$data['openid'] = $openid;
				$data['bid'] = $id;
				$data['data'] = time();				
				if(!M('pinfo')->where("openid='%s'",$openid)->find()){//判断是否记录信息
					echo 1;
				}else{
					$praise->add($data);
					M('baby')->where('id=%d',$id)->setInc('praise',1);
					echo 2;
				}
			}else{
				echo 3;
			}
		}
	}
	
	public function ajaxAddUser(){
		$openid = $_POST['openid'];
		$id = $_POST['id'];
		$tel = $_POST['tel'];
		$U = M('pinfo');
		$data['openid'] = $openid;
		$data['tel'] = $tel;
		$U->add($data);
		$data1['openid'] = $openid;
		$data1['bid'] = $id;
		$data1['data'] = time();	
		M('praise')->add($data1);
		M('baby')->where('id=%d',$id)->setInc('praise',1);
	}
	public function show(){//获取openid
		$code = $_POST['code'];
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxe60a7669dfb88b33&secret=d6974889e28435c692522c3e7bb356e8&code=".$code."&grant_type=authorization_code";
		$atjson=file_get_contents($url);
		$result=json_decode($atjson,true);
		if($_GET['id']){
			$id = $_GET['id'];
		}else{
			$id = $_GET['state'];
		}		
		$M = M('baby');		
		$data = $M->where(array('id'=>$id))->find();
		$data['rank'] = ($M->where('praise>%d',$data['praise'] )->count()+1);
		$this->assign('data',$data);
		$this->assign('openid',$result['openid']);
		$this->display();
	}
}