<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EmailTemplatesTable extends Table{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
    public function validationDefault(Validator $validator): Validator {
        $validator
        ->notEmptyString("type",'Please add Type.')
        ->notEmptyString("subject",'Please add Subject.')
        ->notEmptyString("message",'Please add Message Body.');
        
        return $validator;
    }

}