<?php

namespace App\controllers;

use App\config\Pagination;
use App\core\Controller;
use function App\d;

class MainController extends Controller
{
    public function indexAction()
    {
        $pagination = new Pagination($this->route, $this->model->postsCount(), 1);
        
        $viewArr = 
        [
            'pagination' => $pagination->get(),
            'list' => $this->model->postsList($this->route),
        ];

        $this->view->render('Главная страница', $viewArr);
    }

    public function deleteimageAction()
    {
        if (!$this->model->isPostExists($this->route['id']))
        {
            $this->view->errorCode(404);
        }
        $this->model->imageDelete($this->route['id']);
        $this->view->redirect('');
    }

    public function addcommentAction()
    {
        if (!empty($_POST))
        {
            if (!$this->model->postValidate($_POST))
            {
                exit;
            }
            $this->model->postAdd($_POST, $_SESSION['account']['login']);
        }
        $this->view->redirect('commentslist/' . $_COOKIE['id_img']);
    }
}