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
        <div class="topic-content">
            <?=$this->topic->content;?>
        </div>
    </section>
</div>