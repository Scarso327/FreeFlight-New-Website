<nav class="main-nav">
    <div class="nav-content container">
        <div class="site-logo">
            <img src="<?=URL;?>img/logo-noname-white.png"/>
        </div>
        <div class="nav-buttons">
            <a class="nav-item<?php if (View::ButtonActive("Home")) { echo ' active'; } ?>" href="<?=URL;?>">
                Home
            </a>
            <a class="nav-item<?php if (View::ButtonActive("Forums")) { echo ' active'; } ?>" href="<?=URL;?>forums/">
                Community
            </a>
        </div>
        <?php
        if (Account::isLoggedIn()) {
            ?>
            <div class = "nav-item<?php if (View::ButtonActive(Session::get("steaminfo")["steam-name"])) { echo ' active'; } ?> dropdown">
                <a class="nav-profile" href="">
                    <img src="<?=Session::get("steaminfo")["steam-pfp-medium"];?>" alt="PFP"/>
                    <span><?=Session::get("steaminfo")["steam-name"];?> <span class="fas fa-caret-down"></span></span>
                </a>
                <div class="dropdown-content">
                    <a href="<?=URL;?>forums/user/<?=Session::get("steamid");?>">
                        Profile
                    </a>
                    <a href="<?=URL;?>?logout">
                        Logout
                    </a>
                </div>
            </div>
            <?php
        } else {
            ?>
            <a class="nav-item" href="<?=URL;?>login">
                Login <span class="fas fa-sign-in-alt"></span> 
            </a>
            <?php
        }
        ?>
    </div>
</nav>