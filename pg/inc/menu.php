<nav class="f-row menu">
    <ul class="dsp-f m-b-6 aic jcb p-x-5 jcb-s fs-s-s w-100p">
        <li class="f-holder-2 dsp-f jcl jcc-s p-x-0"><a href="<?php echo root.$l; ?>/"><img class="w-30x" src="<?php echo root; ?>content/img/tcf_light.svg" alt=""></a></li>
        <li><a href="<?php echo root.$l ?>/#members">About us</a></li>
        <li><a href="#">Membership</a></li>
        <li><a href="#">Forms</a></li>
        <li class="f-s-holder-1 dsp-f jcl jcc-s">
            <select name="lang" id="lang" class="p-x-2 p-y-1" onchange="changeURL.call(this);">
                <option value="en" <?php echo $langs['ind'][$l]['selected']['en'];?>>En</option>
                <option value="de" <?php echo $langs['ind'][$l]['selected']['de'];?>>De</option>
                <option value="ar" <?php echo $langs['ind'][$l]['selected']['ar'];?>>Ar</option>
                <option value="fa" <?php echo $langs['ind'][$l]['selected']['fa'];?>>Fa</option>
                <option value="ku" <?php echo $langs['ind'][$l]['selected']['ku'];?>>Ku</option>
            </select>
        </li>
    </ul>
</nav>