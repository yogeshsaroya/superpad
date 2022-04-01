<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;
use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SmAccountsTable extends Table{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
    public function validationDefault(Validator $validator): Validator {
        $validator
        
        ->requirePresence("type")
        ->notEmptyString("type",'Please select media type.')


        ->requirePresence("heading")
        ->notEmptyString("heading",'Please add heading.')

        ->requirePresence("sub_heading")
        ->notEmptyString("sub_heading",'Please add sub heading.')

        ->requirePresence("link")
        ->notEmptyString("link",'Please add account link.');
        
        
        return $validator;
    }


}