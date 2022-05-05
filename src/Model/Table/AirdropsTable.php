<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class AirdropsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
        
        ->notEmptyString("twitter",'Please enter twitter user name.')
        ->notEmptyString("telegram",'Please enter telegram user name .')
        ->notEmptyString("wallet_address",'Please enter wallet address.')
        ;
        return $validator;
    }

}
