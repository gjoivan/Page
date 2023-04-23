<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="home">Home</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-brand" style="float: right;">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" onclick="user_log_out();">Sign out</a>
    </div>
  </div>
</header>



<!-- <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div style="text-align: center;">
            <h1>Градба Уникат</h1>
        </div>
    </div>
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="#menu-toggle" class="navbar-toggle" id="menu-toggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="navbar-brand" href="/bo"><img style="height:50px;width:50px;" src="renovation-logo.jpg" /></a>
        </div>
        <div id="navbar">
            <ul class="nav navbar-nav navbar-right"> 
                <li style="position:relative;">
                <li><form action="./index.php" method="post"><input value="Logout" type="submit" class="btn btn-xs"/><input type="hidden" name="logout" value="logout" /></form></li>
            </ul>
        </div>
    </div>
    <?php if(!empty($_SESSION['message'])) { echo $_SESSION['message'];} else{ echo 'You are logged out';} ?>
</div>
</nav>
<div class="header">
    <div class="container">
        <div style="text-align: center;">
            <h1>Gradba Unikat</h1>
        </div>
    </div>
    <header>
        <div style="float: right; padding: 15px">
            <a href="?route=home">Home</a>
            <?php
             if(!empty($_SESSION['login'])){?>
                <a href="?route=contact">Contact</a>
             <?php } ?>
        </div>
    </header>
    <?php if(!empty($_SESSION['message'])) { echo $_SESSION['message'];} else{ echo 'You are logged out';} ?>
</div> -->