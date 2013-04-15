<div class="basic-box">
    <div class="basic-box-head"><span class="basic-box-title">Profile</span></div>
    <div class="basic-box-content">

        <form enctype="multipart/form-data" method="post" action="/profile/action:update/">
            <input type="hidden" name="key" value="{$formKey->getKey()}">
            <table cellspacing="0" class="form-tbl infinite">
                <tbody><tr>
                    <th style="width:100px;" class="top"><label>Locations</label></th>
                    <td>

                        <a class="addLocation upper" href="/home/"><b class="i-pin">&nbsp;</b>Add address</a>
                        <div class="msg-info">
                            <b class="icon-info">&nbsp;</b>
                            To add a new location:<br><br>
                            1. In the field above, type in your address next to CHOOSE A COUNTRY.<br>
                            2. Click the SEARCH button.<br>
                            3. On the map, right-click the location found and choose ADD THIS LOCATION from the drop-down menu.
                        </div>
                    </td>
                </tr>
                <tr><td colspan="2"><b class="form-tbl-sep">&nbsp;</b></td></tr>
                <tr>
                    <th>Username</th>
                    <td><b>{$usr->login}</b></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td><b>{$usr->email}</b></td>
                </tr>
                <tr>
                    <th class="top"><label>Full name</label></th>
                    <td>
                        <input type="text" class="field2 size-200" value="{if isset($smarty.session.editAccountPostData.fullname)}{$smarty.session.editAccountPostData.fullname}{else}{$usr->props->name}{/if}" name="p[fullname]">
                    </td>
                </tr>
                <tr>
                    <th class="top"><label>Date of birth</label></th>
                    <td>
                        <input type="text" class="field2 size-200" value="{$usr->props->birthdate|date_format:'%m/%d/%Y'}" name="p[birthdate]" id="birthdate">
                    </td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td class="mid">
                        <label class="radiobox mid" for="g-male"><input type="radio" class="top" id="g-male" {if $usr->props->sex == 'm'}checked="checked"{/if} value="m" name="p[gender]"> Male</label>
                        <br>
                        <label class="radiobox mid" for="g-female"><input type="radio" class="top" id="g-female" {if $usr->props->sex == 'f'}checked="checked"{/if} value="f" name="p[gender]"> Female</label>
                    </td>
                </tr>
                <tr><td colspan="2"><b class="form-tbl-sep">&nbsp;</b></td></tr>
                <tr>
                    <th class="top"><label>Avatar</label></th>
                    <td class="top">
                        <span class="avt-medium"><img src="{$avatar_url}" alt="" /></span>&nbsp;&nbsp;
												<span class="inblock" style="padding-left: 70px">
                                                    <a target="_blank" href="http://gravatar.com/" title="Powered by Gravatar.com""><img src="{'gravatar-logo.png'|img}" alt="Powered by Gravatar.com" /></a>
												</span>
                    </td>
                </tr>
                <tr><td colspan="2"><b class="form-tbl-sep">&nbsp;</b></td></tr>
                <tr>
                    <th class="top"><label>Facebook</label></th>
                    <td>
                        <div style="float:left; padding:9px 2px 0 0;">http://www.facebook.com/</div>
                        <div style="float:left;"><input type="text" class="field2 size-300" value="{$usr->props->facebook}" name="p[facebook]" style="width:200px !important;"></div>
                        <div style="clear:both;"></div>
                    </td>
                </tr>
                <tr>
                    <th class="top"><label>Twitter</label></th>
                    <td>
                        <div style="float:left; padding:9px 2px 0 0;">http://www.twitter.com/</div>
                        <div style="float:left;"><input type="text" class="field2 size-300" value="{$usr->props->twitter}" name="p[twitter]" style="width:200px !important;"></div>
                        <div style="clear:both;"></div>

                    </td>
                </tr>
                <tr>
                    <th class="top"><label>Skype</label></th>
                    <td>
                        <input type="text" class="field2 size-200" value="{$usr->props->skype}" name="p[skype]">
                    </td>
                </tr>
                <tr><td colspan="2"><b class="form-tbl-sep">&nbsp;</b></td></tr>
                <tr>
                    <th class="mid nowrap">Email alerts</th>
                    <td class="mid">
                        <b class="frm-comment">Receive email message when:</b><br>
                        <label class="checkbox mid" for="r-male"><input type="checkbox" class="top" id="r-male" {if $usr->props->emailAlertBoy == '1'}checked="checked"{/if} value="1" name="p[register_male]"> a male user registers in my city</label>
                        <br>
                        <label class="checkbox mid" for="r-female"><input type="checkbox" class="top" id="r-female" {if $usr->props->emailAlertGirl == '1'}checked="checked"{/if} value="1" name="p[register_female]"> a female user registers in my city</label>
                    </td>
                </tr>
                <tr><td colspan="2"><b class="form-tbl-sep">&nbsp;</b></td></tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><button type="submit" class="find-btn upper size-120">Save changes</button></td>
                </tr>
                </tbody></table>
        </form>
    </div>
</div>

<div style="margin-top:15px;" class="basic-box">
    <input type="hidden" name="key" value="{$formKey->getKey()}">
    <div class="basic-box-head"><span class="basic-box-title">Change password</span></div>
    <div class="basic-box-content">
        <form method="post" action="/profile/action:changePassword/">
            <table cellspacing="0" class="form-tbl infinite">
                <tbody><tr>
                    <th style="width:100px;" class="top"><label>Password</label></th>
                    <td>
                        <input type="password" class="field2 size-200" value="" name="password">
                    </td>
                </tr>
                <tr>
                    <th class="nowrap"><label>Retype password</label></th>
                    <td>
                        <input type="password" class="field2 size-200" value="" name="password2">
                    </td>
                </tr>
                <tr><td colspan="2"><b class="form-tbl-sep">&nbsp;</b></td></tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><button type="submit" class="find-btn upper size-120">Save</button></td>
                </tr>
                </tbody></table>
        </form>
    </div>
</div>

<script>
    $(function() {
        $( "#birthdate" ).datepicker({
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:-5"
        });
    });
</script>