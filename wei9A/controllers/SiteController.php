<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller{
    public $enableCsrfValidation = false;

    public $layout='main';

    /*
     * 非法登录控制
     */
    public function init(){
        //安装界面如果安装好之后生成一个php文件 文件如果存在则跳到登录界面
        if(!is_file("assets/existence.php")){
            $this->redirect(array('/install/index'));
        }
        $session = Yii::$app->session;
        $uid = $session->get('uid','');
        //var_dump($uid);die;
        if($uid === ""){
            $this->redirect(['/login/index']);
        }
    }

    /*
     * 后台主页
     */
    public function actionIndex(){
        return $this->render('index');
    }
}
