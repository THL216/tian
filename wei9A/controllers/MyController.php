<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class MyController extends \yii\web\Controller
{
    public function actionIndex(){
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
        print_r($ret);
    }
}