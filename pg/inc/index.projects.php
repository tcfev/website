<hr style="border-right:1px solid #52b69a" class="container-6">

<div class="container-9 m-x-a m-y-10">
    <?php $i = -1;while(++$i < count($projects)) { ?>
    <div class="f-row jcc ais m-b-8" id="p-<?php echo $projects[$i]['ID']; ?>">
        <div class="f-holder-3 f-l-holder-1 dsp-f f-d-col jcb">
            <span class="dsp-b fs-xm"><?php echo $projects[$i]['title']; ?></span>
            <div class="txt-j cl-grey-7 m-y-4 tile-4-3 p-0">
                <?php echo substr($projects[$i]['body'], 0, 250).'...'; ?>
            </div>
            <div class="container dsp-f">
                <a href="project/<?php echo $projects[$i]['ID']; ?>" class="brd-1 brr-2 brd-grey-6 cl-grey-7 p-x-2 p-y-1 m-y-3 pointer more-btn trans-link" kc-color="000000">more -></a>
            </div>
        </div>
        <vr class="bg-grey-2 scroll-effect-expand-y"></vr>
        <div class="tile-3-2 f-l-holder-1 ov-x-s project-gallery">
            <div class="dsp-f w-max p-b-7 p-x-4">
                <?php
                    $pg = $projects[$i]['gallery'];$j = -1;while(++$j < count($pg)) { ?>
                        <img loading="lazy" src="<?php echo root.$pg[$j]['photo']; ?>" alt="" class="h-300x m-x-3 scroll-effect-right">
                    <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<hr style="border-right:1px solid #52b69a" class="container-6">