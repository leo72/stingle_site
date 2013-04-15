<?php
/**
 * Class for user Validation
 */
class UserValidation{

	private $errors = array();
	private $birthdate = null;
	private $userMgr;

//	private $regExpNormalString 	= "/^([^\,\/\\\\\"\[\]\{\}\~\@\#\$\%\^\&\*\(\)\:\;\?<>\+\=\!\`]{3,30})$/isu";
	private $regExpNormalString 	= "/^([\w\.\-\s\']{3,20})$/isu";
	private $regExpUsername 		= "/^(?!.*p-)[\w.-]{3,20}$/isu"; //"/^([\w\.\-]{3,20})$/isu";
	
	public function __construct(){
		$this->userMgr = Reg::get(ConfigManager::getConfig('Users', 'Users')->Objects->UserManager);
	}

	public function checkRelationType($relationType){
		return $this->isEmpty($relationType, ERR_INC_RELATION);
	}
	
	public function checkLicence($licence){
		return $this->isEmpty($licence, ERR_INC_LICENSE);
	}
	
	public function checkSex($sex){
		return $this->isEmpty($sex, ERR_INC_SEX);
	}
	
	public function checkCountry($country){
		return $this->isEmpty($country, ERR_INC_COUNTRY);
	}
	
	public function checkZipcode($zip){
		return $this->isEmpty($zip, ERR_INC_ZIPCODE);
	}

	public function checkFirstName($firstName){
		return $this->checkNormalString($firstName, $this->regExpNormalString, ERR_WRONG_FIRST_NAME);
	}
	
	public function checkLastName($lastName){
		return $this->checkNormalString($lastName, $this->regExpNormalString, ERR_WRONG_LAST_NAME);
	}
	
	public function checkEmail($email){
		if(empty($email)){
			$this->addError(ENTER_EMAIL);
			return false;
		}
		if(!valid_email($email)){
			$this->addError(ERR_INC_EMAIL);
			return false;
		}
		return true;
	}
	
	public function checkEmailExist($email){
		$filter = new UsersFilter(false);
		$filter->setEmail($email);
		if($this->userMgr->getUsersListCount($filter)){
			$this->addError(ERR_MAIL_EXISTS);
			return false;
		}
		return true;
	}
	
	public function isMailFromCompany($email){
		$mailTemplate = Reg::get('textsValMgr')->getTextValue('company_mail', 'config'); 
		if(preg_match('/'.$mailTemplate.'/', $email)){
			return true;
		}
		return false;
	}
	
	/**
	 * Check given passwords
	 *
	 * @param string $pass1
	 * @param string $pass2
	 */
	public function checkPasswords($password, $confirmPass){
		$this->checkPasswordRequirements($password);
		if(empty($confirmPass)){
			$this->addError(ERR_ENTER_PASS2);
		}
		if($password !== $confirmPass){
			$this->addError(ERR_PASS_NOT_PASS2);
		}	
	}
	
	/**
	 * Check password Requirements
	 * @param String $password
	 */
	public function checkPasswordRequirements($password){
		if(strlen($password) < 6){
			$this->addError(ERR_INC_PASS_LEN);
		}
	}

	/**
	 * Check given looking for age range
	 *
	 * @param int $fromAge
	 * @param int $toAge
	 */
	public function checkLookingAge($fromAge, $toAge){
		if(empty($fromAge) or empty($toAge) or !is_numeric($fromAge) or !is_numeric($toAge) or $fromAge > $toAge){
			$this->addError(ERR_INC_FROM_TO_AGE);
			return false;
		}
		return true;
	}
	
	/**
	 * Check birthdate of type Month/Day/Year
	 * Adds errors if some happen
	 *
	 * @param string $birthDate Month/Day/Year
	 * @return bool
	 */
	public function checkBirthDate($birthDate){
		$array = explode('/', $birthDate);
		if(count($array)==3){
			list($bdMonth, $bdDay, $bdYear) = $array;
		}
		else{
			$this->addError(ERR_ENTER_BDATE);
			return false;
		}
		if(empty($bdYear) or empty($bdMonth) or empty($bdDay) or !is_numeric($bdYear) or !is_numeric($bdMonth) or !is_numeric($bdDay)){
			$this->addError(ERR_ENTER_BDATE);
			return false;
		}
		elseif(!checkdate($bdMonth, $bdDay, $bdYear)){
			$this->addError(ERR_INC_BIRTH_DATE);
			return false;
		}
		return true;
	}
	
	public function isOlderThan18($birthDate){
		$array = explode('/', $birthDate);
		if(count($array)==3){
			list($bdMonth, $bdDay, $bdYear) = $array;
			$utime = strtotime($bdYear . '-' . $bdMonth . '-' . $bdDay);
			$bd = date(DEFAULT_DATE_FORMAT, $utime);
			$my_age = get_age($bd);
			if($my_age < 18) {
				$this->addError(ERR_BDATE_SMALL_18);
				return false;
			}
			if($my_age > 99) {
				$this->addError(ERR_INC_BIRTH_DATE);
				return false;
			}
		}
		else{
			return false;
		}
		return true;
	}
	
	public function checkUsername($username){
		if(!$this->isEmpty($username, ERR_INC_USERNAME)){
			return false;
		}
		if(!$this->checkNormalString($username, $this->regExpUsername, ERR_ENTER_USERNAME)){
			return false;
		}
		return true;
	}
	
	public function checkUserExists($username){
		if($this->userMgr->isUserExists($username,0)){
			$this->addError(ERR_USER_EXISTS);
			return false;
		}
		return true;
	}
	
	/**
	 * Check Pass date of type Year-Month-Day
	 * @param string $passDate Year-Month-Day
	 */
	public function checkPassDate($passDate){
		if(empty($passDate)){
			$this->addError(ERR_EMPTY_PASS);
			return false;
		}
		else{
			$return = true;
			$array = explode('-', $passDate);
			if(count($array)==3){
				list($pYear, $pMonth, $pDay) =  $array;
				if(empty($pYear)){
					$this->addError(ERR_EMPTY_PASS_YEAR);
					$return = false;
				}
				elseif($pYear < date('Y')){
					$this->addError(ERR_WRONG_YEAR);
					$return = false;
				}
		
				if(empty($pMonth)){
					$this->addError(ERR_EMPTY_PASS_MONTH);
					$return = false;
				}
				elseif($pYear == date('Y') and $pMonth < date('n')){
					$this->addError(ERR_WRONG_MON);
					$return = false;
				}
		
				if(empty($pDay)){
					$this->addError(ERR_EMPTY_PASS_DAY);
					$return = false;
				}
				elseif($pYear == date('Y') and $pMonth == date('n') and $pDay < date('j')){
					$this->addError(ERR_WRONG_DAY);
					$return = false;
				}
			}
			else{
				$this->addError(ERR_WRONG_PASS);
				$return = false;
			}
			return $return;
		}
	}
	
	public function hasError(){
		if (empty($this->errors)){
			return false;
		}
		return true;
	}

	public function getErrors(){
		return $this->errors;
	}

	private function addError($errorConst){
		array_push($this->errors,$errorConst);
	}
	
	/**
	 * Check string to have only UNICODE alphanum 
	 *
	 * @param string $fieldName
	 * @param string $fieldValue
	 */
	private function checkNormalString($string, $regex, $errorMessage){
		if(!preg_match($regex, $string)){
			$this->addError($errorMessage);
			return false;
		}
		return true;
	}
	
	private function isEmpty($value, $errorMessage){
		if(empty($value)){
			$this->addError($errorMessage);
			return false;
		}
		return true;
	}
}
