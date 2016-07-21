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
   * éžæ³•ç™»å½•æŽ§åˆ¶
   */
    public function init()
    {
        //å®‰è£…ç•Œé¢å¦‚æžœå®‰è£…å¥½ä¹‹åŽç”Ÿæˆä¸€ä¸ªphpæ–‡ä»¶ æ–‡ä»¶å¦‚æžœå­˜åœ¨åˆ™è·³åˆ°ç™»å½•ç•Œé?
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
     *  展示自定义菜单表单
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
        $ch = curl_init();   //1.åˆå§‹åŒ?
        curl_setopt($ch, CURLOPT_URL, $url); //2.è¯·æ±‚åœ°å€
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.è¯·æ±‚æ–¹å¼
        //4.å‚æ•°å¦‚ä¸‹
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//æ¨¡æ‹Ÿæµè§ˆå™?
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzipè§£åŽ‹å†…å®¹
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

        // if($method=="POST"){//5.postæ–¹å¼çš„æ—¶å€™æ·»åŠ æ•°æ?
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.æ‰§è¡Œ

        if (curl_errno($ch)) {//7.å¦‚æžœå‡ºé”™
            return curl_error($ch);
        }
        return $tmpInfo;die;
        $ok=json_decode($tmpInfo,true);
        curl_close($ch);//8.å…³é—­
        if($ok['errcode']==0){
           echo "<script>alert('菜单生成成功');location.href='index.php?r=menu/custom'</script>"; 
        }else{
            echo "<script>alert('菜单生成失败');location.href='index.php?r=menu/custom'</script>";
        }
        // $this->redirect(array(""));
    }


    /*
*删除菜单
 */
    public function actionDel(){
         $db = \Yii::$app->db;
        $id = \Yii::$app->request->post('id');
        // echo $id;die;
        $sql="select * from ".$db->tablePrefix."publicnum where id='$id' ";
        $connection=\Yii::$app->db->createCommand($sql);
        $data=$connection->queryAll();
         // print_r($data);die;
        $appid=$data[0]['appid'];
        $appsecret=$data[0]['appsecret'];
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

        // $url2="https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=$access_token";
        // $da=file_get_contents($url2);
        // print_r($da);die;
        $url="https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=$access_token";
        $da=file_get_contents($url);
        // $method="GET";
        // // $data=$arr['do'];
        // // print_r($arr['do']);die;
        // $ch = curl_init();   
        // curl_setopt($ch, CURLOPT_URL, $url); 
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        // //4.å‚æ•°å¦‚ä¸‹
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//æ¨¡æ‹Ÿæµè§ˆå™?
        // curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        // curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzipè§£åŽ‹å†…å®¹
        // curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        
        // curl_setopt($ch, CURLOPT_POSTFIELDS,$da);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $tmpInfo = curl_exec($ch);

        // if (curl_errno($ch)) {
        //     return curl_error($ch);
        // }
        // return $da;
        $ok=json_decode($da,true);
        // curl_close($ch);
        if($ok['errcode']==0){
           echo "<script>alert('菜单删除成功');location.href='index.php?r=menu/custom'</script>"; 
        }else{
            echo "<script>alert('菜单删除失败');location.href='index.php?r=menu/custom'</script>";
        }

    }

    public function actionDelall(){
        $db = \Yii::$app->db;
        $re = $db->createCommand('select id,appname from '.$db->tablePrefix.'publicnum ')->queryAll();        
       
        return $this->render('del',['arr'=>$re]);
    }
}