<nav class="nav-bar">
        <a class="nav-element <?php if($curr === "calendar"){echo "current"; } ?>" href="<?= URL ?>calendar">Calendrier</a>
        <a class="nav-element <?php if($curr === "simulator"){echo "current"; } ?>" href="<?= URL ?>simulator">Simulateur</a>
        <a class="nav-element <?php if($curr === "tutoring"){echo "current"; } ?>" href="<?= URL ?>tutoring/browse">Parrainage</a>
</nav>