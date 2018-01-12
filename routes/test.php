<?php 

$router->get('/core', function () use ($router) {
    return $router->app->version();
});

$router->get('/core/test', 'TestController@index');

?>