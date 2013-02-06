<?php
/**
 * UniversalOutput will give output in HTML or JSON
 * Decision is made by looking on $_GET['ajax'] parameter.
 * If $_GET['ajax'] == 1 then ouput is given in JSON format.
 * Otherwise HTML is being outputed.
 */
class UniversalOutput extends Model{
	
	const STATUS_NOK = 'nok';
	const STATUS_OK = 'ok';
	
	private $jsFiles = array();
	private $jsSmartFiles = array();
	
	private $cssFiles = array();
	private $cssSmartFiles = array();
	
	private $parts = array();
	private $vars = array();
	
	private $redirectUrl = null;
	
	private $status = self::STATUS_OK;
	
	
	public function setStatusOk(){
		$this->setStatus(self::STATUS_OK);
	}
	
	public function setStatusNotOk(){
		$this->setStatus(self::STATUS_NOK);
	}
	
	public function setStatus($status){
		if(!in_array($status, self::getConstsArray("STATUS"))){
			throw new InvalidArgumentException("Invalid \$status given");
		}
		$this->status = $status;
	}
	
	public function getStatus(){
		return $this->status;
	}
	
	public function addJs($fileName){
		if(empty($fileName)){
			throw new InvalidArgumentException("\$fileName is empty");
		}
		array_push($this->jsFiles, $fileName);
	}
	
	public function addJsSmart($fileName){
		if(empty($fileName)){
			throw new InvalidArgumentException("\$fileName is empty");
		}
		array_push($this->jsSmartFiles, $fileName);
	}
	
	public function addCss($fileName){
		if(empty($fileName)){
			throw new InvalidArgumentException("\$fileName is empty");
		}
		array_push($this->cssFiles, $fileName);
	}
	
	public function addCssSmart($fileName){
		if(empty($fileName)){
			throw new InvalidArgumentException("\$fileName is empty");
		}
		array_push($this->cssSmartFiles, $fileName);
	}
	
	public function set($partName, $partValue){
		if(empty($partName)){
			throw new InvalidArgumentException("\$partName is empty");
		}
		$this->parts[$partName] = $partValue;
	}
	
	public function assign($var, $value){
		Reg::get('smarty')->assign($var, $value);
	}
	
	public function redirect($url){
		$this->redirectUrl = $url;
	}
	
	public function output(){
		if(isset($_GET['ajax']) && $_GET['ajax'] == 1){
			$output = array();
			$output['parts'] = array();
			foreach($this->parts as $partName => $partValue){
				$output['parts'][$partName] = $partValue;
			}
			if(!isset($output['parts']['main'])){
				try{
					$main = Reg::get('smarty')->output(true);
					if($main != null){
						$output['parts']['main'] = $main;
					}
				}
				catch(TemplateFileNotFoundException $e){
					Reg::get('error')->add($e->getMessage());
				}
			}
			$output['scripts'] = array();
			$output['css'] = array();
			foreach($this->jsFiles as $fileName){
				array_push($output['scripts'], Reg::get('smarty')->getJsPath($fileName));
			}
			foreach($this->jsSmartFiles as $fileName){
				array_push($output['scripts'], Reg::get('smarty')->getJsPathSmart($fileName));
			}
			foreach($this->cssFiles as $fileName){
				array_push($output['css'], Reg::get('smarty')->getCssPath($fileName));
			}
			foreach($this->cssSmartFiles as $fileName){
				array_push($output['css'], Reg::get('smarty')->getCssPathSmart($fileName));
			}
			
			if($this->redirectUrl !== null){
				$output['redirect'] = $this->redirectUrl;
			}
			
			$output['infos'] = Reg::get('info')->getAll();
			$output['errors'] = Reg::get('error')->getAll();
			
			$output['status'] = $this->status;
			
			JSON::jsonOutput($output);
		}
		else{
			if($this->redirectUrl !== null){
				redirect($this->redirectUrl);
			}
			
			foreach($this->parts as $partName => $partValue){
				Reg::get('smarty')->assign($partName, $partValue);
			}
			
			foreach($this->jsFiles as $fileName){
				Reg::get('smarty')->addJs($fileName);
			}
			foreach($this->jsSmartFiles as $fileName){
				Reg::get('smarty')->addJsSmart($fileName);
			}
			foreach($this->cssFiles as $fileName){
				Reg::get('smarty')->addCss($fileName);
			}
			foreach($this->cssSmartFiles as $fileName){
				Reg::get('smarty')->addCssSmart($fileName);
			}
			
			Reg::get('smarty')->output();
		}
	}
}
