<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;
use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EmailTemplatesTable extends Table{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
    public function validationDefault(Validator $validator): Validator {
        $validator
        ->notEmptyString("name",'Please add Name.')
        ->notEmptyString("title",'Please add Title.')
        ->notEmptyString("about",'Please add About.')
        ->notEmptyString("biography",'Please add biography.')
        ->notEmptyString("experience",'Please add experience.');
        
        return $validator;
    }

}