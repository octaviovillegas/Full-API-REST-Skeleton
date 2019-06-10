<?php
namespace App\Models\PDO;
use App\Models\PDO\cd;

include_once __DIR__ . '/cd.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class cdApi 
{
 	public function Bienvenida($request, $response, $args) {
      $response->getBody()->write("GET => Bienvenido!!! ,a SlimFramework");
    
    return $response;
    }
    
     public function TraerTodos($request, $response, $args) {
        $todosLosCds=cd::TraerTodoLosCds();
        $newResponse = $response->withJson($todosLosCds, 200);  
        return $newResponse;
    }

  
}