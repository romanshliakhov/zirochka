<?php function sprite($width , $height, $iconId): void { ?>
    <svg width="<?php echo $width?>" height="<?php echo $height?>">
        <use href="<?php echo BUILD; ?>img/sprite/sprite.svg#<?php echo $iconId?>"></use>
    </svg>
<?php } ?>


