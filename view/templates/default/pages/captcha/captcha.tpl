<div class="bodyContainer PM{$module}{*$page*} {if isAuthorized()}userOn{/if}">
	<!-- Srart Main Container -->
	<div class="mainContainer">
		<div id="Header" style="margin: 10px 0;"><a href="http://www.edesirs.com/"><img src="{'edesirs_error.gif'|img}" alt=""></a></div>
		<div id="Content">
			<div class="contentContainer">
				<div class="contentContainerInsider">
					<div class="Top"></div>
					<div class="Content">
						<div style="padding:20px;">
							<div class="captchMessage" style="font-size: 1.2em; padding-bottom: 30px;">{'FILL_CAPTCHA'|C}</div>
							{if $error}
								<h3 style="font-size: 1.3em; color: #990000; margin: 0 .2em 0em; font-weight: normal;">
									{'INCORRECT_CAPTCHA'|C}
								</h3>
							{/if}
							<form action="" method="post" class="uniForm">
								<script type="text/javascript">
									var RecaptchaOptions = {
										lang : '{$lang}',
										theme: 'white'
									};
								</script>
								{$recaptcha->getHtml()}
								<div style="margin: 2px 5px;"><input type="submit" class="submitBtn btn btnBlue" value="submit" /></div>
							</form>
						</div>
					</div>
					<div class="Bottom"></div>
				</div>
				<div class="contentContainerEnd"></div>
			</div>
		</div>
	</div>
</div>