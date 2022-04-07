<?php

namespace App\Model\Table;
use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class LevelsTable extends Table{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
    public function validationDefault(Validator $validator): Validator {
        $validator
        ->requirePresence("title")
        ->notEmptyString("title",'Please add page title.');
       
        return $validator;
    }

}