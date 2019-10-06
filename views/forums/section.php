<div class="content-box">
    <?php
    include(VIEWS . "breadcrumbs.php");
    ?>
    <section class="forum-section">
        <div class="forum-header">
            <p><?=$this->section->title;?></p>
        </div>
        <ol class="forum-content">
            <?php
            if ($this->topics) {
                foreach($this->topics as $topic) {
                    ?>
                    <li class="forum-item">
                        <div class="item-section main">
                            <a href="<?=URL;?>forums/forum/<?=$this->section->id;?>/<?=$topic->id;?>"><h4><?=$topic->title;?></h4></a>
                        </div>
                    </li>
                    <?php
                }
            }
            ?>
        </ol>
    </section>
</div>