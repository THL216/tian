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

    /*
     * 对接公众号
     */
    public function actionCheckapp(){
        $request = YII::$app->request;
        $get = $request->get();
        $str = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$get['appid'].'&secret='.$get['appsecret']);
        $tokenData = json_decode($str,true);
        //print_r($tokenData);
        if(isset($tokenData['errcode'])){
            echo 0;
        }else{
            echo 1;
        }
    }

    /*
     * 根据token获取二维码
     * http请求方式: POST
      *  URL: https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=TOKEN
      *POST数据格式：json
      *  POST数据例子：{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 123}}}
     */
    function actionAaa(){
        $uri = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=UxThV8Nz9Yu-6vUN_wz48cKp3IzPKxZQlTyFzX92KgKlaQ8k5SGvH2_06N8v5Z-JlgxjLXiDUbqF3QiMjYiA81iHQKKqZaS6uOdNsCmeoaMcqnR1GOXmjAJ5ZSOqSA5qLGJhABAPKN';
        $ch = curl_init ();
;
        curl_setopt ( $ch, CURLOPT_URL, $uri );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_HEADER, 0 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        //curl_setopt ( $ch, CURLOPT_POSTFIELDS, 1 );
        $return = curl_exec ( $ch );
        curl_close ( $ch );
        var_dump($return);
        print_r($return);
    }


}