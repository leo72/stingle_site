<?php
class DependencyExtendedSmarty extends Dependency
{
	public function __construct(){
		$this->addPlugin("Output", "Smarty");
	}
}
