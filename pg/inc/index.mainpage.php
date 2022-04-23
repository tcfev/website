<div class="container h-100v main-bg light jcb dsp-f p-b-7">
    <?php include_once phproot.'pg/inc/menu.php' ?>
    <div class="f-row">
        <div class="tile-3-2 p-x-5">
            <img class="w-90p" style="display:inherit" src="<?php echo root; ?>content/img/tcf_typog.svg" alt="">
        </div>
    </div>
    <div class="f-row jca dsp-f">
        <?php $i = -1;while (++$i < 3 && $i < count($projects)) {
        ?>
        <a href="#p-<?php echo $projects[$i]['ID']; ?>" class="cl-white hvr-cl-black"><?php echo $projects[$i]['title']; ?></a>
        <?php } ?>
    </div>
</div>