<div class="container-7 m-a popup" id="member-avatar-dialog">
    <form kc-mode="form-submit" kc-func="submitMemberAvatar">
        <h4 class="cl-grey-8 m-b-4">Image file - 1:1</h4>
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

<div class="container-7 m-a popup" id="member-name-dialog" kc-mode="kc-slider">
    <h4 class="cl-grey-8 m-b-4">Edit member name</h4>
    <div id="member-name-dialog-holder">
        <div class="karaco-sample-dom m-1" kc-mode="kc-slide" kc-ord="[[Row]]" kc-label="[[lang]]">
            <form kc-mode="form-submit" kc-func="memberName">
                <span>Name - [[lang]]</span></br>
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="n" placeholder="Firstname - [[lang]]" value="[[first_name]]">
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="l" placeholder="Lastname - [[lang]]" value="[[last_name]]">
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

<div class="container-7 m-a popup" id="member-link-dialog">
    <h4 class="cl-grey-8 m-b-4">Edit link</h4>
    <div id="member-link-dialog-holder">
        <div class="karaco-sample-dom m-1">
            <form kc-mode="form-submit" kc-func="memberLink">
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="l" placeholder="link" value="[[link]]">
                <input type="hidden" name="i" value="[[ID]]">
                <button type="submit" class="p-1 m-t-1 m-b-3">Submit</button>
            </form>
        </div>
    </div>
</div>

<div class="container-7 m-a popup" id="member-email-dialog">
    <h4 class="cl-grey-8 m-b-4">Edit email</h4>
    <div id="member-email-dialog-holder">
        <div class="karaco-sample-dom m-1">
            <form kc-mode="form-submit" kc-func="memberEmail">
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="e" placeholder="email" value="[[email]]">
                <input type="hidden" name="i" value="[[ID]]">
                <button type="submit" class="p-1 m-t-1 m-b-3">Submit</button>
            </form>
        </div>
    </div>
</div>

<div class="container-7 m-a popup" id="member-post-dialog" kc-mode="kc-slider">
    <h4 class="cl-grey-8 m-b-4">Edit member post</h4>
    <div id="member-post-dialog-holder">
        <div class="karaco-sample-dom m-1" kc-mode="kc-slide" kc-ord="[[Row]]" kc-label="[[lang]]">
            <form kc-mode="form-submit" kc-func="memberPost">
                <span>Post - [[lang]]</span></br>
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="p" placeholder="Post - [[lang]]" value="[[post]]">
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

<div class="container-7 m-a popup" id="member-info-dialog" kc-mode="kc-slider">
    <h4 class="cl-grey-8 m-b-4">Edit member info</h4>
    <div id="member-info-dialog-holder">
        <div class="karaco-sample-dom m-1" kc-mode="kc-slide" kc-ord="[[Row]]" kc-label="[[lang]]">
            <form kc-mode="form-submit" kc-func="memberInfo">
                <span>Info - [[lang]]</span></br>
                <input type="text" class="p-1 dsp-b m-a w-100p m-w-100p" name="inf" placeholder="Info - [[lang]]" value="[[info]]">
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