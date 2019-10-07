<div class="content-box">
    <?php
    include(VIEWS . "breadcrumbs.php");
    ?>
    <section class="forum-section">
        <div class="forum-header topic-header">
            <img src="<?=$this->topic->steampfpmed;?>"/>
            <div class="topic-header-info">
                <h1><?=$this->topic->title;?></h1>
                <p>By <a href="<?=URL;?>forums/user/<?=$this->topic->steamID;?>"><?=$this->topic->steamName;?></a>, <?=Application::formatTime($this->topic->posted);?></p>
            </div>
        </div>
    </section>

    <section class="forum-section">
            <div class="forum-header topic-header reply" id="<?=$this->topic->id;?>">
                <div class="topic-header-info">
                    <p>Topic by <a href="<?=URL;?>forums/user/<?=$this->topic->steamID;?>"><?=$this->topic->steamName;?></a>, <?=Application::formatTime($this->topic->posted);?></p>
                </div>
            </div>
            <div class="topic-content reply">
                <div class="reply-author">
                    <img src="<?=$this->topic->steampfplarge;?>"/>
                    <h4 class="title">Member</h4>
                </div>
                <div class="reply-body">
                    <?=$this->topic->content;?>
                </div>
            </div>
        </section>

    <?php
    foreach($this->topic->replies as $reply) {
        ?>
        <section class="forum-section">
            <div class="forum-header topic-header reply" id="<?=$reply->id;?>">
                <div class="topic-header-info">
                    <p>Reply by <a href="<?=URL;?>forums/user/<?=$reply->steamID;?>"><?=$reply->steamName;?></a>, <?=Application::formatTime($reply->posted);?></p>
                </div>
            </div>
            <div class="topic-content reply">
                <div class="reply-author">
                    <img src="<?=$reply->steampfplarge;?>"/>
                    <h4 class="title">Member</h4>
                </div>
                <div class="reply-body">
                    <?=$reply->content;?>
                </div>
            </div>
        </section>
        <?php
    }
    ?>
</div>