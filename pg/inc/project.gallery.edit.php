<div class="container-7 m-a popup" id="project-image-dialog">
    <form kc-mode="form-submit" kc-func="submitProjectImage">
        <h4 class="cl-grey-8 m-b-4">Choose image file - 3:2</h4>
        <div class="fake-input rounded">
            <div class="fake">
                <input type="text" class="label" placeholder="choose a file...">
                <button type="button" class="bg-green-3 hvr-bg-green-2 cl-white">Browse</button>
                <input type="file" class="fake-file" name="file">
            </div>
        </div>
        <input type="hidden" name="i" value="">
        <button type="submit" class="p-1 m-t-5">Upload</button>
    </form>
</div>

<div class="container-7 m-a popup" id="project-image-title-dialog" kc-mode="kc-slider">
    <h4 class="cl-grey-8 m-b-4">Edit photo title</h4>
    <div id="project-image-title-dialog-holder">
        <div class="karaco-sample-dom m-1" kc-mode="kc-slide" kc-ord="[[Row]]" kc-label="[[lang]]">
            <form kc-mode="form-submit" kc-func="projectImageTitle">
                <span>Title - [[lang]]</span></br>
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="t" placeholder="Title - [[lang]]" value="[[title]]">
                <input type="hidden" name="i" value="[[ID]]">
                <button type="submit" class="p-1 m-t-1 m-b-3">Submit</button>
            </form>
        </div>
    </div>
    <div class="txt-c f-row jcc">
        <span class="bx-btn bg-white cl-blue-6 m-1" kc-mode="kc-slider-prev"><</span>
        <span class="bx-btn cl-white bg-blue-6 m-1" kc-mode="kc-slider-label">0</span>
        <span class="bx-btn bg-white cl-blue-6 m-1" kc-mode="kc-slider-next">></span>
    </div>
</div>