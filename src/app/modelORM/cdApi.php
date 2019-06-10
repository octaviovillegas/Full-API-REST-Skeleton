<?php
namespace App\Models\ORM;
use App\Models\ORM\cd;

include_once __DIR__ . '/cd.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class cdApi 
{
 	public function Beinvenida($request, $response, $args) {
      $response->getBody()->write("GET => Bienvenido!!! ,a UTN FRA SlimFramework");
    
    return $response;
    }
    
     public function traerTodos($request, $response, $args) {
       	//return cd::all()->toJson();
        $todosLosCds=cd::all();
        $newResponse = $response->withJson($todosLosCds, 200);  
        return $newResponse;
    }

  
}