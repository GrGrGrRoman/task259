<?php

namespace App\controllers;

use App\core\Controller;
use function App\d;

class DataController extends Controller
{
    public function addimagesAction()
    {
        if (!empty($_FILES))
        {
            if (!$this->model->imageValidate($_FILES))
            {
                exit;
            }
            $file = $this->model->postAddImg($_SESSION['account']['login']);
            if (!$file)
            {
                echo 'Ошибка добавления в БД';
                exit;
            }            
            $this->model->postUploadImage($_FILES['img']['tmp_name'], $file);
        }
        $this->view->redirect('');
    }
    
    public function deleteAction()
    {
        if (!$this->model->isCommentExists($this->route['id']))
        {
            $this->view->errorCode(404);
        }
        $this->model->commentDelete($this->route['id']);
        $this->view->redirect('commentslist/' . $_COOKIE['id_img']);
    }

    public function commentslistAction() 
    {
        $arr = 
        [
            'postslist' => $this->model->commentsList(),
        ];
        $this->view->render('Комментарии', $arr);
    }
}