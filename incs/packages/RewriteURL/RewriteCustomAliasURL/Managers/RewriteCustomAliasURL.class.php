<?php
class RewriteCustomAliasURL extends RewriteAliasURL{
	
	/**
	 * @return string
	 */
	protected function parseCustomAliases($uri){
		$uri = $this->parseCustom($uri);
		return $uri;
	}
	
	private function parseCustom($uri){
		
		self::ensureLastSlash($uri);
		
		// Do something with $uri
		
		return $uri;
	} 
}
