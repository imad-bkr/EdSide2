<?php ob_start(); ?>
<main class="simulator-main">
    <div class="coming-soon">
        Coming soon
    </div>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>