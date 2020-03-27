<?php

namespace controller;


use Intervention\Image\ImageManagerStatic as Image;
use JasonGrimes\Paginator;
use lmonkey\CatTree as CT;
use model\BaseDao;
use Slince\Upload\UploadHandlerBuilder;


class Book extends BaseController
{
    public function index($num = 1)
    {
        $db = new BaseDao();


        $totalItems = $db->count('book');
        $itemsPerPage = 10;
        $currentPage = $num;
        $urlPattern = '/booklist/(:num)';
        
        
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        $start = ($currentPage -1) * $itemsPerPage;
        $books = $db->select('book', '*',['LIMIT'=>[$start, $itemsPerPage]]);

        $this->assign('page', $paginator);
        $this->assign('booklist', $books);
        $this->display('book/index');
    }



    public function toadd()
    {
        $db = new BaseDao();
        $treelist = $db->select('category', ['id', 'catname', 'pid', 'ord']);
        $data = CT::getList($treelist);

        $this->assign('treelist', $data);
        $this->display('book/add');
    }

    public function doadd()
    {

        $db = new BaseDao();

        $path = dirname(dirname(__DIR__)) . "\uploads";
        $builder = new UploadHandlerBuilder; //create a builder.
        $handler =
            $builder->allowExtensions(['jpg', 'png', 'gif'])
            ->allowMimeTypes(['image/*'])
            ->saveTo($path) //save to local
            ->getHandler();

        $files = $handler->handle();
        $filename = $files['filename']->getUploadedFile()->getClientOriginalName(); // original name
        $_POST['filename'] = $filename;

        // open an image file
        $img = Image::make($path . '/' . $filename);

        // resize image instance
        $img->resize(150, 300);

        // insert a watermark
        $img->insert($path . '/watermark.jpg');

        // save image in desired format
        $img->save($path . '/pre_' . $filename);


        $data = $db->insert('book', $_POST);
        if ($data->rowCount() > 0) {
            $this->success('/booklist', 'success');
        } else {
            $this->error('/book/add', 'no');
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
        $this->display('book/update');
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
