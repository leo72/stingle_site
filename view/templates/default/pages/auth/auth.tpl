<div class="basic-box">
    <div class="basic-box-head"><span class="basic-box-title">Login into Find Armenian Map</span></div>
    <div class="basic-box-content c">
        {if isInProductionMode()}
            <form action="{'auth/action:login'|glink}" method="post">
        {else}
            <form action="{'auth/action:login'|glink}" method="post">
        {/if}
                <input type="hidden" name="key" value="{$formKey->getKey()}">
                <table cellspacing="0" class="form-tbl infinite">
                    <tbody><tr>
                        <th>Email</th>
                        <td>
                            <input type="text" class="field2 size-200" value="" name="lemail">
                        </td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td>
                            <input type="password" class="field2 size-200" value="" name="lpassword">
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <label><input type="checkbox" value="1" name="remember"> Remember me</label>
                        </td>
                    </tr>
                    <tr><td colspan="2"><b class="form-tbl-sep">&nbsp;</b></td></tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><button type="submit" class="find-btn upper size-120">Login</button></td>
                    </tr>
                    </tbody>
                </table>
            </form>
    </div>
</div>
<p>If you can not login in your account try <a class="b" href="{'auth/fpass/'|glink}">Forgotten password</a></p>
<p>You do not have an account? <a href="{'auth/registration/'|glink}"><b>Registration</b></a></p>
