<nav class="navbar navbar-default navbar-fixed-top">
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
            <!-- <a class="navbar-brand" href="/bo"><img style="height:50px;width:50px;" src="renovation-logo.jpg" /></a> -->
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
</div>