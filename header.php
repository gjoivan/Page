 <div class="header">
    <h1>Header</h1>
    <header>
        <ol>
            <li><a href="./home">Home</a></li>
            <li><a href="./login">Login</a></li>
            <?php
             if(!empty($_SESSION['logged_in'])){?>
             <li><a href="./contact">Contact</a></li>
             <?php } 
             if(empty($_SESSION['logged_in'])){?>
             <li><a href="./register">Register</a></li>
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