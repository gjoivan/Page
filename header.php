
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
             <?php }
            if(!empty($_SESSION['login'])) {?>
                <form method="POST">
                    <input type='hidden' name='logout' value='1'/>
                    <button href="./home">Logout</button>
                </form>
            <?php } else{ ?>
                <a href="?route=login">Login</a>
            <?php }?>
        </div>
    </header>
    <?php if(!empty($_SESSION['message'])) { echo $_SESSION['message'];} else{ echo 'You are logged out';} ?>
</div>