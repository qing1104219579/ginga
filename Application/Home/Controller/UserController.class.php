<?php
namespace Home\Controller;
    
use Think\Controller;
    
class UserController extends Controller{
    private $usertModel;
    public function  __construct(){
        parent::__construct();
        $this->usertModel = M("usera");//new Model("usera");  参数是表名称
        //D("Usera")    new UseraModel();
    }
    
    /**
     * 登录处理
     */
    public function login(){
        $username= $_POST["username"];//获取表单数据
        $userpass= $_POST["userpass"];//获取表单数据
        $users = $this->usertModel->where("username='%s'",$username)->select();
        if (count($users) <= 0){//未查到数据表示用户名不存在
            $_SESSION["mm"]="账号输入错误";
            header("location:http://localhost:8080/tp/Application/Home/View/login.php");
        }else {
            $user = $users[0];
            if ( $userpass == $user["userpass"] ){
                $_SESSION["loginUser"] = $user;
                
//                     select m.* from userpart u,manageoart jm,manage m
//                     where u.pid=jm.pid and jm.mid=m.mid and u.uid=?
                 
                 $menus=$this->usertModel->field('m.*')->table("userpart u,manageoart jm,manage m")
                 ->where("u.pid=jm.pid and jm.mid=m.mid and u.uid='%d'",$user["uid"])->select();
                 $_SESSION["menus"] = $menus;
//                 $_SESSION["name"] = $user;
// print_r($menus);
                 $this->display("welcome");
//                 header("location:http://localhost:8080/tp/Application/Home/View/easyuiTest.php");
            }else{
                $_SESSION["mm"]="密码输入错误";
                header("location:http://localhost:8080/tp/Application/Home/View/login.php");
            }
        }
    }
    
    /**
     * 异步请求 查询部门列表
     * @param unknown $pageNo
     * @param unknown $pageSize
     */
    public function branch($pageNo,$pageSize){
        
       $menus =$this->usertModel->field('*')->table("branch")->select();
       $total = $this->usertModel->table("branch")->count();//查询总数 查询表
       $data  = array('rows'=>$menus,'total'=>$total,'pageNo'=>$pageNo,'pageSize'=>$pageSize);//分页
//        $text  = $this->usertModel->field(true)->select();
 
       $this->ajaxReturn($data);
    }

    public function textView(){
        $array = array("中国","美国","英国");
        $this->assign("bbb","中国");
        $this->assign("ccc",$array);
        $this->assign("ddd","解放碑");
        $this->assign("aaa",$array);
        $data['aa']='Think';$data['bb']='Thinkaa';
        $this->assign("ee",time());//当前时间
        $this->assign("ff",array("中国","美国","英国"));
        $this->display();
    }
    
    /**
     * 同步请求查询部门列表 并分页
     */
 public function nameList($pageNo,$pageSize){
        
       $menus =$this->usertModel->field('*')->table("branch")->page($pageNo,$pageSize)->select();
       $total = $this->usertModel->table("branch")->count();//查询总数 查询表
       $dataq  = array('rows'=>$menus,'total'=>$total,'pageNo'=>$pageNo,'pageSize'=>$pageSize);//分页
//        $text  = $this->usertModel->field(true)->select();
//  print_r($data);
       $this->assign("dataq",$dataq);
       $this->display('nameList');
    }
    /**
     * 同步请求 添加或修改部门
     */
    public function updatebranch($bid){
        $data = $this->usertModel->find($bid);
        $this->ajaxReturn($data);;
    }
    
    
}

?>