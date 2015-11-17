<nav id="myNavbar" class="navbar navbar-default navbar-fixed-top" role="navigation">
     <!-- Brand and toggle get grouped for better mobile display -->
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class='navbar-header'>
        <h3 class="navbar-text navbar-left">Welcome <?= $this->session->userdata('user_name')?>  </h3>

        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbarCollapse">

            <form class="navbar-form navbar-right" action='/users/logout' method='post'>

            <button type="submit" class="btn btn-success">Logout</button>

<?php 
        if($home == 0)
        {
            echo "<a href='/friends' class='navbar-text' class='navbar-home'>Home</a>";
        }
 ?>               
            </form>

        </div>
    </div>

  </nav>