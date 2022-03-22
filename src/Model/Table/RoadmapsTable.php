<?php
namespace App\Model\Table;
use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RoadmapsTable extends Table{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
    public function validationDefault(Validator $validator): Validator {
        $validator

        ->requirePresence("date")
        ->notEmptyString("date", "Date is required")
        ->add("date", ['unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Date is already in use']])

        ->requirePresence("description")
        ->notEmptyString("description", "Description is required");

        return $validator;
    }

}