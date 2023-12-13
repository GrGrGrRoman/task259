<?php

return
[
    // MainController
    '' =>
    [
        'controller' => 'main',
        'action' => 'index',
    ],

    'deleteimage/{id:\d+}' =>
    [
        'controller' => 'main',
        'action' => 'deleteimage',
    ],
    
    'addcomment' =>
    [
        'controller' => 'main',
        'action' => 'addcomment',
    ],
    
    // пагинация
    '{page:\d+}' =>
    [
        'controller' => 'main',
        'action' => 'index',
    ],
    
    // AccountController
    'login' =>
    [
        'controller' => 'account',
        'action' => 'login',
    ],
    'logout' =>
    [
        'controller' => 'account',
        'action' => 'logout',
    ],

    'register' =>
    [
        'controller' => 'account',
        'action' => 'register',
    ],
    
    // DataController
    'addimages' =>
    [
        'controller' => 'data',
        'action' => 'addimages',
    ],
    'commentslist/{id:\d+}' =>
    [
        'controller' => 'data',
        'action' => 'commentslist',
    ],
    'delete/{id:\d+}' =>
    [
        'controller' => 'data',
        'action' => 'delete',
    ],

];