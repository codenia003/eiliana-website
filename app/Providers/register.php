<?php
/* * ***************************************************
 * � copyright 1999 - 2020 iDateMedia, LLC
 *
 * All materials and software are copyrighted by Interactive Arts Ltd.
 * under US, British and International copyright law. All rights reserved.
 * No part of this code may be reproduced, sold, distributed
 * or otherwise used in whole or in part without prior written permission.
 *
 * *************************************************** */
######################################################################
#
# Name:                 register.php
#
# Description:  member registration form
#
# Version:               7.5
#
######################################################################
require_once ( 'db_connect.php' );
require_once ( 'pop_lists.inc' );
require_once ( 'functions.php' );
require_once ( __INCLUDE_CLASS_PATH . '/securityImageClass.php' );
include_once 'validation_functions.php';

$si = new securityImage();
$rows = ($option_manager->GetValue('skype')) ? 12 : 10;

//Upload Standart Image
if (isset($_POST['avat'])) {
    $avatar_id = sanitizeData(trim($_POST['avat']), 'xss_clean');
} elseif (isset($_SESSION['post']['avatar'])) {
    $avatar_id = $_SESSION['post']['avatar'];
}
$usersex="";
if(isset($_POST['usersex']))
{
    $usersex=sanitizeData(trim($_POST['usersex']), 'xss_clean');  
    $username= isset($_REQUEST['username']) ? sanitizeData(trim($_POST['username']), 'xss_clean') : "";  
}
//*Upload Standart Image
# retrieve the template
$area = 'guest';
?>

<?= $skin->ShowHeader($area) ?>
<script>
pintrk('track', 'signup');
</script>

<script>/*lead event*/
function pinlead() {
if ((/sailors-social-network.com\/register.php/.test(location.host + location.pathname) == true) && document.querySelectorAll('.button')) {
var leadbutton = document.querySelectorAll('.button');
for (var i = 0; i < leadbutton.length; i++) {
leadbutton[i].addEventListener('click', function () {
pintrk('track', 'lead',{
np: 'generator',
})})}}}
document.readyState == 'complete' ? pinlead() : window.addEventListener('load', pinlead);
</script>
<script src='https://www.google.com/recaptcha/api.js' async defer></script>

<?php if ($CONST_AVATARS_GALLERY == "Y") { ?>
    <form action="<?php echo $CONST_LINK_ROOT ?>/register.php" name="gallery" method="post">
        <input type="hidden" name="avat" id="avat" value="">
    </form>
    <?php }
?>
<style>
    @media only screen and (max-width:620px) {
    .cplpaddingtop{
padding-top:5px;        
}
    }
</style>
<div class="col-xs-12 col-sm-12 col-md-12 pageheader joinmb"> <?php echo REGISTER_SECTION_NAME ?></div>    


<script language=javascript>
    country = getCookie('lstCountry');
    state = getCookie('lstState');
    city = getCookie('lstCity');
</script>

<form method="post" enctype='multipart/form-data' action="<?php echo $CONST_LINK_ROOT ?>/prgregister.php?mode=create" name="FrmRegister" onSubmit="return Validate_FrmRegister('create')" >
<?php if ($CONST_AVATARS_GALLERY == "Y") { ?>
        <input type="hidden" name="avatar" id="avatar" value="<?= $avatar_id ?>">
<?php } ?>
    <div class="rvdv">
        <div class="col-xs-12 col-sm-12 col-md-12 joinmb">

            <b><?php echo REGISTER_IF_YOU_MEMBER ?></b>
            <a href="<?php echo $CONST_LINK_ROOT ?>/login.php"><?php echo REGISTER_LOG_IN_HERE ?></a>

        </div> 
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12" > 
        <div class="join_head"><?= ADVERTISE_MESSAGE1 ?></div>
    </div>


    <div class="col-xs-12 col-sm-5 col-md-6 nopadding" >
        <?php if($usersex=="" || $usersex=="F" || $usersex=="M" || $usersex=="C") { ?>
          <div class="rvdv">
        <div class="col-xs-12 col-sm-6 col-md-6 "><?php echo REGISTER_SEX ?>  <span class=mandatory>*</span></div>

        <div class="col-xs-12 col-sm-6 col-md-6 ">
           
            <select class="input fullwidth" size="1" name="lstSex"
                    <?php if($COUPLE_MODE) { ?> onchange="frmsex_submit(this.value)" <?php } ?>>
                <option selected>- <?php echo GENERAL_CHOOSE ?> -</option>
                <option value="M" 
                    <?php if($usersex=="M") echo "selected"; else if($_SESSION['post']['lstSex']=="M") echo "selected"; ?> >
                        <?php echo SEX_MALE ?></option>
                <option value="F"  <?php if($usersex=="F") echo "selected"; else if($_SESSION['post']['lstSex']=="F") echo "selected"; ?>><?php echo SEX_FEMALE ?></option>
                <?php if($COUPLE_MODE) { ?>
                    <option value="C" <?php if($usersex=="C") echo "selected"; else if($_SESSION['post']['lstSex']=="C") echo "selected"; ?>><?php echo SEX_COUPLE ?></option>
                    <?php }?>
            </select>
            </div>
        </div>
<?php 
        } ?>
        <div class="rvdv">
            <div class="col-xs-12 col-sm-6 col-md-6 ">
<?php echo REGISTER_USERNAME ?>:  <span class=mandatory>*</span>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 ">
                <input type="text" id="txtHandle"  name="txtHandle" size="20" maxlength='25' class="input width90" value="<?php if(isset($username)) echo $username; else {  $_SESSION['post']['txtHandle']; } ?>" >
                <a href="javascript:MDM_openWindow('<?php echo $CONST_LINK_ROOT ?>/help/hregister1.php','<?php echo REGISTER_HELP ?>','width=250,height=375')"><img border='0' src='<?= $CONST_IMAGE_ROOT ?><?= $CONST_IMAGE_LANG ?>/help_but.gif'></a>
            </div>
        </div>
        <div class="rvdv">
            <div class="col-xs-12 col-sm-6 col-md-6 ">
<?php echo REGISTER_PASSWORD ?>  <span class=mandatory>*</span>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 "> <input name="txtPassword" type="password" class="input fullwidth" id="txtPassword" size="20" maxlength="10" value="<?= $_SESSION['post']['txtPassword']; ?>" ></div>
        </div>
        <div class="rvdv">
            <div class="col-xs-12 col-sm-6 col-md-6 ">
