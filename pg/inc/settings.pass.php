<div class="f-holder-3 ais dsp-f">
    <div class="f-holder-1 bg-white jca shdw-3 brr-2" id="pass">
        <div class="f-holder-1">
            <img class="m-x-2 va-sub w-20x" src="<?php echo root;?>content/img/lock.svg" alt="">
            <span class="fs-m">Change password</span>
            <form class="m-t-4" kc-mode="form-submit" kc-func="changePass">
                <label class="m-y-2 fs-s" for="cur-pwd">Currnet password</label>
                <div class="password m-b-3"><input class="p-1" required type="password" name="cur-pwd" id="cur-pwd"><span class="show icon-eye hvr-cl-blue-3"></span></div>

                <label class="m-y-2 fs-s" for="new-pwd">New password</label>
                <div class="password m-b-3"><input class="p-1" required type="password" name="new-pwd" id="new-pwd"><span class="show icon-eye hvr-cl-blue-3"></span></div>

                <label class="m-y-2 fs-s" for="renew-pwd">Repeat new password</label>
                <div class="password m-b-3"><input class="p-1" required type="password" name="renew-pwd" id="renew-pwd"><span class="show icon-eye hvr-cl-blue-3"></span></div>

                <button class="m-y-2 p-x-2 p-y-1" type="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
</div>