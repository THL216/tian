<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Publicnum;
use yii\web\DbSession;

class MenuController extends Controller{
    public $enableCsrfValidation = false;

    public $layout = 'main';

    /*
   * 非法登录控制
   */
    public function init()
    {
        //安装界面如果安装好之后生成一个php文件 文件如果存在则跳到登录界�?
        if(!is_file("assets/existence.php")){
            $this->redirect(array('/install/index'));
        }
        $session = Yii::$app->session;
        $uid = $session->get('uid', '');
        if ($uid == '') {
            $this->redirect('index.php?r=login/index');
        }
    }


    /*
     * 展示自定义菜单表�?
     */
    public function actionCustom(){
      $db = \Yii::$app->db;
        $re = $db->createCommand('select id,appname from '.$db->tablePrefix.'publicnum ')->queryAll();
      	 
       return $this->render('custom',['arr'=>$re]);
    }
    /*
    提交
     */
    public function actionToken(){
        header('content-type:text/html;charset=utf-8');
        $db = \Yii::$app->db;
        $arr=Yii::$app->request->post();
        // var_dump($arr);die;
        $id=$arr['di'];
        // $id=Yii::$app->session->get('uid','');
        //var_dump($arr['do']);die;
       
        $sql="select * from ".$db->tablePrefix."publicnum where id='$id' ";
        $connection=\Yii::$app->db->createCommand($sql);
        $data=$connection->queryAll();
         // print_r($data);die;
        $appid=$data[0]['appid'];
        $appsecret=$data[0]['appsecret'];
       //  $memcache = \Yii::$app->cache;
       // // $memcache->flush();die;
       //  $zhi=$memcache->get("zhi");
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $jsoninfo = json_decode($output, true);
        $access_token = $jsoninfo["access_token"];
        //echo $access_token;die;
            // $memcache->set("zhi",$access_token,7000);
        // $zhi=$memcache->get("zhi");
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
        $method="POST";
        $data=$arr['do'];
        // print_r($arr['do']);die;
        $ch = curl_init();   //1.初始�?
        curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
        //4.参数如下
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览�?
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

        // if($method=="POST"){//5.post方式的时候添加数�?
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行

        if (curl_errno($ch)) {//7.如果出错
            return curl_error($ch);
        }
        // return $tmpInfo;die;
        $ok=json_decode($tmpInfo,true);
        curl_close($ch);//8.关闭
        if($ok['errcode']==0){
           echo "<script>alert('菜单生成成功');location.href='index.php?r=menu/custom'</script>"; 
        }else{
            echo "<script>alert('菜单生成失败');location.href='index.php?r=menu/custom'</script>";
        }
        // $this->redirect(array(""));
    }
}