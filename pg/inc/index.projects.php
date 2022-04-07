<hr style="border-right:1px solid #52b69a" class="container-6">

<div class="container-9 m-x-a m-y-10">
    <?php $i = -1;while(++$i < count($projects)) { ?>
    <div class="f-row jcc ais m-b-8" id="p-<?php echo $projects[$i]['ID']; ?>">
        <div class="f-holder-3 dsp-f f-d-col jcb">
            <span class="dsp-b fs-xm"><?php echo $projects[$i]['title']; ?></span>
            <div class="txt-j cl-grey-7 m-y-4 tile-4-3 p-0">
                <?php echo substr($projects[$i]['body'], 0, 250).'...'; ?>
            </div>
            <div class="container dsp-f">
                <a href="project/<?php echo $projects[$i]['ID']; ?>" class="brd-1 brd-grey-6 cl-grey-7 p-x-2 p-y-1 m-y-3 pointer more-btn trans-link" kc-color="000000">more -></a>
            </div>
        </div>
        <vr class="bg-grey-2 scroll-effect-expand-y"></vr>
        <div class="tile-3-2 ov-x-s project-gallery">
            <div class="dsp-f w-max p-b-7 p-x-4">
                <img loading="lazy" src="https://source.unsplash.com/random?sig=<?php echo $projects[$i]['ID']; ?>1" alt="" class="h-300x m-x-3 scroll-effect-right">
                <img loading="lazy" src="https://source.unsplash.com/random?sig=<?php echo $projects[$i]['ID']; ?>2" alt="" class="h-300x m-x-3 scroll-effect-right">
                <img loading="lazy" src="https://source.unsplash.com/random?sig=<?php echo $projects[$i]['ID']; ?>3" alt="" class="h-300x m-x-3 scroll-effect-right">
                <img loading="lazy" src="https://source.unsplash.com/random?sig=<?php echo $projects[$i]['ID']; ?>4" alt="" class="h-300x m-x-3 scroll-effect-right">
                <img loading="lazy" src="https://source.unsplash.com/random?sig=<?php echo $projects[$i]['ID']; ?>5" alt="" class="h-300x m-x-3 scroll-effect-right">
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<hr style="border-right:1px solid #52b69a" class="container-6">