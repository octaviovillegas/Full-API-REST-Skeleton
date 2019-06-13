<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\AutentificadorJWT;


include_once __DIR__ . '/../app/modelAPI/AutentificadorJWT.php';


return function (App $app) {
    $container = $app->getContainer();

		
/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/JWT', function () {   

   $this->get('/', function ($request, $response, $args) {
          //return cd::all()->toJson();

            $token=null;
            $arrayConToken = $request->getHeader('token');
            if($arrayConToken)
            $token=$arrayConToken[0];
            
            if  ($token)
            {
                 $token=", tu token es =".$token;
           
            }
            else
            {
                 $token=" no psasste el token";
          
            }
          $response->getBody()->write("GET => JWT  ,Funciona el ejemplo , redirecciones a los ejemplos".$token);
            return $response;
          return $newResponse;
        });
    $this->get('/crearToken/', function (Request $request, Response $response) {
      $datos = array('usuario' => 'rogelio@agua.com','perfil' => 'Administrador', 'alias' => "PinkBoy");
     //$datos = array('usuario' => 'rogelio@agua.com','perfil' => 'profe', 'alias' => "PinkBoy");
      
      $token= AutentificadorJWT::CrearToken($datos); 
      $newResponse = $response->withJson($token, 200); 
      return $newResponse;
    });

      $this->get('/devolverPayLoad/', function (Request $request, Response $response) { 
          $datos = array('usuario' => 'rogelio@agua.com','perfil' => 'Administrador', 'alias' => "PinkBoy");
          $token= AutentificadorJWT::CrearToken($datos); 
          $payload=AutentificadorJWT::ObtenerPayload($token);
          $newResponse = $response->withJson($payload, 200); 
          return $newResponse;
      });

      $this->get('/devolverDatos/', function (Request $request, Response $response) {
          $datos = array('usuario' => 'rogelio@agua.com','perfil' => 'Administrador', 'alias' => "PinkBoy");
          $token= AutentificadorJWT::CrearToken($datos); 
          $payload=AutentificadorJWT::ObtenerData($token);
          $newResponse = $response->withJson($payload, 200); 
          return $newResponse;
      });

      $this->get('/verificarTokenNuevo/', function (Request $request, Response $response) { 
          $datos = array('usuario' => 'rogelio@agua.com','perfil' => 'Administrador', 'alias' => "PinkBoy");
          $token= AutentificadorJWT::CrearToken($datos); 
          $esValido=false;
          try 
          {
            AutentificadorJWT::verificarToken($token);
            $esValido=true;      
          }
          catch (Exception $e) {      
            //guardar en un log
            echo $e;
          }
          if( $esValido)
          {
              /* hago la operacion del  metodo */
              echo "ok";
          }   
          return $response;
      });

      $this->get('/verificarTokenViejo/', function (Request $request, Response $response) {    
          
          $esValido=false;

          try {
            AutentificadorJWT::verificarToken("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE0OTczMTM0NTEsImV4cCI6MTQ5NzMxMzUxMSwiYXVkIjoiMTU3NDQzNzc4MzUzNGEzMDNjYzExY2YzNGI0OTc1ODAxMTNkMDBiOSIsImRhdGEiOnsibm9tYnJlIjoicm9nZWxpbyIsImFwZWxsaWRvIjoiYWd1YSIsImVkYWQiOjQwfSwiYXBwIjoiQVBJIFJFU1QgQ0QgMjAxNyJ9.DZ1LC0BTl5YKHWr7NjWY6r2EDKvVBeOTZiNEv4CXaN0");
            $esValido=true;
            
          } catch (Exception $e) {      
            //guardar en un log
            echo $e;
          }
          if( $esValido)
          {
              /* hago la operacion del  metodo
              */
              echo "ok";
          }   
          return $response;

      });
      $this->get('/verificarTokenError/', function (Request $request, Response $response) {    
          
          $esValido=false;
          // cambio un caracter de un token valido
          try {
            AutentificadorJWT::verificarToken("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE0OTczMTM0NTEsImV4cCI6MTQ5NzMxMzUxMSwiYXVkIjoiMTU3NDQzNzc4MzUzNGEzMDNjYzExY2YzNGI0OTc1ODAxMTNkMDBiOSIsImRhdGEiOnsibm9tYnJlIjoicm9nZWxpbyIsImFwZWxsaWRvIjoiYWd1YSIsImVkYWQiOjQwfSwiYXBwIjoiQVBJIFJFU1QgQ0QgMjAxNyJ9.DZ1LC0BTl5YKHWr7NjWY6r2EDKvVBeOTZiNEv4CXaN");
            $esValido=true;
            
          } catch (Exception $e) {      
            //guardar en un log
            echo $e;
          }
          if( $esValido)
          {
              /* hago la operacion del  metodo
              */
              echo "ok";
          }   
          return $response;

      });
      $this->post('/', function (Request $request, Response $response) {    
          
         $arrayConToken = $request->getHeader('token');
            $token=$arrayConToken[0];
            if  ($token)
            {
                 $response->getBody()->write("El token es: ".$token);
           
            }
            else
            {
                 $response->getBody()->write("No pasaste token en el header");
          
            }
          return $response;

      });

      


     
});



};
