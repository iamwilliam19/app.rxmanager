<?php /**
 *
 */
class View
{

  function __construct()
  {
    // code...

  }

  public function render($name){
    require "inc/header.php";
    if($name != 'login'){
      require "inc/headLayout.php";
    }
    require "views/".$name.".php";
    if($name != 'login'){
      require "inc/footLayout.php";
    }
    require "inc/footer.php";
  }



}
 ?>
