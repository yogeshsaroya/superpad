<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;
use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PagesTable extends Table{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
    public function validationDefault(Validator $validator): Validator {
        $validator
        ->requirePresence("title")
        ->notEmptyString("title",'Please add page title.')

        ->requirePresence("description")
        ->notEmptyString("description",'Please add page description.')
        
        ->requirePresence("slug")
            ->notEmptyString("slug", "Slug is required")
            ->minLength("slug", 3, "Last name must be 3-20 characters")
            ->maxLength("slug", 20, "Last name must be 3-20 characters")
            ->add("slug", ['unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Slug is already in use']])
            ->add('slug', 'validRole', [
                'rule' => 'isValidRole',
                'message' => __('You need to provide a valid Slug'),
                'provider' => 'table',
            ]);
        
        return $validator;
    }


    public function isValidRole($value, array $context)
    {
        if (preg_match('/^[a-z][-a-z0-9]*$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

}