<?php echo REGISTER_CONFIRM ?>  <span class=mandatory>*</span>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 ">
                <input name="txtConfirm" type="password" class="input fullwidth" id="txtConfirm" size="20" maxlength="10" value="<?= $_SESSION['post']['txtConfirm']; ?>" >
            </div>
        </div>
        <?php 
if ($GEOGRAPHY_JAVASCRIPT) {
    if ($GEOGRAPHY_AJAX) {
        ?>
                <script src="<?= CONST_LINK_ROOT ?>/moo.ajax/moo.ajax.js"></script>
                <script src="<?= CONST_LINK_ROOT ?>/ajax_lib.js.php"></script>
                <div class="rvdv">
                    <div class="col-xs-12 col-sm-6 col-md-6 "><?php echo GENERAL_COUNTRY ?>  <span class=mandatory>*</span></div>

                    <div class="col-xs-12 col-sm-6 col-md-6"> <select class="input fullwidth" name="lstCountry" id="lstCountry" size="1"   onchange="sendStateRequest(this.options[this.selectedIndex].value);sendCityRequest(this.options[this.selectedIndex].value, 0); return false;">
                            <option value="0" selected>-- <?php echo GENERAL_CHOOSE ?> --</option>
                            <option value=""></option>
        <?php
        include_once __INCLUDE_CLASS_PATH . "/class.Geography.php";
        $GeographyLink = new Geography();
        $CountriesList = $GeographyLink->getCountriesList();
        //$CountriesList = Geography::getCountriesList();
        foreach ($CountriesList as $countryrow) {
            echo '<option value="' . $countryrow->gcn_countryid . '">' . htmlspecialchars($countryrow->gcn_name) . '</option>';
        }
        ?>
                        </select> </div>
                </div>
 <div class="rvdv">
                    <div class="col-xs-12 col-sm-6 col-md-6 "><?php echo GENERAL_STATE ?>  <span class=mandatory>*</span></div>
                    <div class="col-xs-12 col-sm-6 col-md-6 ">
                        <select disabled class="input fullwidth" name="lstState" id="lstState" size="1"   onchange="sendCityRequest(document.getElementById('lstCountry').value, this.value); return false;">
                            <option value="0" selected>- <?php echo GENERAL_CHOOSE ?> -</option>
                        </select>
                    </div>
                </div>
                <div class="rvdv">
                    <div class="col-xs-12 col-sm-6 col-md-6 ">
        <?php echo GENERAL_CITY ?>  <span class=mandatory>*</span></div>
                    <div class="col-xs-12 col-sm-6 col-md-6 ">
                        <select disabled class="input fullwidth" name="lstCity" id="lstCity" size="1"   >
                            <option value="0" selected>- <?php echo GENERAL_CHOOSE ?> -</option>
                        </select>
                    </div>
                </div>

                <script language="javascript">
                    function initialize(SelectedCountry, SelectedState, SelectedCity)
                    {
                        var lstCountry = new getObj('lstCountry').obj;
                        if (SelectedCountry)
                        {
                            for (iOption = 0; iOption < lstCountry.options.length; iOption++)
                                if (lstCountry.options[iOption].value == SelectedCountry) {
                                    lstCountry.options[iOption].selected = true;
                                }
                            sendStateRequest(SelectedCountry, SelectedState);
                            sendCityRequest(SelectedCountry, SelectedState, SelectedCity);
                        }
                    }

                    initialize(country, state, city);
                </script>
    <?php } else { ?>
                <script language="javascript" src="geography.js"></script>
                <div class="rvdv">
                    <div class="col-xs-12 col-sm-6 col-md-3 "><?php echo GENERAL_COUNTRY ?>  <span class=mandatory>*</span></div>
                    <div class="col-xs-12 col-sm-6 col-md-3 "> <select class="input fullwidth" name="lstCountry" id="lstCountry" size="1"   onchange="onCountryListChange('FrmRegister', 'lstCountry', 'lstState', 'lstCity');">
                            <option value="0" selected>- <?php echo GENERAL_CHOOSE ?> -</option>
                            <option value=""></option>
                        </select> 
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 "><?php echo GENERAL_STATE ?>  <span class=mandatory>*</span></div>
                    <div class="col-xs-12 col-sm-6 col-md-3 "> <select class="input fullwidth" name="lstState" id="lstState" size="1"   onchange="onStateListChange('FrmRegister', 'lstCountry', 'lstState', 'lstCity');">
                            <option value="0" selected></option>
                        </select> </div>
                </div><div class="rvdv">
                    <div class="col-xs-12 col-sm-6 col-md-6 "><?php echo GENERAL_CITY ?> <span class=mandatory>*</span></div>
                    <div class="col-xs-12 col-sm-6 col-md-6 "><select class="input fullwidth" name="lstCity" id="lstCity" size="1"    onchange="onCityListChange('FrmRegister', 'lstCity');">
                            <option value="0" selected></option>
                        </select> </div>
                </div> 
                <script language="javascript">
                    initialize('FrmRegister', 'lstCountry', 'lstState', 'lstCity', new Array(country), new Array(state), new Array(city));
                </script>
    <?php } ?>
<?php } else { ?>
            <div class="rvdv">
                <div class="col-xs-12 col-sm-6 col-md-3 "><?php echo GENERAL_COUNTRY ?>/<?php echo GENERAL_STATE ?>  <span class=mandatory>*</span></div>
                <div class="col-xs-12 col-sm-6 col-md-9 "> 
                    <select class="input fullwidth" name="lstCountry" id="lstCountry" size="1"  style="width:auto;">
                        <option value="0" selected>- <?php echo GENERAL_CHOOSE ?> -</option>
            <?= country_state_list($_SESSION['post']['lstCountryState']); ?>
                    </select> </div>
            </div><div class="rvdv">
                <div class="col-xs-12 col-sm-6 col-md-3 "><?php echo GENERAL_CITY ?>  <span class=mandatory>*</span></div>
                <div class="col-xs-12 col-sm-6 col-md-9 "> <input type=text class="input fullwidth" name="txtLocation" value="<?= $_SESSION['post']['txtLocation'] ?>"  >
                </div>
            </div>

<?php } ?>
<?php
if ($CONST_ZIPCODES == 'Y') {
    print(" 
       <div class='rvdv'><div class='col-xs-12 col-sm-3 col-md-6 '>" . ADVERTISE_ZIPCODE . "</div>
        <div class='col-xs-12 col-sm-9 col-md-6 '><input type='text' name='txtZipcode' size='15' maxlength='5'  class='input fullwidth' value='" . $_SESSION['post']['txtZipcode'] . "'>&nbsp;(" . ADVERTISE_USA . ")</div>
         </div> ");
}
?>    
             <?php if($usersex=="" || $usersex=="F" || $usersex=="M") { ?>
                <div class="rvdv">
        <div class="col-xs-12 col-sm-6 col-md-6 "><?php echo REGISTER_LAST_NAME ?>  <span class=mandatory>*</span></div>
        <div class="col-xs-12 col-sm-6 col-md-6 ">
            <input type="text" class="input fullwidth" name="txtSurname" size="20" maxlength='25' value="<?= $_SESSION['post']['txtSurname']; ?>" >
        </div>
        
    </div>
    <div class="rvdv">
        <div class="col-xs-12 col-sm-6 col-md-6 "><?php echo REGISTER_FIRST_NAME ?>  <span class=mandatory>*</span></div>

        <div class="col-xs-12 col-sm-6 col-md-6 "> 
            <input type="text" class="input fullwidth" name="txtForename" size="20" maxlength='25' value="<?= $_SESSION['post']['txtForename']; ?>" >
        </div>
 
    </div>
    <div class="rvdv">
        <div class="col-xs-12 col-sm-6 col-md-6 ">
<?php echo REGISTER_BIRTHDAY ?>  <span class=mandatory>*</span>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 ">
            <select class="inputf width30" size="1" name="lstDay"  >
                <option selected>...</option>
                <?php
                $out = "";
                for ($i = 1; $i <= 31; $i++) {
                    $cur_i = sprintf("%02d", $i);
                    $selected = ($cur_i == $_SESSION['post']['lstDay']) ? " SELECTED" : "";
                    echo '<option  value="' . $cur_i . '" ' . $selected . '>' . $cur_i . '</option>';
                }
                echo $out;
                ?>
            </select>

            <select class="inputf width30" size="1" name="lstMonth" >
                <option selected>...</option>
                <option value="01" <?php if ('01' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_JAN ?></option>
                <option value="02" <?php if ('02' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_FEB ?></option>
                <option value="03" <?php if ('03' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_MAR ?></option>
                <option value="04" <?php if ('04' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_APR ?></option>
                <option value="05" <?php if ('05' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_MAY ?></option>
                <option value="06" <?php if ('06' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_JUN ?></option>
                <option value="07" <?php if ('07' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_JUL ?></option>
                <option value="08" <?php if ('08' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_AUG ?></option>
                <option value="09" <?php if ('09' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_SEP ?></option>
                <option value="10" <?php if ('10' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_OCT ?></option>
                <option value="11" <?php if ('11' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_NOV ?></option>
                <option value="12" <?php if ('12' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_DEC ?></option>
            </select>

            <select name="txtYear" class="inputf width30" size="1" >
                <option selected>...</option>
<?php for ($count = date("Y") - 18; $count >= 1900; $count--) { ?>
                    <option value='<?= $count ?>' <?php if ($_SESSION['post']['txtYear1'] == $count) echo 'selected'; ?>)><?= $count ?></option>
<?php } ?>
            </select>
        </div>
    </div>
                
              
     <?php }?>   
        <div class="rvdv">
            <div class="col-xs-12 col-sm-6 col-md-6 "><?php echo REGISTER_EMAIL ?>  <span class=mandatory>*</span></div>

            <div class="col-xs-12 col-sm-6 col-md-6 ">
                <input type="text" class="input fullwidth" name="txtEmail" size="25" maxlength='70' value="<?= $_SESSION['post']['txtEmail']; ?>"  >
            </div>
        </div>
       
        <!-- SKYPE -->
                    <?php if ($option_manager->GetValue('skype')) { ?>
            <div class="rvdv">
                <div class="col-xs-12 col-sm-6 col-md-6 "><?php echo SKYPE_NAME ?></div>
                <div class="col-xs-12 col-sm-6 col-md-6 ">
                    <input type="text" class="input fullwidth" name="txtSkypename" size="20" maxlength='45' value="<?= $_SESSION['post']['txtSkypename']; ?>" >
                </div>
            </div><div class="rvdv">
                <div class="col-xs-12 col-sm-6 col-md-6 ">
    <?php echo SKYPE_SETTINGS ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 ">
                    <select class="input fullwidth" name="lstSkypeSettings" id="lstSkypeSettings" size="1"  style="width:auto;">
                        <option value="0" >- <?php echo GENERAL_CHOOSE ?> -</option>
                        <option value="ALL" <?php if ('ALL' == $_SESSION['post']['lstSkypeSettings']) {
        echo " SELECTED";
    } ?>><?php echo SKYPE_ALL ?></option>
                        <option value="HOTLIST" <?php if ('HOTLIST' == $_SESSION['post']['lstSkypeSettings']) {
        echo " SELECTED";
    } ?>><?php echo SKYPE_HOTLIST ?></option>
                    </select>
                </div></div> 
        <?php } ?>
        <!-- SKYPE -->

        <!-- SMS -->
        <?php
        if ($option_manager->GetValue('sms') == 'Y') {
            include_once __INCLUDE_CLASS_PATH . "/class.SMS.php";
            ?><div class="rvdv">
                <div class="col-xs-12 col-sm-6 col-md-6 ">
                    <?php echo MOBILE_PHONE ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 ">
                    <input type="text" class="input fullwidth" name="txtMobile" size="20" maxlength='45' value="<?= $_SESSION['post']['txtMobile']; ?>" >
                </div> 
            </div><div class="rvdv">
                <div class="col-xs-12 col-sm-6 col-md-6 ">
                    <?php echo SMS_CARRIER ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 ">
                    <select class="input fullwidth" name="lstSmsCarrier" id="lstSmsCarrier" size="1"  style="width:auto;">
                        <option value="0" >- <?php echo GENERAL_CHOOSE ?> -</option>
                        <?php
                        $SMSLink = new SMS();
                        $listA = $SMSLink->getList(new stdClass);
                        //foreach (SMS::getList(new stdClass) as $sms)
                        foreach ($listA as $sms) {
                            ?>
                            <option value="<?= $sms->id ?>" <?php if ($sms->id == $_SESSION['post']['lstSmsCarrier']) {
                        echo " SELECTED";
                    } ?>><?= $sms->title ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div></div> 
            <?php
        }
        ?>
        <!-- SMS -->
        <div class="rvdv">
        <div class="col-xs-12 col-sm-6 col-md-6 "><a href="<?php echo $CONST_LINK_ROOT ?>/disclaimer.php" target="_blank"><?php echo REGISTER_DISCLAIMER ?></a></div>
        <div class="col-xs-12 col-sm-6 col-md-6 ">
            <input type="checkbox" name="chkDisclaimer" value="1" <?php if (isset($_SESSION['post']['chkDisclaimer'])) {
            echo " CHECKED";
        } ?>  >
<?php echo REGISTER_I_AGREE ?>
        </div>
        </div>

        <div class="rvdv">
            <div class="col-xs-12 col-sm-6 col-md-6 "><?php echo REGISTER_NEWSLETER ?>  <span class=mandatory>*</span></div>

            <div class="col-xs-12 col-sm-6 col-md-6 ">
                <input type="checkbox" name="chkNews" value="1" <?php if (!isset($_SESSION['post']) || isset($_SESSION['post']['chkNews'])) {
    echo " CHECKED";
} ?>  >
            </div>
        </div>
                    





    </div>

    <div class="col-xs-12 col-sm-7 col-md-6 registerimg" >
        <div class="embed-responsive embed-responsive-16by9">
            <iframe width="500" height="265" src="https://www.youtube.com/embed/wBlILhpI2cU?autoplay=1&showinfo=0&controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

    </div>
    <div  class="col-xs-12 col-sm-12 col-md-12">
        <div class="join_head"><?= ADVERTISE_MESSAGE2 ?></div>


    </div>
        <?php if ($COUPLE_MODE && $usersex=="C") { ?>
    <div class="rvdv tdhead">
        <div class="col-xs-12 col-sm-3 col-md-3 "><strong><?php echo GENERAL_PARTNER1;?></strong></div>
        <div class="col-xs-12 col-sm-3 col-md-3 "></div>
        <div class="col-xs-12 col-sm-6 col-md-6 "><strong><?php echo GENERAL_PARTNER2;?></strong></div>

    </div>
        <?php } ?>
    
<?php if($usersex=="" || $usersex=="F" || $usersex=="M") { ?>
        
        
         <div class="rvdv"> 
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_SEEKING ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select name="lstSeeking" size="1" class="input fullwidth" >
                    <?php populate_lists('SKG', 'base', 'adv', $_SESSION['post']['lstSeeking']); ?>
                </select>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_BODY_TYPE ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select name="lstBodyType" size="1" class="input fullwidth" >
                    <?php populate_lists('BDY', 'base', 'adv', $_SESSION['post']['lstBodyType']); ?>
                </select></div>
        </div>
        <div class="rvdv">

            
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_HEIGHT ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select name="lstHeight" size="1" class="input fullwidth" >
                    <option value="Not stated"><?php echo GENERAL_NOT_STATE ?></option>
                    <?php
                    $out = "";
                    $prev = "";
                    for ($cm = 122; $cm <= 230; $cm++) {
                        $in_inches = round($cm / 2.54);
                        $in_feets = floor($cm / 30.48);
                        if ($in_inches - $in_feets * 12 == 12)
                            $in_feets++;
                        $cur_i = $in_feets . "'" . ($in_inches - $in_feets * 12) . "&quot;";
                        $selected = ($cm == $_SESSION['post']['lstHeight']) ? " SELECTED" : "";
                        if ($prev != $cur_i)
                            $out .= '<option value="' . $cm . '"' . $selected . '>' . $cur_i . '(' . $cm . ADVERTISE_CM . ')' . '</option><br>';
                        $prev = $cur_i;
                    }
                    echo $out;
                    ?>
                </select></div>

            <div class="col-xs-12 col-sm-3 col-md-3  "><?php echo ADVERTISE_CHILDREN ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select name="lstChildren" size="1" class="input fullwidth" >
                    <?php populate_lists('CHL', 'base', 'adv', $_SESSION['post']['lstChildren']); ?>
                </select></div>
        </div><div class="rvdv">

            <div class="col-xs-12 col-sm-3 col-md-3  "><?php echo ADVERTISE_EYE ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select class="input fullwidth" name="lstEyecolor" size="1" >
                    <?php populate_lists('EYE', 'base', 'adv', $_SESSION['post']['lstEyecolor']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_HAIR ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select class="input fullwidth" name="lstHaircolor" size="1" >
                    <?php populate_lists('HAR', 'base', 'adv', $_SESSION['post']['lstHaircolor']); ?>
                </select></div>

        </div><div class="rvdv">
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_SMOKER ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select name="lstSmoker" size="1" class="input fullwidth" >
                    <?php populate_lists('SMK', 'base', 'adv', $_SESSION['post']['lstSmoker']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_RELIGION ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select name="lstReligion" size="1" class="input fullwidth" >
                    <?php populate_lists('RLG', 'base', 'adv', $_SESSION['post']['lstReligion']); ?>
                </select></div>
        </div><div class="rvdv">

            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_MARITAL ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select name="lstMarital" size="1" class="input fullwidth" >
                    <?php populate_lists('MRT', 'base', 'adv', $_SESSION['post']['lstMarital']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_ETHN ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select name="lstEthnicity" size="1" class="input fullwidth" >
    <?php populate_lists('ETH', 'base', 'adv', $_SESSION['post']['lstEthnicity']); ?>
                </select></div>
        </div><div class="rvdv">

            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_EDU ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select class="input fullwidth" name="lstEducation" size="1" >
    <?php populate_lists('EDU', 'base', 'adv', $_SESSION['post']['lstEducation']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_EPL ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select class="input fullwidth" name="lstEmployment" size="1" >
    <?php populate_lists('EMP', 'base', 'adv', $_SESSION['post']['lstEmployment']); ?>
                </select></div>

        </div><div class="rvdv">
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_INCOME ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select class="input fullwidth" name="lstIncome" size="1" >
    <?php populate_lists('INC', 'base', 'adv', $_SESSION['post']['lstIncome']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_DRINKING ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select class="input fullwidth" name="lstDrink" size="1" >
    <?php populate_lists('DNK', 'base', 'adv', $_SESSION['post']['lstDrink']); ?>
                </select></div>
        </div>
                <?php } else { ?>
        <div class="rvdv">
        <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo REGISTER_LAST_NAME ?>  <span class=mandatory>*</span></div>
        <div class="col-xs-12 col-sm-3 col-md-3 ">
            <input type="text" class="input fullwidth" name="txtSurname" size="20" maxlength='25' value="<?= $_SESSION['post']['txtSurname']; ?>" >
        </div>
         <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop">
            <input type="text" class="input fullwidth" name="txtSurname1" size="20" maxlength='25' value="<?= $_SESSION['post']['txtSurname1']; ?>" >
        </div>
        
    </div>
    <div class="rvdv">
        <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo REGISTER_FIRST_NAME ?>  <span class=mandatory>*</span></div>

        <div class="col-xs-12 col-sm-3 col-md-3 "> 
            <input type="text" class="input fullwidth" name="txtForename" size="20" maxlength='25' value="<?= $_SESSION['post']['txtForename']; ?>" >
        </div>
          <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop"> 
            <input type="text" class="input fullwidth" name="txtForename1" size="20" maxlength='25' value="<?= $_SESSION['post']['txtForename1']; ?>" >
        </div>
 
    </div>
    <div class="rvdv">
        <div class="col-xs-12 col-sm-3 col-md-3 ">
<?php echo REGISTER_BIRTHDAY ?>  <span class=mandatory>*</span>
        </div>

        <div class="col-xs-12 col-sm-3 col-md-3 ">
            <select class="inputf width30" size="1" name="lstDay"  >
                <option selected>...</option>
                <?php
                $out = "";
                for ($i = 1; $i <= 31; $i++) {
                    $cur_i = sprintf("%02d", $i);
                    $selected = ($cur_i == $_SESSION['post']['lstDay']) ? " SELECTED" : "";
                    echo '<option  value="' . $cur_i . '" ' . $selected . '>' . $cur_i . '</option>';
                }
                echo $out;
                ?>
            </select>

            <select class="inputf width30" size="1" name="lstMonth" >
                <option selected>...</option>
                <option value="01" <?php if ('01' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_JAN ?></option>
                <option value="02" <?php if ('02' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_FEB ?></option>
                <option value="03" <?php if ('03' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_MAR ?></option>
                <option value="04" <?php if ('04' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_APR ?></option>
                <option value="05" <?php if ('05' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_MAY ?></option>
                <option value="06" <?php if ('06' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_JUN ?></option>
                <option value="07" <?php if ('07' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_JUL ?></option>
                <option value="08" <?php if ('08' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_AUG ?></option>
                <option value="09" <?php if ('09' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_SEP ?></option>
                <option value="10" <?php if ('10' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_OCT ?></option>
                <option value="11" <?php if ('11' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_NOV ?></option>
                <option value="12" <?php if ('12' == $_SESSION['post']['lstMonth']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_DEC ?></option>
            </select>

            <select name="txtYear" class="inputf width30" size="1" >
                <option selected>...</option>
<?php for ($count = date("Y") - 18; $count >= 1900; $count--) { ?>
                    <option value='<?= $count ?>' <?php if ($_SESSION['post']['txtYear'] == $count) echo 'selected'; ?>)><?= $count ?></option>
<?php } ?>
            </select>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop">
            <select class="inputf width30" size="1" name="lstDay1"  >
                <option selected>...</option>
                <?php
                $out = "";
                for ($i = 1; $i <= 31; $i++) {
                    $cur_i = sprintf("%02d", $i);
                    $selected = ($cur_i == $_SESSION['post']['lstDay1']) ? " SELECTED" : "";
                    echo '<option  value="' . $cur_i . '" ' . $selected . '>' . $cur_i . '</option>';
                }
                echo $out;
                ?>
            </select>

            <select class="inputf width30" size="1" name="lstMonth1" >
                <option selected>...</option>
                <option value="01" <?php if ('01' == $_SESSION['post']['lstMonth1']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_JAN ?></option>
                <option value="02" <?php if ('02' == $_SESSION['post']['lstMonth1']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_FEB ?></option>
                <option value="03" <?php if ('03' == $_SESSION['post']['lstMonth1']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_MAR ?></option>
                <option value="04" <?php if ('04' == $_SESSION['post']['lstMonth1']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_APR ?></option>
                <option value="05" <?php if ('05' == $_SESSION['post']['lstMonth1']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_MAY ?></option>
                <option value="06" <?php if ('06' == $_SESSION['post']['lstMonth1']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_JUN ?></option>
                <option value="07" <?php if ('07' == $_SESSION['post']['lstMonth1']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_JUL ?></option>
                <option value="08" <?php if ('08' == $_SESSION['post']['lstMonth1']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_AUG ?></option>
                <option value="09" <?php if ('09' == $_SESSION['post']['lstMonth1']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_SEP ?></option>
                <option value="10" <?php if ('10' == $_SESSION['post']['lstMonth1']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_OCT ?></option>
                <option value="11" <?php if ('11' == $_SESSION['post']['lstMonth1']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_NOV ?></option>
                <option value="12" <?php if ('12' == $_SESSION['post']['lstMonth1']) {
                    echo "SELECTED";
                } ?>><?php echo MONTH_DEC ?></option>
            </select>

            <select name="txtYear1" class="inputf width30" size="1" >
                <option selected>...</option>
<?php for ($count = date("Y") - 18; $count >= 1900; $count--) { ?>
                    <option value='<?= $count ?>' <?php if ($_SESSION['post']['txtYear1'] == $count) echo 'selected'; ?>)><?= $count ?></option>
<?php } ?>
            </select>
        </div>
    </div>
    <div class="rvdv">
        <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo REGISTER_SEX ?>  <span class=mandatory>*</span></div>

        <div class="col-xs-12 col-sm-3 col-md-3 ">
            <select class="input fullwidth" size="1" name="lstSex" >
                <option selected>- <?php echo GENERAL_CHOOSE ?> -</option>
                <option value="M" <?php if ('M' == $_SESSION['post']['lstSex']) {
    echo " SELECTED";
} ?>><?php echo SEX_MALE ?></option>
                <option value="F" <?php if ('F' == $_SESSION['post']['lstSex']) {
    echo " SELECTED";
} ?>><?php echo SEX_FEMALE ?></option>
                
                    
                    
            </select>
        </div>
<div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop">
            <select class="input fullwidth" size="1" name="lstSex1" >
                <option selected>- <?php echo GENERAL_CHOOSE ?> -</option>
                <option value="M" <?php if ('M' == $_SESSION['post']['lstSex1']) {
    echo " SELECTED";
} ?>><?php echo SEX_MALE ?></option>
                <option value="F" <?php if ('F' == $_SESSION['post']['lstSex1']) {
    echo " SELECTED";
} ?>><?php echo SEX_FEMALE ?></option>
                 
            </select>
        </div>
 

    </div>
        
         <div class="rvdv"> 
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_SEEKING ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select name="lstSeeking" size="1" class="input fullwidth" >
                    <?php populate_lists('SKG', 'base', 'adv', $_SESSION['post']['lstSeeking']); ?>
                </select>
            </div>
             <div class="col-xs-12 col-sm-3 col-md-3 cplpaddingtop"> <select name="lstSeeking1" size="1" class="input fullwidth" >
                    <?php populate_lists('SKG', 'base', 'adv', $_SESSION['post']['lstSeeking1']); ?>
                </select>
            </div>
         </div>
            <div class="rvdv"> 
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_BODY_TYPE ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select name="lstBodyType" size="1" class="input fullwidth" >
                    <?php populate_lists('BDY', 'base', 'adv', $_SESSION['post']['lstBodyType']); ?>
                </select></div>
             <div class="col-xs-12 col-sm-3 col-md-3 cplpaddingtop"> <select name="lstBodyType1" size="1" class="input fullwidth" >
                    <?php populate_lists('BDY', 'base', 'adv', $_SESSION['post']['lstBodyType1']); ?>
                </select></div>
        </div>
        <div class="rvdv">

            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_HEIGHT ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select name="lstHeight" size="1" class="input fullwidth" >
                    <option value="Not stated"><?php echo GENERAL_NOT_STATE ?></option>
    <?php
    $out = "";
    $prev = "";
    for ($cm = 122; $cm <= 230; $cm++) {
        $in_inches = round($cm / 2.54);
        $in_feets = floor($cm / 30.48);
        if ($in_inches - $in_feets * 12 == 12)
            $in_feets++;
        $cur_i = $in_feets . "'" . ($in_inches - $in_feets * 12) . "&quot;";
        $selected = ($cm == $_SESSION['post']['lstHeight']) ? " SELECTED" : "";
        if ($prev != $cur_i)
            $out .= '<option value="' . $cm . '"' . $selected . '>' . $cur_i . '(' . $cm . ADVERTISE_CM . ')' . '</option><br>';
        $prev = $cur_i;
    }
    echo $out;
    ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop"> <select name="lstHeight1" size="1" class="input fullwidth" >
                    <option value="Not stated"><?php echo GENERAL_NOT_STATE ?></option>
    <?php
    $out = "";
    $prev = "";
    for ($cm = 122; $cm <= 230; $cm++) {
        $in_inches = round($cm / 2.54);
        $in_feets = floor($cm / 30.48);
        if ($in_inches - $in_feets * 12 == 12)
            $in_feets++;
        $cur_i = $in_feets . "'" . ($in_inches - $in_feets * 12) . "&quot;";
        $selected = ($cm == $_SESSION['post']['lstHeight1']) ? " SELECTED" : "";
        if ($prev != $cur_i)
            $out .= '<option value="' . $cm . '"' . $selected . '>' . $cur_i . '(' . $cm . ADVERTISE_CM . ')' . '</option><br>';
        $prev = $cur_i;
    }
    echo $out;
    ?>
                </select></div>
        </div>
        <div class="rvdv">
            <div class="col-xs-12 col-sm-3 col-md-3  "><?php echo ADVERTISE_CHILDREN ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select name="lstChildren" size="1" class="input fullwidth" >
                    <?php populate_lists('CHL', 'base', 'adv', $_SESSION['post']['lstChildren']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop"> <select name="lstChildren1" size="1" class="input fullwidth" >
                    <?php populate_lists('CHL', 'base', 'adv', $_SESSION['post']['lstChildren1']); ?>
                </select></div>
        </div>
        <div class="rvdv">

            <div class="col-xs-12 col-sm-3 col-md-3  "><?php echo ADVERTISE_EYE ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> 
                <select class="input fullwidth" name="lstEyecolor" size="1" >
    <?php populate_lists('EYE', 'base', 'adv', $_SESSION['post']['lstEyecolor']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop"> 
                <select class="input fullwidth" name="lstEyecolor1" size="1" >
    <?php populate_lists('EYE', 'base', 'adv', $_SESSION['post']['lstEyecolor1']); ?>
                </select></div>
        </div>
        <div class="rvdv">
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_HAIR ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 ">
                <select class="input fullwidth" name="lstHaircolor" size="1" >
    <?php populate_lists('HAR', 'base', 'adv', $_SESSION['post']['lstHaircolor']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop">
                <select class="input fullwidth" name="lstHaircolor1" size="1" >
    <?php populate_lists('HAR', 'base', 'adv', $_SESSION['post']['lstHaircolor1']); ?>
                </select></div>

        </div>
        <div class="rvdv">
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_SMOKER ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> 
                <select name="lstSmoker" size="1" class="input fullwidth" >
                    <?php populate_lists('SMK', 'base', 'adv', $_SESSION['post']['lstSmoker']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop">
                <select name="lstSmoker1" size="1" class="input fullwidth" >
        <?php populate_lists('SMK', 'base', 'adv', $_SESSION['post']['lstSmoker1']); ?>
                </select></div>
        </div>
        <div class="rvdv">
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_RELIGION ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 ">
                <select name="lstReligion" size="1" class="input fullwidth" >
                <?php populate_lists('RLG', 'base', 'adv', $_SESSION['post']['lstReligion']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop">
                <select name="lstReligion1" size="1" class="input fullwidth" >
                <?php populate_lists('RLG', 'base', 'adv', $_SESSION['post']['lstReligion1']); ?>
                </select></div>
        </div>
        <div class="rvdv">

            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_MARITAL ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select name="lstMarital" size="1" class="input fullwidth" >
    <?php populate_lists('MRT', 'base', 'adv', $_SESSION['post']['lstMarital']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop"> 
                <select name="lstMarital1" size="1" class="input fullwidth" >
    <?php populate_lists('MRT', 'base', 'adv', $_SESSION['post']['lstMarital1']); ?>
                </select></div></div>
        <div class="rvdv">
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_ETHN ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 ">
                <select name="lstEthnicity" size="1" class="input fullwidth" >
    <?php populate_lists('ETH', 'base', 'adv', $_SESSION['post']['lstEthnicity']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop"> 
                <select name="lstEthnicity1" size="1" class="input fullwidth" >
    <?php populate_lists('ETH', 'base', 'adv', $_SESSION['post']['lstEthnicity1']); ?>
                </select></div>
        </div><div class="rvdv">

            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_EDU ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select class="input fullwidth" name="lstEducation" size="1" >
    <?php populate_lists('EDU', 'base', 'adv', $_SESSION['post']['lstEducation']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop"> 
                <select class="input fullwidth" name="lstEducation1" size="1" >
    <?php populate_lists('EDU', 'base', 'adv', $_SESSION['post']['lstEducation1']); ?>
                </select></div>
        </div>
        <div class="rvdv">
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_EPL ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select class="input fullwidth" name="lstEmployment" size="1" >
    <?php populate_lists('EMP', 'base', 'adv', $_SESSION['post']['lstEmployment']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop"> 
                <select class="input fullwidth" name="lstEmployment1" size="1" >
    <?php populate_lists('EMP', 'base', 'adv', $_SESSION['post']['lstEmployment1']); ?>
                </select></div>
        </div>
        <div class="rvdv">
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_INCOME ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select class="input fullwidth" name="lstIncome" size="1" >
    <?php populate_lists('INC', 'base', 'adv', $_SESSION['post']['lstIncome']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop"> <select class="input fullwidth" name="lstIncome1" size="1" >
    <?php populate_lists('INC', 'base', 'adv', $_SESSION['post']['lstIncome1']); ?>
                </select></div></div>
        <div class="rvdv">
            <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_DRINKING ?></div>
            <div class="col-xs-12 col-sm-3 col-md-3 "> <select class="input fullwidth" name="lstDrink" size="1" >
    <?php populate_lists('DNK', 'base', 'adv', $_SESSION['post']['lstDrink']); ?>
                </select></div>
            <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop"> <select class="input fullwidth" name="lstDrink1" size="1" >
    <?php populate_lists('DNK', 'base', 'adv', $_SESSION['post']['lstDrink1']); ?>
                </select></div>
        </div>

<?php } ?>
    <div class="rvdv">

        <div class="col-xs-12 col-sm-3 col-md-3  "><?= SEX ?> <span class=mandatory>*</span></div>
        <div class="col-xs-12 col-sm-3 col-md-3 nodisplay"><?php echo GENERAL_PARTNER1; ?></div>
        <div class="col-xs-12 col-sm-3 col-md-3 ">
            
            <input type="checkbox" name="chkSeekmen" value="men"  <?php if ('men' == $_SESSION['post']['chkSeekmen']) {
    echo " CHECKED";
} ?>>&nbsp;<?php echo ADVERTISE_SEEK_M ?><br> 
                <input type="checkbox" name="chkSeekwmn" value="wmn"  <?php if ('wmn' == $_SESSION['post']['chkSeekwmn']) {
                    echo " CHECKED";
                } ?>>&nbsp;<?php echo ADVERTISE_SEEK_W ?><br>
                <?php if($COUPLE_MODE) { ?>
     <input type="checkbox" name="chkSeekcpl" value="cpl"  <?php if ('cpl' == $_SESSION['post']['chkSeekcpl']) {
        echo " CHECKED";
    } ?>>&nbsp;<?php echo ADVERTISE_SEEK_C; ?>
                <?php } ?>                
        </div>
      <?php if($COUPLE_MODE && $usersex=="C") { ?> 
        <div class="col-xs-12 col-sm-3 col-md-3 nodisplay"><?php echo GENERAL_PARTNER2; ?></div>
        <div class="col-xs-12 col-sm-3 col-md-6 cplpaddingtop">
             <input type="checkbox" name="chkSeekmen1" value="men"  <?php if ('men' == $_SESSION['post']['chkSeekmen1']) {
    echo " CHECKED";
} ?>>&nbsp;<?php echo ADVERTISE_SEEK_M ?><br>
                <input type="checkbox" name="chkSeekwmn1" value="wmn"  <?php if ('wmn' == $_SESSION['post']['chkSeekwmn1']) {
                    echo " CHECKED";
                } ?>>&nbsp;<?php echo ADVERTISE_SEEK_W ?><br>
    <input type="checkbox" name="chkSeekcpl1" value="cpl"  <?php if ('cpl' == $_SESSION['post']['chkSeekcpl1']) {
        echo " CHECKED";
    } ?>>&nbsp;<?php echo  ADVERTISE_SEEK_C; ?>
                
        </div>
      <?php } ?>

    </div>












    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="join_head"><?= ADVERTISE_MESSAGE3 ?></div>
    </div>

    <div class="rvdv">
        <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_TITLE ?> <span class=mandatory>*</span></div>
        <div class="col-xs-12 col-sm-9 col-md-9 "> <input type="text" class="inputl fullwidth" name="txtTitle" size="30"  maxlength='30' value="<?= $_SESSION['post']['txtTitle']; ?>">
        </div>
    </div><div class="rvdv">

        <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo ADVERTISE_MES ?> <span class=mandatory>*</span>
            <p><I><?php echo ADVERTISE_MES_DESC ?></I> <br>
                <br>
                <em> </em></p></div>
        <div class="col-xs-12 col-sm-9 col-md-9 "> <textarea  class="inputl fullwidth" rows="10" name="txtComment" cols="59"  onKeyDown="textCounter(this.form.txtComment, this.form.remLentext);" onKeyUp="textCounter(this.form.txtComment, this.form.remLentext);"><?= $_SESSION['post']['txtComment']; ?></textarea>
        </div>
    </div><div class="rvdv">

        <div class="col-xs-12 col-sm-3 col-md-3 ">&nbsp;</div>
        <div class="col-xs-12 col-sm-9 col-md-9 "><em>
                <input type="box" readonly name="remLentext" size="5" value="0" class="inputf" >
                <?php echo ADVERTISE_TYPED ?></em></div>
    </div>




    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="join_head"><?= ADVERTISE_MESSAGE4 ?></div>
    </div>

    <div class="rvdv">
        <div class="col-xs-12 col-sm-3 col-md-3 "><?php echo PRGRETUSER_GENDER ?></div>
        <div class="col-xs-12 col-sm-9 col-md-9 ">

            <select name="lstMySex" size="1" class="input fullwidth"  >
                <option selected>- <?php echo GENERAL_CHOOSE ?> -</option>
                <option value="M" <?php if ('M' == $_SESSION['post']['lstMySex']) {
                    echo " SELECTED";
                } ?>><?php echo SEX_MALE ?></option>
                <option value="F" <?php if ('F' == $_SESSION['post']['lstMySex']) {
                    echo " SELECTED";
                } ?>><?php echo SEX_FEMALE ?></option>
            </select></div>
    </div><div class="rvdv">
        <div class="col-xs-12 col-sm-3 col-md-3 ">
                    <?= PRGRETUSER_AGES ?>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 "> <select name="txtMyFromAge" size="1" class="inputf"  >
                <?php
                for ($i = 18; $i < 100; $i++) {
                    $selected = ($i == $_SESSION['post']['txtMyFromAge']) ? " SELECTED" : "";
                    print("<option value='$i' $selected>$i</option>");
                }
                ?>
            </select>
            -
            <select class="inputf" size="1" name="txtMyToAge"  >
                    <?php
                    for ($i = 18; $i < 100; $i++) {
                        if (isset($_SESSION['post']['txtMyToAge'])) {
                            $selected = ($i == $_SESSION['post']['txtMyToAge']) ? " SELECTED" : "";
                        } else {
                            $selected = ($i == 99) ? " SELECTED" : "";
                        }

                        print("<option value='$i' $selected>$i</option>");
                    }
                    ?>
            </select></div>

    </div><div class="rvdv">
        <div class="col-xs-12 col-sm-3 col-md-3 ">
<?= PRGRETUSER_HEIGHT ?>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 "> <select class="inputs width47" name="lstMyMinHeight" size="1" >
            <?php
            $out = "";
            $prev = "";
            for ($cm = 122; $cm <= 232; $cm++) {
                $in_inches = round($cm / 2.54);
                $in_feets = floor($cm / 30.48);
                if ($in_inches - $in_feets * 12 == 12)
                    $in_feets++;
                $cur_i = $in_feets . "'" . ($in_inches - $in_feets * 12) . "&quot;";
                $selected = ($cm == $_SESSION['post']['lstMyMinHeight']) ? " SELECTED" : "";
                if ($prev != $cur_i)
                    $out .= '<option value="' . $cm . '"' . $selected . '>' . $cur_i . '(' . $cm . ADVERTISE_CM . ')' . '</option><br>';
                $prev = $cur_i;
            }
            echo $out;
            ?>
            </select>
            -
            <select class="inputs width47" name="lstMyMaxHeight" size="1">
<?php
$out = "";
$prev = "";
for ($cm = 122; $cm <= 230; $cm++) {
    $in_inches = round($cm / 2.54);
    $in_feets = floor($cm / 30.48);
    if ($in_inches - $in_feets * 12 == 12)
        $in_feets++;
    $cur_i = $in_feets . "'" . ($in_inches - $in_feets * 12) . "&quot;";
    if (isset($_SESSION['post']['lstMyMaxHeight'])) {
        $selected = ($cm == $_SESSION['post']['lstMyMaxHeight']) ? " SELECTED" : "";
    } else {
        $selected = ($cm == 230) ? " SELECTED" : "";
    }
    if ($prev != $cur_i)
        $out .= '<option value="' . $cm . '"' . $selected . '>' . $cur_i . '(' . $cm . ADVERTISE_CM . ')' . '</option><br>';
    $prev = $cur_i;
}
echo $out;
?>
            </select> </div>

    </div><div class="rvdv">
        <div class="col-xs-12 col-sm-3 col-md-3 ">
<?= PRGRETUSER_SMOKER ?>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 "> <select name="lstMySmoker" size="1" class="input fullwidth" >
                <option value="- Any -" selected>
<?= SEARCH_ANY ?>
                </option>
<?php populate_lists('SMK', 'base', 'adv', $_SESSION['post']['lstMySmoker']); ?>
            </select></div>
    </div><div class="rvdv">

        <div class="col-xs-12 col-sm-3 col-md-3 ">
<?= PRGRETUSER_BODYTYPE ?>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 "> <select class="input fullwidth" name="lstMyBodyType" size="1" >
                <option value="- Any -" selected>
<?= SEARCH_ANY ?>
                </option>
<?php populate_lists('BDY', 'base', 'adv', $_SESSION['post']['lstMyBodyType']); ?>
            </select> </div>
    </div><div class="rvdv">

        <div class="col-xs-12 col-sm-3 col-md-3 ">
<?= PRGRETUSER_RELATIONSHIP ?>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 "> <select class="input fullwidth" name="lstMySeeking" size="1" >
                <option value="- Any -" selected>
<?= SEARCH_ANY ?>
                </option>
<?php populate_lists('SKG', 'base', 'adv', $_SESSION['post']['lstMySeeking']); ?>
            </select> </div>

    </div><div class="rvdv">
        <div class="col-xs-12 col-sm-3 col-md-3 ">
<?= PRGRETUSER_COMMENT ?>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 "> <textarea  class="inputl fullwidth"rows="10" name="txtMyComment" cols="59" ><?= $_SESSION['post']['txtMyComment']; ?></textarea>
        </div>
    </div> 
<?php if ($SECURITY_REGISTRATION) { ?>
        <div class="rvdv">
            <div class="col-xs-12 col-sm-3 col-md-3 "> <span class=mandatory>*</span>
    <?= REGISTER_SECURITY ?></div>
            <div class="col-xs-12 col-sm-9 col-md-9 "><input type="text" class="input fullwidth" name="security" size="5" maxlength='5' >
    <?php
    $time = time();
    ?>
                <img border=0 align=absmiddle src="<?= $CONST_LINK_ROOT ?>/s_image.php?<?= $time ?>">
            </div>
        </div>
<?php } ?>
    <div class="rvdv">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="g-recaptcha" data-sitekey="6LfnahAaAAAAAD1m6EqlZ0wtq3eI7BomqO9vapA-"></div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12"><input type="submit" name="Submit" value="<?php echo BUTTON_REGNOW ?>" class="button">
    </div>
       <input type="hidden" value="<?php echo $usersex;?>" id="usersex1" name="usersex"/>
            
        </form>

<form action="" method="POST" id="frmsex" name="frmsex">
    <input type="hidden" value="<?php echo $usersex;?>" id="usersex" name="usersex"/>
    <input type="hidden" value="<?php echo $usersex;?>" id="username" name="username"/>
</form>

    <script language="Javascript">
        function frmsex_submit(usex)
        {  
            document.getElementById('usersex').value=usex;
             document.getElementById('usersex1').value=usex;
            document.getElementById('username').value=document.getElementById('txtHandle').value;
            document.getElementById("frmsex").submit();
         
        }
    
    </script>
<?=
$skin->ShowFooter($area)?>