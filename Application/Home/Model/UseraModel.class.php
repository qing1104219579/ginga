<?php
namespace Home\Model;

use Think\Model;
class UseraModel extends Model{

    public function userMessge($username){
        $sql="select * from usera where username=?";
        $user=$this->util->executeDQL($sql,array($username));
        if (count($user)>0){
            return $user[0];
        }else {
            return null;
        }
    }
}
?>