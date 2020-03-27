<?php

namespace controller;

use model\BaseDao;
use model\User;
class Test extends BaseController
{
    function index()
    {
        $this->assign("one", "aaa");
        // $this->assign("two", "bbb");
        // $this->assign("alist", array("three" => "cc", "four" => "dddd"));

        //dd($this->data);
        // $this->display("index");
        $user = new User();
        $uer2 =new BaseDao;
        $data = $uer2->select("user","name");
        $this->assign("userlist",$data);
        $this->display("index");
    }
    function hello()
    {
        echo "this is hello()";
    }
}
