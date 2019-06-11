<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
  
  	$container = $app->getContainer();

	

	$app->add(function ($req, $res, $next) use ($container) {
		$info=array();
		$info["metodo"]=$req->getMethod();
		$info["URI"]=$req->getUri()->getBaseUrl();
		$info["RUTA"]=$req->getUri()->getPath();
		$info["autoridad"]=$req->getUri()->getAuthority();
		
		$datos=implode(";", $info);
		$datos=http_build_query( $info,'',', ');
		$container->get('logger')->info($datos);
       // $container->get('logger')->addCritical('Hey, a critical log entry!');
	    $response = $next($req, $res);
	    return $response;
	});

$app->add(function ($req, $res, $next) use ($container) {
			
		$id="no anda";
		  if (isset($_SERVER)) {

		        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
		            $id= $_SERVER["HTTP_X_FORWARDED_FOR"];
		        
		        if (isset($_SERVER["HTTP_CLIENT_IP"]))
		            $id= $_SERVER["HTTP_CLIENT_IP"];

		        $id= $_SERVER["REMOTE_ADDR"];
			    }

			    if (getenv('HTTP_X_FORWARDED_FOR'))
			        $id= getenv('HTTP_X_FORWARDED_FOR');

			    if (getenv('HTTP_CLIENT_IP'))
			        $id= getenv('HTTP_CLIENT_IP');

			    $id= getenv('REMOTE_ADDR');
		$container->get('logger')->info($ip);
		$response = $next($req, $res);
	    return $response;
	});





function GetUserIP() {

    if (isset($_SERVER)) {

        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        
        if (isset($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];

        return $_SERVER["REMOTE_ADDR"];
    }

    if (getenv('HTTP_X_FORWARDED_FOR'))
        return getenv('HTTP_X_FORWARDED_FOR');

    if (getenv('HTTP_CLIENT_IP'))
        return getenv('HTTP_CLIENT_IP');

    return getenv('REMOTE_ADDR');
}






	$app->add(function ($req, $res, $next) {
	    $response = $next($req, $res);
	    return $response
	        ->withHeader('Access-Control-Allow-Origin', $this->get('settings')['cors'])
	        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
	        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	});
};
