<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;


use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;



class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Countries');
    }
    
    public function validationDefault(Validator $validator): Validator
    {
        // adding model validation for fields
        $validator
        ->requirePresence("first_name")
        ->notEmptyString("first_name", "First name is required")
        ->minLength("first_name", 3, "First name must be 3-20 characters")
        ->maxLength("first_name", 20, "First name must be 3-20 characters")

        ->requirePresence("last_name")
        ->notEmptyString("last_name", "Last name is required")
        ->minLength("last_name", 3, "Last name must be 3-20 characters")
        ->maxLength("last_name", 20, "Last name must be 3-20 characters")
        
        ->requirePresence("email")
        ->notEmptyString("email", "Email is required")
        ->add("email", [
            'unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Email address is already in use'],
            "valid_email" => ["rule" => ["email"],"message" => "Email Address is not valid"]])


        ->requirePresence("password")
        ->notEmptyString("password", "Password is required")
        ->minLength("password", 6, "Password must be 6-20 characters")
        ->maxLength("password", 20, "Password must be 6-20 characters");
        
        return $validator;
    }

    public function validationOnlyCheck(Validator $validator) {
        $validator = $this->validationDefault($validator);
        $validator->remove('password');
        return $validator;
    }


    public function validationOnlyKyc(Validator $validator) {
        $validator
        ->notEmptyString("kyc_full_name", "Full name is required")
        ->notEmptyString("kyc_dob", "Date of birth is required")
        ->notEmptyString("kyc_address", "Address is required")
        ->notEmptyString("kyc_city", "City is required")
        ->notEmptyString("kyc_state", "State is required")
        ->notEmptyString("country_id", "Country is required")
        ->notEmptyString("kyc_doc_type", "Document type is required");
        
        
        return $validator;
    }

    public function beforeSave(EventInterface $event){
        
        
    }

}