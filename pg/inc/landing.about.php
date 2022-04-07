<div class="f-row m-t-9 m-b-5" id="about">
    <div class="f-holder-1 bg-white shdw-3 brr-2 karaco-sample-dom">
        <div class="over-menu-holder">
            <span class="fs-l">[[title]]</span>
            <div class="over-menu bg-white over-row top-right">
                <span class="over-item cl-black icon-edit hvr-cl-blue-4 tp" kc-mode="func-btn" kc-id="[[ID]]" kc-func="startAboutTitle">
                    <div class="tt ttop bg-grey-7 brr-5px cl-white">Edit</div>
                </span>
            </div>
        </div>

        <div class="over-menu-holder">
            <p class="txt-j fs-s">
                [[about]]
            </p>
            <div class="over-menu bg-white over-row top-right">
                <span class="over-item cl-black icon-edit hvr-cl-blue-4 tp" kc-mode="func-btn" kc-id="[[ID]]" kc-func="startAboutDescr">
                    <div class="tt ttop bg-grey-7 brr-5px cl-white">Edit</div>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="container-7 m-a popup" id="about-title-dialog" kc-mode="kc-slider">
    <h4 class="cl-grey-8 m-b-4">Edit title</h4>
    <div id="about-title-dialog-holder">
        <div class="karaco-sample-dom m-1" kc-mode="kc-slide" kc-ord="[[Row]]" kc-label="[[lang]]">
            <form kc-mode="form-submit" kc-func="aboutTitle">
                <span>Title - [[lang]]</span></br>
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="t" placeholder="Title - [[lang]]" value="[[title]]">
                <input type="hidden" name="lang" value="[[lang]]">
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

<div class="container-7 m-a popup" id="about-descr-dialog" kc-mode="kc-slider">
    <h4 class="cl-grey-8 m-b-4">Edit about description</h4>
    <div id="about-descr-dialog-holder">
        <div class="karaco-sample-dom m-1" kc-mode="kc-slide" kc-ord="[[Row]]" kc-label="[[lang]]">
            <form kc-mode="form-submit" kc-func="aboutDescr">
                <span>Description - [[lang]]</span></br>
                <div class="editor">
                    <p>[[about]]</p>
                </div>
                <input type="hidden" class="p-1 dsp-b m-a w-100p m-w-100p" name="d" Value="">
                <input type="hidden" name="lang" value="[[lang]]">
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