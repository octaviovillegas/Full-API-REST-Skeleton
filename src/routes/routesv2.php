<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;



include_once __DIR__ . '/../src/app/clasesPDO/AccesoDatos.php';
include_once __DIR__ . '/../src/app/clasesPDO/cd.php';


return function (App $app) {
    $container = $app->getContainer();

		
/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/cd', function () {   

        $this->get('/',\cd::class . ':traerTodos');
        /*
        $this->get('/{id}', \cd::class . ':traerUno');
        $this->delete('/', \cd::class . ':BorrarUno');
        $this->put('/', \cd::class . ':ModificarUno');
        //se puede tener funciones definidas
        /*SUBIDA DE ARCHIVO*/
        /*
        $this->post('/', function (Request $request, Response $response) {
          
            
            $ArrayDeParametros = $request->getParsedBody();
            //var_dump($ArrayDeParametros);
            $titulo= $ArrayDeParametros['titulo'];
            $cantante= $ArrayDeParametros['cantante'];
            $año= $ArrayDeParametros['anio'];
            
            $micd = new cd();
            $micd->titulo=$titulo;
            $micd->cantante=$cantante;
            $micd->año=$año;
            $micd->InsertarElCdParametros();

            $archivos = $request->getUploadedFiles();
            $destino="./fotos/";
            //var_dump($archivos);
            //var_dump($archivos['foto']);

            $nombreAnterior=$archivos['foto']->getClientFilename();
            $extension= explode(".", $nombreAnterior)  ;
            //var_dump($nombreAnterior);
            $extension=array_reverse($extension);

            $archivos['foto']->moveTo($destino.$titulo.".".$extension[0]);
            $response->getBody()->write("cd");

            return $response;

        });*/

     
});



};
