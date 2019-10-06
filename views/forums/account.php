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
            <li><h4>Last Visit</h4><?=Application::formatTime($this->member->last_visit);?></li>
        </ul>
    </div>
</header>
<section class="flex-grid container">
    <div class="flex-item main-body">
        <div class="content-box">
            <h4>Activity</h4>
            <?php
            if ($this->activity) {
                foreach($this->activity as $activity) {
                    ?>
                    <div class="activity-card">
                        <img src="<?=$activity->steampfpmed;?>"/>
                        <div class="activity-info">
                            <a href="<?=URL;?>forums/forum/<?=$activity->sID;?>/<?=$activity->id;?>"><h1><?=$activity->title;?></h1></a>
                            <p><a href="<?=URL;?>forums/user/<?=$activity->steamID;?>"><?=$activity->steamName;?></a> posted a topic in <a href="<?=URL;?>forums/forum/<?=$activity->sID;?>"><?=$activity->sTitle;?></a>, <?=Application::formatTime($activity->posted);?></p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <p>It would appear this user has not interacted with the site...</p>
                <?php
            }
            ?>
        </div>
    </div>
</section>