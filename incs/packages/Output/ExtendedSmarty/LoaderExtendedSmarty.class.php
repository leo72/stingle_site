<?php
class LoaderExtendedSmarty extends Loader{
	protected function includes(){
		require_once ('Managers/ExtendedSmartyWrapper.class.php');
	}
	
	protected function loadExtendedSmarty(){
		$this->register(new ExtendedSmartyWrapper());
	}
}
