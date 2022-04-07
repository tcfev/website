<div class="f-row">
    <select class="p-2 w-100x m-x-2" name="lang-select" id="top-lang-select" onchange="changeLang.call(this);">
        <option value="en" <?php echo $langs['ind'][$lang]['selected']['en'];?>>English</option>
        <option value="de" <?php echo $langs['ind'][$lang]['selected']['de'];?>>Deutsch</option>
        <option value="fa" <?php echo $langs['ind'][$lang]['selected']['fa'];?>>Farsi</option>
        <option value="ku" <?php echo $langs['ind'][$lang]['selected']['ku'];?>>Kurdish</option>
        <option value="ar" <?php echo $langs['ind'][$lang]['selected']['ar'];?>>Arabic</option>
    </select>
</div>