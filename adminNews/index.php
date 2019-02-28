<?php

    include "model/news.php";
    include "model/image.php";

    $ctrl = "news";

    if(isset($_GET["ctrl"])){
        $ctrl = $_GET["ctrl"];
    }

    include "view/header.php";
    include "view/menu.php";
    include "ctrl/".$ctrl.".php";
    include "view/footer.php";

?>