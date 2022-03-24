<?php
namespace App\Model\Table;
use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class FeaturesTable extends Table{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
    public function validationDefault(Validator $validator): Validator {
        $validator
        ->notEmptyString("heading",'Please add heading.')
        ->notEmptyString("sub_heading",'Please add sub heading.');
        return $validator;
    }

}