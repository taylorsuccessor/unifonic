<?php use \App\core\tools\Request;?>
<?php include _BASEFILE_.'/default/views/header.php'; ?>



<?php if(!array_key_exists('registerResult',$messageList)) {?>
    <form class="appnitro" id="mainForm" method="post" >

        <ul>


            <li>
                <ul id="loginInputsContainer">


                    <li>
                        <label class="description">First Name </label>
                        <div>
                            <input name="first_name" class="element text medium" type="text" maxlength="255" value="<?= Request::get('first_name') ?>"/>
                       <?php printFieldErrorList('first_name',$messageList);?>
                        </div>
                    </li>
                    <li>
                        <label class="description">Last Name</label>
                        <div>
                            <input name="last_name" class="element text medium" type="test" maxlength="255" value="<?= Request::get('last_name') ?>"/>
                            <?php printFieldErrorList('last_name',$messageList);?>

                        </div>
                    </li>

                    <li>
                        <label class="description">Email </label>
                        <div>
                            <input name="email" class="element text medium" type="email" maxlength="255" value=" <?= Request::get('email') ?>"/>
                            <?php printFieldErrorList('email',$messageList);?>
                        </div>
                    </li>
                    <li>
                        <label class="description">Phone </label>
                        <div>
                            <input name="phone" class="element text medium" type="phone" maxlength="255" value="<?= Request::get('phone') ?>"/>
                            <button id="saveForm"  type="submit" name="submit" value="verify"  >Send SMS to Verify</button>
                            <?php printFieldErrorList('phone',$messageList);?>
                            <?php if(array_key_exists('verifyResult',$messageList) && $messageList['verifyResult']){ ?>
                                <p style="color:green">Success send sms, Please check your phone.</p>
                            <?php }elseif(array_key_exists('verifyResult',$messageList)){ ?>

                                <p style="color:red">Sorry,some thing wrong error happen while sending sms.</p>
        <?php } ?>
                        </div>
                    </li>

                    <li>
                        <label class="description">Verification Code </label>
                        <div>
                            <input name="verification_code" class="element text medium" type="text" maxlength="4" value="<?= Request::get('verification_code') ?>"/>
                            <?php printFieldErrorList('verification_code',$messageList);?>
                        </div>
                    </li>





                </ul>
            </li>







            <li class="buttons">
                <button id="saveForm"  type="submit" name="submit" value="register"  >Register</button>
            </li>
        </ul>
    </form>
<? }else{
    if($messageList['registerResult']){?>

        <p style="color:green">You have registered successfully !!</p>
    <?php }else{ ?>



        <p style="color:red">An error accrued, please try again</p>

<?php } } ?>



<?php include _BASEFILE_.'/default/views/footer.php'; ?>