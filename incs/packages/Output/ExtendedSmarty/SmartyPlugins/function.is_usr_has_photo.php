<?php
function smarty_function_is_usr_has_photo($params, &$smarty){
	extract($params);
	if(empty($usr_id)){
		return false;
	}
	Reg::get('sql')=new MysqlQuery(Reg::get('db'));
	$qb = new QueryBuilder();
	$qb->select($qb->expr()->count(new Field('*'), 'count'))
		->from(Tbl::get('TBL_USERS_PHOTOS', 'UserPhotoManager'))
		->where($qb->expr()->equal(new Field('user_id'), $usr_id))
		->andWhere($qb->expr()->equal(new Field('status'), 1));
	Reg::get('sql')->exec($qb->getSQL());
	if(Reg::get('sql')->fetchField('count')){
		return true;
	}
	else{
		return false;
	}
}
