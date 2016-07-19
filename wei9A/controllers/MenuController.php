<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use yii\web\DbSession;

class MenuController extends Controller{
    public $enableCsrfValidation = false;

    public $layout = 'main';

    /*
   * 非法登录控制
   */
    public function init()
    {
        //安装界面如果安装好之后生成一个php文件 文件如果存在则跳到登录界面
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
     * 展示自定义菜单表单
     */
    public function actionCustom(){
       $db = \Yii::$app->db;
        $re = $db->createCommand('select uid,appname from wei_publicnum ')->queryAll();






        return $this->render('custom',['arr'=>$re]);
    }

}