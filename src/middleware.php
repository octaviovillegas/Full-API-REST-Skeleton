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
			$container->get('IPlogger')->info("ip =".$id);
			$response = $next($req, $res);
		    return $response;
		});

	$app->add(function ($req, $res, $next) use ($container) {
		
			# devolvemos el array de valores
			$informacion['Datos'] = $_SERVER['HTTP_USER_AGENT'];
			
			$container->get('IPlogger')->info("Datos  =".$informacion['Datos']);
			$response = $next($req, $res);
		    return $response;
		});


function detect()
{
	$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
	$os=array("WIN","MAC","LINUX");
 
	# definimos unos valores por defecto para el navegador y el sistema operativo
	$info['browser'] = "OTHER";
	$info['os'] = "OTHER";
 
	# buscamos el navegador con su sistema operativo
	foreach($browser as $parent)
	{
		$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
		$f = $s + strlen($parent);
		$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
		$version = preg_replace('/[^0-9,.]/','',$version);
		if ($s)
		{
			$info['browser'] = $parent;
			$info['version'] = $version;
		}
	}
 
	# obtenemos el sistema operativo
	foreach($os as $val)
	{
		if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
			$info['os'] = $val;
	}
 
	# devolvemos el array de valores
	return $info;
}







	$app->add(function ($req, $res, $next) {
	    $response = $next($req, $res);
	    return $response
	        ->withHeader('Access-Control-Allow-Origin', $this->get('settings')['cors'])
	        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
	        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	});
};
