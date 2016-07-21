<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Reply;
use app\models\Publicnum;

class ReplyController extends Controller
{
    public $enableCsrfValidation = false;
    public $layout = 'main';
    /*
     * 非法登录控制
     */
    public function init()
    {
        //安装界面如果安装好之后生成一个php文件 文件如果存在则跳到登录界面
        if (!is_file("assets/existence.php")) {
            $this->redirect(array('/install/index'));
        }
        $session = Yii::$app->session;
        $uid = $session->get('uid', '');
        if ($uid == '') {
            $this->redirect('index.php?r=login/index');
        }
    }

    public function actionIndex(){
        $db = \Yii::$app->db;
        $session = Yii::$app->session;
        $request = YII::$app->request;
        $uid = $session->get('uid', '');
        $data = Publicnum::find()->where("uid=$uid")->asArray()->all();
        $sql="select * from ".$db->tablePrefix."publicnum INNER  join  ".$db->tablePrefix."reply  on ".$db->tablePrefix."reply.appid = ".$db->tablePrefix."publicnum.id where ".$db->tablePrefix."publicnum.uid = $uid";
        $connection=\Yii::$app->db->createCommand($sql);
        $arr=$connection->queryAll();
        return $this->render('index',['arr'=>$arr]);

    }
    public function actionAdd(){
        $session = Yii::$app->session;
        $request = YII::$app->request;
        $uid = $session->get('uid', '');
        if(!$request->isPost){
            $data = Publicnum::find()->where("uid=$uid")->asArray()->all();
            return $this->render('add',['data'=>$data]);
        }else {
            $post = $request->post();
            if($post['id']){
                $pub = Reply::find()->where(['id'=>$post['id']])->one();
            }else{
                $pub = new Reply();
            }
            $pub ->appid=$post['appid'];
            $pub->rename = htmlspecialchars($post['rename']);
            $pub->rekeyword = htmlspecialchars($post['rekeyword']);
            $pub->redesc = htmlspecialchars($post['redesc']);
            $pub->retype = 'txt';
            if($post['id']){

               $re = $pub ->save(['id'=>$post['id']]);
            }else{
                $re = $pub ->save();
            }

            if($re){
                $this->redirect(array('/reply/index'));
            }else{
                echo 'error';
            }
        }
    }

/*
 * 修改数据
 */
    public function actionUpd(){
        $session = Yii::$app->session;
        $request = YII::$app->request;
        $uid = $session->get('uid', '');
        $data = Publicnum::find()->where("uid=$uid")->asArray()->all();
        $id = $request->get('id');
        $datanum =Reply::find()->where("id = $id")->asArray()->One();
        return $this->render('add',['data'=>$data,'numDate'=>$datanum]);
    }

    /*
     * 删除数据
     */
    public function actionDel(){
        $request = YII::$app->request;
        $id = $request->get('id');
        $reply = new Reply();
       $re = Reply::deleteAll(array('id'=>$id));
        if($re){
            $this->redirect(array('/reply/index'));
        }else{
            echo "<script>alert('删除失败');location.href='index.php?r=reply/index';</script>";
        }
    }
}

//public function actionIndex()
//{
//    //$this->layout='menu.php';
//    //include ('../views/layouts/menu.php');
//    $sql="select * from we_reply INNER  join we_text_reply on we_reply.reid=we_text_reply.reid";
//    $connection=\Yii::$app->db->createCommand($sql);
//    $arr=$connection->queryAll();
//    return $this->render('reply',['arr'=>$arr]);
//}
//public function actionRuled(){
//    //include ('../views/layouts/menu.php');
//    $sql="select * from we_account ";
//    $connection=\Yii::$app->db->createCommand($sql);
//    $arr=$connection->queryAll();
//    return $this->render('ruled',['arr'=>$arr]);
//}
//public function actionAdds(){
//    $connection=\Yii::$app->db;
//    $arr=\Yii::$app->request->post();
//    $connection->createCommand()->insert('we_reply', [
//        'aid' => $arr['user'],
//        'rename' => $arr['name'],
//        'rekeyword'=>$arr['keyword'],
//    ])->execute();
//    $reid=$connection->getLastInsertID();
//    //$reid=$connection->getLastInsertID();
//    $connection->createCommand()->insert('we_text_reply', [
//        'reid' => "$reid",
//
//        'trcontent'=>$arr['content'],
//    ])->execute();
//    $this->redirect(array('/reply/index'));
//}