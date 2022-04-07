<div class="f-holder-2 ais dsp-f">
    <div class="f-holder-1 bg-white jca shdw-3 brr-2" id="address">
        <div class="f-holder-1">
            <div class="f-row aic">
                <h2 class="dsp-ib m-r-3">Phone number</h2>
                <span class="bx-btn bg-yellow-4 cl-white tp" kc-mode="func-btn" kc-func="addPhone">+<div class="tt ttop bg-grey-7 cl-white">Add</div></span>
            </div>
            <div id="phone-holder">
                <div class="over-menu-holder m-t-5 karaco-sample-dom">
                    <span>[[value]]</span>
                    <div class="over-menu over-row bg-white brr-1 top-right-base">
                        <span class="over-item icon-edit tp" kc-mode="func-btn" kc-func="startPhone" kc-id="[[ID]]">
                            <div class="tt ttop bg-grey-7 cl-white">Edit</div>
                        </span>
                        <span class="over-item tp cl-red-3" kc-mode="func-btn" kc-id="[[ID]]" kc-func="deletePhoneDialog">
                            X
                            <div class="tt ttop bg-grey-7 cl-white shdw-3 cl-white">Delete</div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-7 m-a popup" id="phone-dialog">
    <h4 class="cl-grey-8 m-b-4">Edit phone number</h4>
    <div id="phone-dialog-holder">
        <div class="m-1">
            <form kc-mode="form-submit" kc-func="phone">
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="p" placeholder="number" value=""]>
                <input type="hidden" name="i" value="">
                <button type="submit" class="p-1 m-t-1 m-b-3">Submit</button>
            </form>
        </div>
    </div>
</div>