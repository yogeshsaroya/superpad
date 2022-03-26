<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;
use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TeamsTable extends Table{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
    public function validationDefault(Validator $validator): Validator {
        $validator
        ->requirePresence("title")
        ->notEmptyString("title",'Please add page title.')

        ->requirePresence("heading")
        ->notEmptyString("heading",'Please add heading.')

        ->requirePresence("sub_heading")
        ->notEmptyString("sub_heading",'Please add sub heading.');

        return $validator;
    }

}