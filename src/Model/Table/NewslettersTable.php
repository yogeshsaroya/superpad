<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;


use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;



class NewslettersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
    
    public function validationDefault(Validator $validator): Validator {
        $validator
        
        ->requirePresence("email")
        ->notEmptyString("email", "Email is required")
        ->add("email", [
            'unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Email address is already in use'],
            "valid_email" => ["rule" => ["email"],"message" => "Email Address is not valid"]]);       
        return $validator;
    }



}