<div class="basic-box">
    <div class="basic-box-head"><span class="basic-box-title">Forgotten password</span></div>
    <div class="basic-box-content c">
        <form action="{'auth/action:fpass'|glink}" method="post">
            <input type="hidden" name="key" value="{$formKey->getKey()}">
            <table cellspacing="0" class="form-tbl infinite">
                <tbody>
                <tr>
                    <th class="top"><label>Email</label></th>
                    <td>
                        <input type="text" class="field2 size-300" value="" name="passEmail">
                        <br>
                        <span class="frm-comment">Email message will be send with new password</span>
                    </td>
                </tr>
                <tr><td colspan="2"><b class="form-tbl-sep">&nbsp;</b></td></tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><button type="submit" class="find-btn upper size-200">Send new password</button></td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<p>You do not have an account? <a href="{'auth/registration/'|glink}"><b>Registration</b></a></p>