<?php /**
 *
 */
class register extends Controller
{

  function __construct()
  {
    //call parent constructor
    Parent::__construct();
    //$this->view->msg = "we have arrived";
    $this->view->render('register');
  }

  public function register_model(){
    //include regiater model
    require "models/register_model.php";
  }
}
 ?>
