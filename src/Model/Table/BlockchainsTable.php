<?php
namespace App\Model\Table;
use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class BlockchainsTable extends Table{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
    public function validationDefault(Validator $validator): Validator {
        $validator

        ->requirePresence("name")
        ->notEmptyString("name", "Name is required")
        ->add("name", ['unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Name is already in use']])

        ->requirePresence("short_name")
        ->notEmptyString("short_name", "Short name is required")
        ->add("short_name", ['unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Short name is already in use']]);

        return $validator;
    }

}