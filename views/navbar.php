<nav class="main-nav">
    <div class="nav-content container">
        <div class="site-logo">
            <img src="<?=URL;?>img/logo-noname-white.png"/>
        </div>
        <a class="nav-item active" href="">
            Home
        </a>
        <a class="nav-item" href="">
            Community
        </a>

        <?php
        if (Account::isLoggedIn()) {
            ?>
            <a class="nav-profile" href="">
                <img src="<?=Session::get("steaminfo")["steam-pfp-full"];?>" alt="PFP"/>
                <span><?=Session::get("steaminfo")["steam-name"];?></span>
            </a>
            <a class="nav-item" href="<?=URL;?>?logout">
                <span class="fas fa-sign-out-alt"></span> 
            </a>
            <?php
        } else {
            ?>
            <a class="nav-item right" href="<?=URL;?>login">
                Login <span class="fas fa-sign-in-alt"></span> 
            </a>
            <?php
        }
        ?>
    </div>
</nav>