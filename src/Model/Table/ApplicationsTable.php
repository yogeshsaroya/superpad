<?php
namespace App\Model\Table;
use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ApplicationsTable extends Table{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Projects');
    }

    public function validationDefault(Validator $validator): Validator {
        $validator

        ->requirePresence("twitter")
        ->notEmptyString("twitter", "Twitter handel url is required")

        ->requirePresence("telegram")
        ->notEmptyString("telegram", "Telegram handle is required");

        return $validator;
    }

}