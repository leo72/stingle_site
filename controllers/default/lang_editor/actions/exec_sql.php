<?php
Reg::get('formKey')->validate((isset($_POST['key']) ? $_POST['key'] : null));

if(isset($_POST['sql'])){
	$queries = preg_split("/;+(?=([^'|^\\\']*['|\\\'][^'|^\\\']*['|\\\'])*[^'|^\\\']*[^'|^\\\']$)/", $_POST['sql']);
	$errors = array();
	$finished = array();
	
	Reg::get('sql')->exec("SELECT @@AUTOCOMMIT AS ac");
	
	if(Reg::get('sql')->fetchField("ac") == 1){
		$rollback_autocommit = true;
		Reg::get('sql')->exec("SET AUTOCOMMIT = 0");
	}
	Reg::get('sql')->exec("START TRANSACTION");
	
	foreach($queries as $query){
		if(strlen(trim($query)) > 0){
			try{
				Reg::get('sql')->exec(mysql_real_escape_string($query));
				array_push($finished, array('aff_rows' => Reg::get('sql')->affected(), 'query' => $query));
			}
			catch(MySqlException $e){
				$errors[] = array('query' => $query, 'error' => $e->getMessage(), 'errno' => $e->getCode());
				
				Reg::get('sql')->exec("ROLLBACK");
				if(isset($rollback_autocommit)){
					Reg::get('sql')->exec("SET AUTOCOMMIT = 1");
				}
				break;
			}
		}
	}
	
	Reg::get('sql')->exec("COMMIT");
	if(isset($rollback_autocommit)){
		Reg::get('sql')->exec("SET AUTOCOMMIT = 1");
	}
	
	if(count($errors)==0){
		deleteMemcacheKeys("LanguageManager");
	}
	
	Reg::get('smarty')->assign('errors', $errors);
	Reg::get('smarty')->assign('finished', $finished);
}

redirect(Reg::get('rewriteURL')->glink("lang_editor/sql/"));

