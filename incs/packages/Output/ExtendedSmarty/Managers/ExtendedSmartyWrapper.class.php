<?php
class ExtendedSmartyWrapper extends SmartyWrapper {

	public function addPrimaryJsSmart($fileName, $fromTop = false) {
		$this->addJsAtPosSmart($fileName, static::PRIMARY, $fromTop);
	}
	
	public function addJsSmart($fileName, $fromTop = false) {
		$this->addJsAtPosSmart($fileName, static::SECONDARY, $fromTop);
	}
	
	public function addJsAtPosSmart($fileName, $position = null, $fromTop = false){
		if(empty($fileName)){
			throw new InvalidArgumentException("JS filename is not specified");
		}
		if($position === null){
			$position = static::PRIMARY;
		}
		
		if(!isset($this->jsFiles[$position]) or !is_array($this->jsFiles[$position])){
			$this->jsFiles[$position] = array();
		}

		$originalFilename = str_replace("/", "(slash)", $fileName);
		
		$filePath = Reg::get('rewriteURL')->glink("get/js/name:" . base64_encode($fileName) . "/path:" . base64_encode($this->getCurrentPagePath()) . "/originalName:$originalFilename");
		
		if($fromTop){
			array_splice($this->jsFiles[$position], 0, 0, $filePath);
		}
		else{
			array_push($this->jsFiles[$position], $filePath);
		}
	}
	
	public function getJsPathSmart($fileName){
		if(empty($fileName)){
			throw new InvalidArgumentException("JS filename is not specified");
		}
		$originalFilename = str_replace("/", "(slash)", $fileName);
		return Reg::get('rewriteURL')->glink("get/js/name:" . base64_encode($fileName) . "/path:" . base64_encode($this->getCurrentPagePath()) . "/originalName:$originalFilename");
	}
	
	public function addPrimaryCssSmart($fileName, $fromTop = false) {
		$this->addCssAtPosSmart($fileName, static::PRIMARY, $fromTop);
	}
	
	public function addCssSmart($fileName, $fromTop = false) {
		$this->addCssAtPosSmart($fileName, static::SECONDARY, $fromTop);
	}
	
	public function addCssAtPosSmart($fileName, $position = null, $fromTop = false){
		if(empty($fileName)){
			throw new InvalidArgumentException("CSS filename is not specified");
		}
		if($position === null){
			$position = static::PRIMARY;
		}
		
		if(!isset($this->cssFiles[$position]) or !is_array($this->cssFiles[$position])){
			$this->cssFiles[$position] = array();
		}
		
		$originalFilename = str_replace("/", "(slash)", $fileName);
		
		$filePath = Reg::get('rewriteURL')->glink("get/css/name:" . base64_encode($fileName) . "/path:" . base64_encode($this->getCurrentPagePath()) . "/originalName:$originalFilename");
		
		if($fromTop){
			array_splice($this->cssFiles[$position], 0, 0, $filePath);
		}
		else{
			array_push($this->cssFiles[$position], $filePath);
		}
	}
	
	public function getCssPathSmart($fileName){
		if(empty($fileName)){
			throw new InvalidArgumentException("CSS filename is not specified");
		}
		$originalFilename = str_replace("/", "(slash)", $fileName);
		return Reg::get('rewriteURL')->glink("get/css/name:" . base64_encode($fileName) . "/path:" . base64_encode($this->getCurrentPagePath()) . "/originalName:$originalFilename");
	}
	
	private function getCurrentPagePath(){
		$levels = ConfigManager::getConfig("RewriteURL", "RewriteURL")->AuxConfig->levels->toArray();
		$pagePath = Reg::get('smarty')->pagesPath;
		for($i = 0; $i < count($levels); $i++){
			$level = $levels[$i];
			if(isset(Reg::get('nav')->$level) and !empty(Reg::get('nav')->$level)){
				$pagePath .= Reg::get('nav')->$level . '/';
			}
			if(isset($levels[$i+1]) and !is_dir($this->getFilePathFromTemplate($pagePath . Reg::get('nav')->$levels[$i+1], true))){
				break;
			}
		}
		
		return $pagePath;
	}
}
