<?php
    ob_start();
    include($_SERVER['DOCUMENT_ROOT'].'/assembly/includes/db_connect.php');
?>
<header id='header'>
<nav class="navbar navbar-default" class='navbar-custom'>
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
      <a class="navbar-brand" href="//localhost/assembly/index"><img src="//localhost/assembly/img/logo.png"></a>
       <a href="//localhost/assembly/index" class="navbar-brand" id="brandText">
            <h3 style="font-size: 16px; margin-top: 5px; "><b>Assembly Q & A</b></h3>
        </a>
    </div>
    <div  class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right" id='navBar'>
         <li><a href="//localhost/assembly/index">Admin Login</a></li>
         <li><a href="//localhost/assembly/department-login">Department Login</a></li>        
      </ul>
    </div>
  </div>
</nav>
</header>
