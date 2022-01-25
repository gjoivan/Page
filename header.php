 <div class="header">
    <h1>Header</h1>
    <header>
        <ol>
            <li><a href="?route=home">Home</a></li>
            <li><a href="?route=login">Login</a></li>
            <?php
             if(!empty($_SESSION['logged_in'])){?>
             <li><a href="?route=contact">Contact</a></li>
             <?php } 
             if(empty($_SESSION['logged_in'])){?>
             <li><a href="?route=register">Register</a></li>
             <?php } ?>
            <?php 
                if(!empty($_SESSION['logged_in'])) {?>
                    <li>
                         <form method="POST">
                             <input type='hidden' name='logout' value='1'/>
                             <button href="./home">Logout</button>
                         </form>
                    </li>
            <?php } ?>
        </ol>
    </header>
    <?php if(!empty($message)) { echo $message;} ?>
</div>