<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

		 /* $app->get('[/]', function (Request $request, Response $response) {    
		    $response->getBody()->write("GET => Bienvenido!!! ,a SlimFramework");
		    return $response;

		});*/

		$app->post('[/]', function (Request $request, Response $response) {   
		    $response->getBody()->write("POST => Bienvenido!!! ,a SlimFramework");
		    return $response;

		});

		$app->put('[/]', function (Request $request, Response $response) {  
		    $response->getBody()->write("PUT => Bienvenido!!! ,a SlimFramework");
		    return $response;

		});

		$app->delete('[/]', function (Request $request, Response $response) {  
		    $response->getBody()->write(" DELETE => Bienvenido!!! ,a SlimFramework");
		    return $response;

		});


		$app->get('/datos/', function (Request $request, Response $response) {     
		    $datos = array('nombre' => 'rogelio','apellido' => 'agua', 'edad' => 40);
		    $newResponse = $response->withJson($datos, 200);  
		    return $newResponse;
		});

		$app->post('/datos/', function (Request $request, Response $response) {    
		    $ArrayDeParametros = $request->getParsedBody();
		   // var_dump($ArrayDeParametros);
		    $objeto= new stdclass();
		    $objeto->nombre=$ArrayDeParametros['nombre'];
		    $objeto->apellido=$ArrayDeParametros['apellido'];
		    $objeto->edad=$ArrayDeParametros['edad'];
		    $newResponse = $response->withJson($objeto, 200);  
		    return $newResponse;

		});

		/* atender todos los verbos de HTTP*/
		$app->any('/cualquiera/[{id}]', function ($request, $response, $args) {
		    
		    var_dump($request->getMethod());
		    $id=$args['id'];
		    $response->getBody()->write("cualquier verbo de ajax parametro: $id ");
		    return $response;
		});



		/* atender algunos los verbos de HTTP*/
		$app->map(['GET', 'POST'], '/mapeado/', function ($request, $response, $args) {

		      var_dump($request->getMethod());
		     $response->getBody()->write("Solo POST y GET");
		});


		/* agrupacion de ruta*/
		$app->group('/saludo', function () {

		    $this->get('/{nombre}', function ($request, $response, $args) {
		        $nombre=$args['nombre'];
		        $response->getBody()->write("HOLA, Bienvenido <h1>$nombre</h1> a la apirest de 'CDs'");
		    });

		     $this->get('/', function ($request, $response, $args) {
		        $response->getBody()->write("HOLA, Bienvenido a la apirest de 'CDs'... ingresá tu nombre");
		    });
		 
		     $this->post('/', function ($request, $response, $args) {      
		        $response->getBody()->write("HOLA, Bienvenido a la apirest por post");
		    });
		     
		});


		/* agrupacion de ruta y mapeado*/
		$app->group('/usuario/{id:[0-9]+}', function () {

		    $this->map(['POST', 'DELETE'], '', function ($request, $response, $args) {
		        $response->getBody()->write("Borro el usuario por p");
		    });

		    $this->get('/nombre', function ($request, $response, $args) {
		        $response->getBody()->write("Retorno el nombre del usuario del id ");
		    });
		});



};
