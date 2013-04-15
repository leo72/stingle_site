<?php
class LoaderUserValidation extends Loader{
	protected function includes(){
		require_once ('Managers/UserValidation.class.php');
	}
	
	protected function customInitBeforeObjects(){
		Tbl::registerTableNames('UserValidation');
	}
	
	protected function loadUserValidation(){
		$this->register(new UserValidation());
	}
}
