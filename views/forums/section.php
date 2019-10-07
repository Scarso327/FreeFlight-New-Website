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
                        <div class="item-section main section">
                            <dl>
                                <dt><a href="<?=URL;?>forums/forum/<?=$this->section->id;?>/<?=$topic->tID;?>"><h4><?=$topic->title;?></h4></a></dt>
                                <dd>By <a href="<?=URL;?>forums/user/<?=$topic->steamID;?>"><?=$topic->steamName?></a>, <?=Application::formatTime($topic->posted);?></dd>
                            </dl>
                        </div>
                        <div class="item-section stats">
                            <dl>
                                <dt><?=$topic->replyCount;?> <?=($topic->replyCount == 1) ? "Reply" : "Replies";?></dt>
                                <dd>0 Views</dd>
                            </dl>
                        </div>
                        <div class="item-section last-post">
                            <?php
                            $lastReply = Topics::getLastReply($topic->tID);

                            if ($topic->replyCount >= 1 && $lastReply) {
                                ?>
                                <div class="last-post-card">
                                    <a href="<?=URL;?>forums/user/<?=$lastReply->steamID;?>"><img src="<?=$lastReply->steampfpmed;?>"/></a>
                                    <dl>
                                        <dt><a href="<?=URL;?>forums/user/<?=$lastReply->steamID;?>"><?=$lastReply->steamName;?></a></dt>
                                        <dd><a href="<?=URL;?>forums/forum/<?=$this->section->id;?>/<?=$topic->tID;?>/#<?=$lastReply->id;?>"><?=Application::formatTime($lastReply->posted);?></a></dd>
                                    </dl>
                                </div>
                                <?php
                            } else {
                                ?>
                                <p>No replies yet</p>
                                <?php
                            }
                            ?>
                        </div>
                    </li>
                    <?php
                }
            }
            ?>
        </ol>
    </section>
</div>