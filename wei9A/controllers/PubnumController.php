<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Publicnum;

class PubnumController extends Controller
{
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
     * 添加公众号
     */
    public function actionAddnum(){
        $request = YII::$app->request;
        if(!$request->isPost){
            return $this->render('add');
        }else{
            $post = $request->post();
            $pub = new Publicnum();
            $pub ->appid=$post['appid'];
            $pub ->appname=$post['appname'];
            $pub ->appsecret=$post['appsecret'];
            $pub ->appdesc=$post['appdesc'];
            if($pub ->save()){
                $this->redirect(array('/pubnum/numlist'));
            }else{
                echo 'error';
            }

        }
    }

    /*
     * 公众号列表
     */
    public function actionNumlist(){
        $data['numDate'] = Publicnum::find()->asArray()->all();
        return $this->render('lists',$data);
    }

    /*
     * 删除公众号
     */
    public function actionNumdel()
    {
        if(!Publicnum::deleteAll(array('id'=>YII::$app->request->get('id')))){
            echo 'error';
        }else{
            $this->redirect(array('/pubnum/numlist'));
        }
    }

    /*
     * 修改公众号
     */
    public function actionNumup(){
        $request = YII::$app->request;
        $id = $request->get('id');
        if(!$request->isPost){
            $data['numDate'] = Publicnum::find()->where(['id'=>$id])->asArray()->one();
            return $this->render('add',$data);

        }else{
            $post = $request->post();
            $numObj = Publicnum::find()->where(['id'=>$id])->one();
            $numObj->appname = $post['appname'];
            $numObj->appid = $post['appid'];
            $numObj->appsecret = $post['appsecret'];
            $numObj->appdesc = $post['appdesc'];
            if($numObj->save(['id'=>$id])){
                $this->redirect(['/pubnum/numlist']);
            }
        }
    }

}