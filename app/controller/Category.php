<?php

namespace controller;

use lmonkey\CatTree as CT;
use model\BaseDao;

class Category extends BaseController
{
    public function index()
    {
        $db = new BaseDao();
        $treelist = $db->select('category', ['id', 'catname', 'pid', 'ord']);
        $data = CT::getList($treelist);

        $this->assign('treelist', $data);
        $this->display('category/index');
    }

    function order()
    {
        // dd($_POST);
        $db = new BaseDao();
        foreach ($_POST['id'] as $key => $value) {
            $db->update('category', ['ord' => $value], ['id' => $key]);
        }
        $this->success('/catelist', '排序成功');
    }

    public function toadd()
    {
        $db = new BaseDao();
        $treelist = $db->select('category', ['id', 'catname', 'pid', 'ord']);
        $data = CT::getList($treelist);

        $this->assign('treelist', $data);
        $this->display('category/add');
    }

    public function doadd()
    {
        //dd($_POST);
        $db = new BaseDao();
        //unset($_POST['submit']);
        $data = $db->insert('category', $_POST);
        if ($data->rowCount() > 0) {
            $this->success('/catelist', 'success');
        } else {
            $this->error('/category/add', 'no');
        }
    }

    public function toupdate()
    {
        $db = new BaseDao();
        $treelist = $db->select('category', ['id', 'catname', 'pid', 'ord']);
        $data = CT::getList($treelist);

        $cate = $db->get('category', ['id', 'catname', 'pid', 'ord'], ['id' => $_GET['id']]);
        //dd($cate);
        $this->assign('treelist', $data);
        $this->assign('cate', $cate);
        $this->display('category/update');
    }

    public function doupdate()
    {
        //dd($_POST);
        $db = new BaseDao();
        $id = $_POST['id'];
        unset($_POST['id']); // unset post not $id
        $treelist = $db->select('category', ['id', 'catname', 'pid', 'ord']);
        $ntree = CT::getList($treelist);
        //dd($ntree);
        $selftree = $ntree[$id];
        if (in_array($_POST['pid'], explode(',', $selftree['childs']))) {
            $this->error('/catelist', '不能移动到子类下');
        } else {

            $data = $db->update('category', $_POST, ['id' => $id]);
            if ($data->rowCount() > 0) {
                $this->success('/catelist', 'success');
            } else {
                $this->error('#', 'no');
            }
        }
    }

    public function todelete()
    {
        $db = new BaseDao();
        $treelist = $db->select('category', ['id', 'catname', 'pid', 'ord']);
        $ntree = CT::getList($treelist);
        $selftree = $ntree[$_GET['id']];
        if (!empty($selftree['childs'])) {
            $this->error('/catelist', 'no');
        } else {

            $data = $db->delete('category', ['id' => $_GET['id']]);
            if ($data->rowCount() > 0) {
                $this->success('/catelist', 'success');
            } else {
                $this->error('#', 'no');
            }
        }
    }
}
