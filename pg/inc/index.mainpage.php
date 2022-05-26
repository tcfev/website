<div class="container h-100v main-bg light jcb dsp-f f-d-col p-b-7">
    <?php include_once phproot.'pg/inc/menu.php' ?>
    <div class="f-row">
        <div class="tile-3-2 p-x-5" id="tcf_typo">
            <!-- <img class="tcf-main" style="display:inherit" src="<?php echo root; ?>content/img/tcf_typog.svg" alt=""> -->
        </div>
        <div class="f-holder-3 p-0">
            <canvas id="canvas">

            </canvas>
        </div>
    </div>
    <div class="f-row jca dsp-f">
        <?php $i = -1;while (++$i < 3 && $i < count($projects)) {
        ?>
        <a href="#p-<?php echo $projects[$i]['ID']; ?>" class="cl-white hvr-cl-black project-link"><?php echo $projects[$i]['title']; ?></a>
        <?php } ?>
    </div>
</div>