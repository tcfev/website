<div id="borders" class="container h-100p aic ov-a f-d-col" style="display:flex">
    <div class="f-row p-x-9 p-y-2 p-s-6">
        <select name="lang" id="" class="p-x-2 p-y-1" onchange="changeURL.call(this);">
            <option value="en" <?php echo $langs['ind'][$l]['selected']['en'];?>>En</option>
            <option value="de" <?php echo $langs['ind'][$l]['selected']['de'];?>>De</option>
            <option value="ar" <?php echo $langs['ind'][$l]['selected']['ar'];?>>Ar</option>
            <option value="fa" <?php echo $langs['ind'][$l]['selected']['fa'];?>>Fa</option>
            <option value="ku" <?php echo $langs['ind'][$l]['selected']['ku'];?>>Ku</option>
        </select>
    </div>
    <div class="f-row p-8 p-s-1 p-m-2 m-m-3 m-s-2 m-8">
        <div class="tile-3-2" id="texts">
            <h1 class="fs-xl fs-s-l">
				<?php echo $simple['title']; ?>
            </h1>
            <div class="p-4 txt-j cl-grey-7">
                <?php echo $simple['about']; ?>
            </div>
        </div>
        <div class="f-holder-3 f-l-holder-3 dsp-f aic jcc">
            <div class="fade-circle" id="fade-circle"></div>
            <button id="fade" class="p-x-3 p-y-2 pointer cl-white bg-black brd-0"><?php echo $langs['ind'][$l]['read_more']; ?></button>
        </div>
    </div>
</div>
