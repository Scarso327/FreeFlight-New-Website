<div class="content-box">
    <?php
    include(VIEWS . "breadcrumbs.php");
    
    if ($this->categories) {
        foreach($this->categories as $category) {
            ?>
            <section class="forum-section" id="category-<?=$category->id;?>-<?=str_replace(" ", "", $category->title);?>">
                <div class="forum-header">
                    <p><?=$category->title;?></p>
                </div>
                <ol class="forum-content">
                    <?php
                    if ($category->sections) {
                        foreach($category->sections as $section) {
                            ?>
                            <li class="forum-item" id="section-<?=$section->id;?>-<?=str_replace(" ", "", $section->title);?>">
                                <div class="item-section icon">
                                    <span class="icon-circle">
                                        <i class="fa fa-comments"></i>
                                    </span>
                                </div>
                                <div class="item-section main">
                                    <a href="<?=URL;?>forums/forum/<?=$section->id;?>"><h4><?=$section->title;?></h4></a>
                                </div>
                                <div class="item-section stats">
                                    <dl>
                                        <dt><?=$section->topicCount;?></dt>
                                        <dd><?=($section->topicCount == 1) ? "Post" : "Posts";?></dd>
                                    </dl>
                                </div>
                                <div class="item-section last-post">
                                    <?php
                                    $lastTopic = Topics::getLastPost($section->id);

                                    if ($section->topicCount >= 1 && $lastTopic) {
                                        $topicID = $lastTopic->id;
                                        $jump = "";

                                        if ($lastTopic->topic_id != -1) {
                                            $topicID = $lastTopic->topic_id;
                                            $jump = "#".$lastTopic->id;
                                        }
                                        ?>
                                        <div class="last-post-card">
                                            <a href="<?=URL;?>forums/user/<?=$lastTopic->steamID;?>"><img src="<?=$lastTopic->steampfpmed;?>"/></a>
                                            <dl>
                                                <dt><a href="<?=URL;?>forums/forum/<?=$section->id;?>/<?=$topicID;?>/<?=$jump;?>"><?=$lastTopic->title;?></a></dt>
                                                <dd><?=Application::formatTime($lastTopic->posted);?></dd>
                                            </dl>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <p>No posts here yet</p>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </li>
                            <?php
                        }
                    } else {
                        ?>
                        <h4 class="empty-text">No Forums</h4>
                        <?php
                    }
                    ?>
                </ol>
            </section>
            <?php
        }
    }
    ?>
</div>