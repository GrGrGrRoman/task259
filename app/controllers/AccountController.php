<?php

namespace App\controllers;

use App\config\Helpers;
use App\core\Controller;
use App\core\View;

use function App\d;
use function App\dd;

class AccountController extends Controller
{
    public function loginAction()
    {
        if (!empty($_POST))
        {
            if (!$this->model->validate(['login', 'password',], $_POST))
            {
                echo '<script> alert ("Проверьте правильность ввода логина/пароля");</script>';
            }
            // проверка записей на соответствие
            elseif (!$this->model->checkAccount($_POST['login'], $_POST['password']))
            {
                echo '<script> alert ("Проверьте правильность ввода логина/пароля");</script>';
            }
            else
            {
                $this->model->login($_POST['login']);
                $_SESSION['account']['id'] = $this->model->getId($_POST['login']);
                $this->view->redirect('');
            }
        }
        $this->view->render('Вход');
    }

    public function registerAction()
    {
        if (!empty($_POST))
        {
            if (!$this->model->validate(['login', 'password',], $_POST))
            {
                echo '<script> alert ("Проверьте правильность ввода логина/пароля");</script>';
            }
            elseif (!$this->model->checkLoginExists($_POST['login']))
            {
                echo '<script> alert ("Этот логин уже используется");</script>';
            }
            else
            {
                $this->model->accountAdd($_POST);
                echo '<script> alert ("Вы успешно зарегистрированы");</script>';
                $this->view->redirect('login');
            }        
        }
        $this->view->render('Регистрация');
    }

    public function logoutAction()
    {
        Helpers::deleteSession('account');
        $this->view->redirect('');
    }
}