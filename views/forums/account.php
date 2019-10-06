<header>
    <div class="user-header">
        <img class="banner" src="<?=URL;?>img/placeholder.jpg" style="top: -200px;"/>
        <div class="user-info container">
            <img src="<?=$this->member->steampfplarge;?>" alt="PFP"/>
            <div class="name-block">
                <h3><?=$this->member->steamName;?></h3>
                <span>Member</span>
            </div>
        </div>
    </div>
    <div class="header-content">
        <ul class="user-stats container">
            <li><h4>Member Since</h4><?=date("d/m/Y", strtotime($this->member->joined));?></li>
            <li><h4>Last Login</h4><?=Application::formatTime($this->member->last_login);?></li>
        </ul>
    </div>
</header>
<section class="center container">
    <h2>Looking empty?</h2>
</section>