<?php
class LoaderRewriteCustomAliasURL extends Loader{
	protected function includes(){
		require_once ('Managers/RewriteCustomAliasURL.class.php');
	}
	
	protected function loadrewriteCustomAliasURL(){
		$rewriteURLconfig = $this->packageManager->getPluginConfig("RewriteURL", "RewriteURL")->AuxConfig;
		$rewriteAliasURLconfig = $this->packageManager->getPluginConfig("RewriteURL", "RewriteAliasURL");
		$hostConfig = ConfigManager::getConfig("Host","Host");
		
		$this->rewriteAliasURL =  new RewriteCustomAliasURL($rewriteURLconfig, Reg::get($rewriteAliasURLconfig->Objects->aliasMap)->getAliasMap(Reg::get($hostConfig->Objects->Host)));
		$this->register($this->rewriteAliasURL);
	}
}
