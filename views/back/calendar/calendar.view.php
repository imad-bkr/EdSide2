<?php ob_start(); ?>
<main>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>