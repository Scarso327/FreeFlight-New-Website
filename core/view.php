<?php
// Builds our pages
class View {

    public function __construct($files, $data = null) {
        $title = Controller::$currentPage;

        $this->css = null;
        $this->java = null;

        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        echo "
        <html lang='en-GB'>
            <head>
                <title>".$title." - ".SETTING["site-name"]."</title>
                <meta name='Viewport' content='width=device-width, initial-scale=1'>
                <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script>
                <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' integrity='sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf' crossorigin='anonymous'>
                <link rel='stylesheet' href='".URL."css/style.css?v=".time()."' type='text/css' />
                <link rel='stylesheet' href='".URL."css/colours.css?v=".time()."' type='text/css' />
                ";

                if($this->css != null) {
                    foreach ($this->css as $css) {
                        ?>
                        <link rel="stylesheet" href="<?php echo URL; ?>css/<?=$cssPrefix;?><?=$css;?>?v=<?=time();?>" type="text/css" />
                        <?php
                    }
                }

                if($this->java != null) {
                    foreach ($this->java as $java) {
                        ?>
                        <script src='<?=$java;?>'></script>
                        <?php
                    }
                }

            echo "
            </head>
            <body>
            ";
                if(is_array($files) && (count($files) > 0)) {
                    foreach($files as $filename) { 
                        if(file_exists($filename . '.php')) {
                            require $filename . '.php';
                        } else {
                            echo $filename;
                        }
                    }
                } else {
                    $filename = $files;
                    if(file_exists($filename . '.php')) {
                        require $filename . '.php';
                    } else {
                        echo $filename;
                    }
                }
            echo "
            </body>
        </html>
        ";
    }

    public static function ButtonActive($page) {
        if(Controller::$currentPage == $page || Controller::$subPage == $page) {
            return "active";
        }
    }
}
?>