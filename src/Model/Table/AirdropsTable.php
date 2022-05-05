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
        ->requirePresence("twitter")
        ->notEmptyString("twitter", "Please enter twitter user name.")
        ->add("twitter", ['unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Twitter user name is already in use']])

        ->requirePresence("telegram")
        ->notEmptyString("telegram", "Please enter telegram user name.")
        ->add("telegram", ['unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Telegram user name is already in use']])

        ->requirePresence("wallet_address")
        ->notEmptyString("wallet_address", "Please enter BSC Wallet Address.")
        ->add("wallet_address", ['unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'BSC Wallet Address is already in use']]);
        return $validator;
    }

}
