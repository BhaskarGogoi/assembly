<?php
    ob_start();
    include($_SERVER['DOCUMENT_ROOT'].'/assembly/assembly-dashboard/includes/db_connect.php');
    mysqli_set_charset($conn, 'utf8');
?>
<header id='header'>
<nav class="navbar navbar-default navbar-static" class='navbar-custom'>
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
         <li><a href="//localhost/assembly/department-dashboard/">Dashboard</a></li>
         <li><a href="//localhost/assembly/assembly-dashboard/members">Assembly Members</a></li>
        <?php
            if(isset($_SESSION['email'])) {
                echo"
                <li>
                    <div class='nav-logout-button'>
                        <form action='//localhost/assembly/assembly-dashboard/includes/logout.inc.php' method='POST'>
                            <button type='submit' name='submit'><i class='fas fa-sign-out-alt'></i> Logout</button>
                        </form>
                    </div> 
                </li>";} 
                elseif(isset($_SESSION['department_username'])) {
                echo"
                <li class='dropdown'>
                    <a href='#'' class='dropdown-toggle' data-toggle = 'dropdown'>Complaint <b class='caret'></b></a>
                    <ul class='dropdown-menu'>
                        <li><a href='//localhost/assembly/department-dashboard/register-complaint'>Register Complaint</a></li>
                        <li><a href='//localhost/assembly/department-dashboard/my-complaints'>My Complaints</a></li>
                    </ul>
                </li>
               <li><a href='//localhost/assembly/department-dashboard/account'><i class='fas fa-user'></i> $_SESSION[department_username]</a></li>
                <li>
                    <div class='nav-logout-button'>
                        <form action='//localhost/assembly/department-dashboard/includes/logout.inc.php' method='POST'>
                            <button type='submit' name='submit'><i class='fas fa-sign-out-alt'></i> Logout</button>
                        </form>
                    </div> 
                </li>";}
        ?>   
        
      </ul>
    </div>
  </div>
</nav>
</header>
