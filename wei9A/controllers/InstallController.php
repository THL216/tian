<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class InstallController extends Controller
{
    public $enableCsrfValidation = false;
    public function init(){
        //安装界面如果安装好之后生成一个php文件 文件如果存在则跳到登录界面
        if(is_file("assets/existence.php")){
            $this->redirect(array('/login/index'));
        }
    }
    public function actionIndex(){
        return $this->renderPartial("one");
    }
    public function actionOne(){
        header('Content-type:text/html;charset=utf8');
        $ret = array();
        $ret['server']['os']['value'] = php_uname();
        $ret['server']['sapi']['value'] = $_SERVER['SERVER_SOFTWARE'];
        $ret['server']['php']['value'] = PHP_VERSION;
//        $ret['server']['dir']['value'] = IA_ROOT;
        $ret['server']['upload']['value'] = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'unknow';
        $ret['php']['version']['value'] = PHP_VERSION;
        $ret['php']['version']['class'] = 'success';
        $ret['php']['pdo']['ok'] = extension_loaded('pdo') && extension_loaded('pdo_mysql');
        $ret['php']['fopen']['ok'] = @ini_get('allow_url_fopen') && function_exists('fsockopen');
        $ret['php']['curl']['ok'] = extension_loaded('curl') && function_exists('curl_init');
        $ret['php']['ssl']['ok'] = extension_loaded('openssl');
        $ret['php']['gd']['ok'] = extension_loaded('gd');
        $ret['php']['dom']['ok'] = class_exists('DOMDocument');
        $ret['php']['session']['ok'] = ini_get('session.auto_start');
        $ret['php']['asp_tags']['ok'] = ini_get('asp_tags');

        return $this->renderPartial("index",['ret'=>$ret]);
    }
    public function actionTwo(){
        return $this->renderPartial("three");
    }
    public function actionCheck(){
        $post=\Yii::$app->request->post();
        $host=$post['dbhost'];
        $name=$post['dbname'];
        $pwd=$post['dbpwd'];
        $db=$post['db'];
        $uname=$post['uname'];
        $upwd=md5($post['upwd']);
		$dbtem=$post['dbtem'];
        $port = $post['port'];
        if (@$link=mysqli_connect($host,$name,$pwd,'',$port)){
            //链接地址，
            @$db_selected=mysqli_connect($host,$name,$pwd,$db,$port);
                if($db_selected){
                    $sql="drop database ".$post['db'];
                    $re=mysqli_query($link,$sql);
                }
                $sql="create database ".$post['db'];
                mysqli_query($link,$sql);

            $str=str_replace("wei_",$dbtem,file_get_contents('./assets/table.sql'));
            $arr=explode('-- ----------------------------',$str);
            $db_selected = mysqli_connect($host,$name,$pwd,$db,$port);
            for($i=0;$i<count($arr);$i++){
                if($i%2==0){
                    $a=explode(";",trim($arr[$i]));
                    array_pop($a);
                    foreach($a as $v){
                        mysqli_query($db_selected,$v);
                    }
                }
            }
                $str="<?php
					return [
						'class' => 'yii\db\Connection',
						'dsn' => 'mysql:host=".$post['dbhost'].";port=".$port.";dbname=".$post['db']."',
						'username' => '".$post['dbname']."',
						'password' => '".$post['dbpwd']."',
						'charset' => 'utf8',
						'tablePrefix' => '".$post['dbtem']."',   //加入前缀名称
					];";
                file_put_contents('../config/db.php',$str);
               $sql="insert into ".$post['dbtem']."user (uname,upwd) VALUES ('$uname','$upwd')";
                mysqli_query($db_selected,$sql);
            mysqli_close($link);
            $counter_file       =   'assets/existence.php';//文件名及路径,在当前目录下新建aa.txt文件
            $fopen                     =   fopen($counter_file,'wb');//新建文件命令
            fputs($fopen,   '安装完成');//向文件中写入内容;
            fclose($fopen);
            $this->redirect(array('/login/index'));
        }else{
            echo "<script>
                        if(alert('数据库账号或密码错误')){
                             location.href='index.php?r=install/two';
                        }else{
                             location.href='index.php?r=install/two';
                        }
            </script>";
        }
    }
}