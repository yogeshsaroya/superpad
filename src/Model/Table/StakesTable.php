<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;
use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class StakesTable extends Table{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
        
        $this->belongsTo( 'unStakes', [
            'foreignKey' => 'stake_id',
            'className' => 'Stakes'
        ]);    

    }
    public function validationDefault(Validator $validator): Validator {
        $validator
        ->requirePresence("days")
        ->notEmptyString("days",'Please add Days.');
       
        return $validator;
    }

}