<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{ 
	
	
	public function initialize(array $config)
    {
        $this->belongsTo('Usergroup',['foreignKey'=>'USR_GROUP']);
    }


    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required');
	
           
    }

}
?>