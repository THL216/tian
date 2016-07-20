<?php
/**
  * wechat php test
  */

//define your token
$appcheck = $_GET['str'];

include_once("./web/assets/db.php");
$arr = $pdo->query("select * from ".$fix."publicnum where appcheck = '$appcheck'")->fetch(PDO::FETCH_ASSOC);
$pdo->query('set names utf8');
//print_r($arr[apptoken]);die;

  $token=$arr['apptoken'];
    $tok=$arr['appcheck'];
    $url=$arr['appurl'];
    $id=$arr['id'];
$data = $pdo->query("select * from ".$fix."reply where appid = ".$id)->fetchAll(PDO::FETCH_ASSOC);
//print_r($data);die;
define("ID","$id");
define("TOKEN", $token);
$wechatObj = new wechatCallbackapiTest();
 $echoStr = $_GET["echostr"];
 if(isset($echoStr)){
     $wechatObj->valid($data);
 }else{
    $wechatObj->responseMsg($data);
 }

class wechatCallbackapiTest
{
    public function valid($data)
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature($data)){
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg($data)
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";
                $imgTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <PicUrl><![CDATA[%s]]></PicUrl>
                            </xml>";             
                if(!empty( $keyword ))
                {
                        $msgType = "text";
						foreach($data as $val){
						if($keyword == $val['rekeyword'] ){
						$contentStr = $val['redesc'];
						}

						}

                    if($contentStr){
						
                      }else{
                        
                       $url ="http://www.tuling123.com/openapi/api?key=e76ff40c985325c0d52f5683fc3f7f38&info=$keyword"; 
                        $file = file_get_contents($url);
                         $arr = json_decode($file);
                        $contentStr=$arr->text;

						//$contentStr = iconv("gbk","UTF8",$contentStr);
                    }
					//$contentStr = iconv("","UTF8",$contentStr);
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;



                }else{
                    echo "Input something...";
                }

        }else {
            echo "";
            exit;
        }
    }
        
    private function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
                
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        //return true;
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}

?>
