<?php

  //start session
  session_start();

  //$_SESSION['token'] = "";
  if(isset($_SESSION['token'])){
  $token = $_SESSION['token'];
  }else{
  $token = '';
  }

 /**
 *Handels all get requests
 */
class RequestHandler
{

  function __construct()
  {
    // code...
    //get request uri (get)
    if(isset($_GET['uri'])){
      $uri = $_GET['uri'];
      //trim all / in front
      $uri = rtrim($uri, '/');
      //check if there is / in the $uri
      if(strpos($uri, '/') !== false){
        $uri = explode('/', $uri);
      }else{
        //convert the full uri into array
        $uri = [$uri];
      }

    }else{
      $uri = ['index'];
    }
      //print_r($uri);

      global $token;
      //offline uri register
      if($token == '' && $uri[0] != 'login'){
        $uri[0] = 'login';
        //online uri login
      }else if($token != '' && $uri[0] == 'login'){
        $uri[0] = 'index';
        //online
      }else if($token != ''){
        $uri[0] = $uri[0];
      }
      
      $file = "controllers/".$uri[0].".php";


      //check if file exists
      if(file_exists($file)){
        //require matched file (controller)
        require $file;
        $controller = new $uri[0];

        //check if there is a second element
        if(isset($uri[1])){
          //check if it is a valid method
          if(method_exists($controller, $uri[1])){

            $controller->{$uri[1]}();
          }
        }
      }else{
        //require error file (controller)
        require "controllers/error.php";
      }

  }
}
 ?>
