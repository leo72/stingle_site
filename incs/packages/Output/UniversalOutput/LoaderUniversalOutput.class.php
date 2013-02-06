<?php
class LoaderUniversalOutput extends Loader{
	protected function includes(){
		require_once ('Managers/UniversalOutput.class.php');
	}
	
	protected function loadUniversalOutput(){
		$this->register(new UniversalOutput());
	}
	
	public function hookMainOutput(){
		Reg::get($this->config->Objects->UniversalOutput)->output();
	}
}
