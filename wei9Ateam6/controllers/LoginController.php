<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;

class LoginController extends Controller{

    public $enableCsrfValidation = false;

    public function init(){
        //安装界面如果安装好之后生成一个php文件 文件如果存在则跳到登录界面
        if(!is_file("assets/existence.php")){
            $this->redirect(array('/install/index'));
        }
        $session = Yii::$app->session;
        $uid = $session->get('uid', '');
        if ($uid != '') {
            $this->redirect(['/site/index']);
        }
    }

    public function actionIndex(){
        $request = YII::$app->request;
        if(!$request->post()){
            return $this->renderPartial('index');
        }else{
            //print_r($request->post());die;
            $u_name = $request->post('u_name');
            $pwd = md5($request->post('pwd'));
            $userData = User::find()->where(['uname'=>$u_name])->andWhere(['upwd'=>$pwd])->asArray()->one();

            if($userData){
                //设置cookie
                setcookie('uname',$userData['uname']);
                //设置session
                $session = Yii::$app->session;
                $session->open();
                $session->set('uid', $userData['uid']);
                echo 1;die;
            }else echo 0;
        }
    }

    /*
     * 退出登录
     */
    public function actionLoginout(){
        //删除cookie
        setcookie('uname','',time()-1);
        $session = Yii::$app->session;
        $session->open();
        $session->remove('uid');
        $this->redirect(['login/index']);
    }
}