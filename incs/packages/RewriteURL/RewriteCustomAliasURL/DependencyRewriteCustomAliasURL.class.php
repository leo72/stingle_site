<?php
class DependencyRewriteCustomAliasURL extends Dependency
{
	public function __construct(){
		$this->addPlugin("RewriteURL", "RewriteAliasURL");
		$this->addPlugin("Gps");
	}
}
