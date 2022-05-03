<div class="container-7 m-x-a p-y-7 p-x-4" id="members">
    <div class="f-row m-b-6">
        <div class="txt-j cl-light">
            <?php echo $aboutInfo['about_us']; ?>
        </div>
    </div>
    <div class="f-row">
        <?php $i = 0; while ($i < count($members)) { ?>
        <div class="f-holder-1 dsp-f scroll-effect-left">
            <img class="f-holder-2" src="<?php echo root.$members[$i]['avatar']; ?>" alt="" srcset="">
            <div class="f-holder-2">
                <span class="fs-xm m-t-3"><?php echo $members[$i]['Name']; ?></span>
                <div class="txt-j m-y-2 cl-grey-1">
                    <?php echo $members[$i]['info']; ?>
                </div>
                <a class="cl-bright-blue-3" href="<?php echo $members[$i]['link']; ?>">website</a>
            </div>
        </div>
        <?php if (isset($members[$i + 1])) { ?>
        <div class="f-holder-1 dsp-f scroll-effect-right">
            <div class="f-holder-2">
                <span class="fs-xm m-t-3"><?php echo $members[$i + 1]['Name']; ?></span>
                <div class="txt-j m-y-2 cl-grey-1">
                    <?php echo $members[$i + 1]['info']; ?>
                </div>
                <a class="cl-bright-blue-3" href="<?php echo $members[$i + 1]['link']; ?>">website</a>
            </div>
            <img class="f-holder-2 m-s-2 m-t-n5" src="<?php echo root.$members[$i]['avatar']; ?>" alt="" srcset="">
        </div>
        <?php }$i += 2;} ?>
    </div>
</div>