<?php
/**
 * Created by PhpStorm.
 * User: XH
 * Date: 2017/3/27
 * Time: 20:27
 */

namespace project\Controller;
use Think\Controller;

class DataController extends Controller
{
    public function getData(){
//        $name=I("post.name");
        $origin=I("post.origin");
        $end =I("post.end");
        $fecg =I("post.FECG");
        if($origin&&$end&&$fecg){
            file_put_contents("allOrigin.json",$origin."\n",FILE_APPEND);//存储所有的测量前数据
            file_put_contents("lastOrigin.json",$origin);//存储最新的测量前数据
            file_put_contents("allEnd.json",$end."\n",FILE_APPEND);//存储所有的测量后数据
            file_put_contents("lastEnd.json",$end);//存储最新的测量后数据
            file_put_contents("AllFecg.json",$fecg."\n",FILE_APPEND);//存储所有的FECG数据
            file_put_contents("lastFecg.json",$fecg);//存储所有的FECG数据
            $dataBack=array("code"=>"200");
            $this->ajaxReturn($dataBack);
        }else{
            $time=date("Y-m-d H:i:s",time());
            $error="收到的数据为空";
            file_put_contents("error.txt","$time.$error"."\n",FILE_APPEND);
            $dataBack=array("code"=>"404");
            $this->ajaxReturn($dataBack);

        }

    }
    public function setData(){
        $parm=I("post.parm");//接收参数
        $originJson=file_get_contents("lastOrigin.json");
        $endJson=file_get_contents("lastEnd.json");
        $originData=json_decode($originJson,true);
        $endData=json_decode($endJson,true);
        if($parm=="blend"){
            $this->ajaxReturn($originData);
        }else{
            $this->ajaxReturn($endData);
        }


    }
}