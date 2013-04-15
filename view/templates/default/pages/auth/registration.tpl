<div class="basic-box">
    <div class="basic-box-head"><span class="basic-box-title">Registration</span></div>
    <div class="basic-box-content c">
        <form method="post" action="/auth/action:register/" id="registrationForm">
            <table cellspacing="0" class="form-tbl infinite">
                <tbody>
                <tr>
                    <th class="top"><label>Email</label></th>
                    <td>
                        <input type="text" class="field2 size-300" value="{if isset($smarty.session.registrationData.email)}{$smarty.session.registrationData.email}{/if}" name="r[email]" id="reg-email">

                    </td>
                </tr>
                <tr>
                    <th class="top"><label>Forum username</label></th>
                    <td>
                        <input type="text" class="field2 size-300" value="{if isset($smarty.session.registrationData.username)}{$smarty.session.registrationData.username}{/if}" name="r[username]" id="reg-username">

                    </td>
                </tr>
                <tr>
                    <th class="top"><label>Password</label></th>
                    <td>
                        <input type="password" class="field2 size-200" value="" name="r[password]" id="reg-password">

                    </td>
                </tr>
                <tr>
                    <th class="nowrap top"><label>Retype passwod</label></th>
                    <td>
                        <input type="password" class="field2 size-200" value="" name="r[rpassword]" id="reg-rpassword">

                    </td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td class="mid">
                        <label class="radiobox mid" for="g-male"><input type="radio" class="top" id="g-male" value="1" name="r[gender]" {if isset($smarty.session.registrationData.gender) && $smarty.session.registrationData.gender == 1}checked="checked"{/if}> Male</label>
                        <br>
                        <label class="radiobox mid" for="g-female"><input type="radio" class="top" id="g-female" value="2" name="r[gender]" {if isset($smarty.session.registrationData.gender) && $smarty.session.registrationData.gender == 2}checked="checked"{/if}> Female</label>

                    </td>
                </tr>
                <tr><td colspan="2"><b class="form-tbl-sep">&nbsp;</b></td></tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>
                        <label class="ckeckbox-accent" for="terms"><input type="checkbox" class="top required" id="terms" value="1" name="r[terms]"> I agree to these <a target="_blank" href="/page/terms/"><b>Terms and Conditions</b></a></label>

                    </td>
                </tr>
                <tr><td colspan="2"><b class="form-tbl-sep">&nbsp;</b></td></tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                    {$recaptcha->getHtml()}
                    </td>
                </tr>
                <tr><td colspan="2"><b class="form-tbl-sep">&nbsp;</b></td></tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><button type="submit" class="find-btn upper size-120">Register me</button></td>
                </tr>
                </tbody></table>
        </form>
    </div>
</div>