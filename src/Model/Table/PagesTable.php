<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;
use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PagesTable extends Table{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
    public function validationDefault(Validator $validator): Validator {
        $validator
        ->notEmptyString("title",'Please add page title.')
        ->notEmptyString("description",'Please add page description.')
        ->notEmptyString("slug",'Please add page url.');
        
        return $validator;
    }

}