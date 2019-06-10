<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\PDO\cd;
use App\Models\PDO\cdApi;



include_once __DIR__ . '/../../src/app/modelPDO/cdApi.php';
include_once __DIR__ . '/../../src/app/modelPDO/cd.php';



return function (App $app) {
    $container = $app->getContainer();  

    
    $app->group('/cdPDO', function () {   

       $this->get('/', function ($request, $response, $args) {

            return  json_encode(cd::TraerTodoLosCds());
            $todosLosCds=cd::TraerTodoLosCds();
            $newResponse = $response->withJson($todosLosCds, 200);  
            return $newResponse;
        });

    });
   
    $app->group('/cdPDO2', function () {   

        $this->get('/',cdApi::class . ':TraerTodos');   

    });

};
