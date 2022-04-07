
<div class="tile-3-2 ais dsp-f">
    <div class="f-holder-1 bg-white brr-2 shdw-3">
        <div class="f-row aic m-2">
            <h2 class="dsp-ib">Footer Links</h2>
            <span class="bx-btn m-x-4 bg-yellow-4 cl-white tp" kc-mode="func-btn" kc-func="addLink">+<div class="tt ttop bg-grey-7 cl-white">Add</div></span>
        </div>

        <div class="f-row jcb" id="links">
            <div class="f-holder-2 karaco-sample-dom">
                <div class="f-holder-1">
                    <div class="over-menu-holder">
                        <a class="fs-18" href="[[link]]">[[title]]</a>
                        <div class="over-menu over-row top-center-base bg-white brr-1 shdw-3">
                            <span class="over-item hvr-cl-blue-4 tp icon-edit" kc-mode="func-btn" kc-id="[[ID]]" kc-func="startFooterLinkTitle">
                                <div class="tt ttop bg-grey-7 shdw-3 cl-white">Edit text</div>
                            </span>
                            <span class="over-item hvr-cl-blue-4 tp icon-edit" kc-mode="func-btn" kc-id="[[ID]]" kc-func="startFooterLinkAddress">
                                <div class="tt ttop bg-grey-7 shdw-3 cl-white">Edit link address</div>
                            </span>
                            <span class="over-item tp cl-red-3" kc-mode="func-btn" kc-id="[[ID]]" kc-func="deleteFooterLinkDialog">
                                X
                                <div class="tt ttop bg-grey-7 cl-white shdw-3 cl-white">Delete</div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-7 m-a popup" id="link-title-dialog" kc-mode="kc-slider">
    <h4 class="cl-grey-8 m-b-4">Edit link text</h4>
    <div id="link-title-dialog-holder">
        <div class="karaco-sample-dom m-1" kc-mode="kc-slide" kc-ord="[[Row]]" kc-label="[[lang]]">
            <form kc-mode="form-submit" kc-func="linkTitle">
                <span>Title - [[lang]]</span></br>
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="t" placeholder="Text - [[lang]]" value="[[title]]">
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

<div class="container-7 m-a popup" id="link-address-dialog">
    <h4 class="cl-grey-8 m-b-4">Edit link address</h4>
    <div id="link-address-dialog-holder">
        <div class="karaco-sample-dom m-1">
            <form kc-mode="form-submit" kc-func="linkAddress">
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="l" placeholder="link" value="[[link]]">
                <input type="hidden" name="i" value="[[ID]]">
                <button type="submit" class="p-1 m-t-1 m-b-3">Submit</button>
            </form>
        </div>
    </div>
</div>