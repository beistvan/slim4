<?php

use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class)->setName('home');
    $app->get('/users', \App\Action\UsersReadAction::class)->setName('users-get');
    $app->get('/user/{id}', \App\Action\UserReadAction::class)->setName('user-get');
    $app->post('/useradd', \App\Action\UserCreateAction::class)->setName('useradd-post');
    $app->put('/userupdate/{id}', \App\Action\UserUpdateAction::class)->setName('userupdate-put');
    $app->delete('/userdelete/{id}', \App\Action\UserDeleteAction::class)->setName('userdelete-delete');
};
