<div class="flex-grid container">
    <?php
    if ($this->pageInfo["body"]) {
        ?>
        <div class="flex-item main-body">
            <?php
            View::includeFiles($this->pageInfo["body"]);
            ?>
        </div>
        <?php
    }

    if ($this->pageInfo["sidebar"]) {
        ?>
        <div class="flex-item side-bar">
            <?php
            View::includeFiles($this->pageInfo["sidebar"]);
            ?>
        </div>
        <?php
    }
    ?>
</div>