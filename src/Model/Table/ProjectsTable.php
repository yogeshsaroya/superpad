<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProjectsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Blockchains');
        $this->hasMany('Teams',['sort'=>['Teams.position ASC'] ]);
        $this->hasMany('Partners');
        $this->hasMany('SmAccounts');
        $this->hasMany('Applications');
    }

    public function validationDefault(Validator $validator): Validator
    {
        // adding model validation for fields
        $validator
            ->requirePresence("title")
            ->notEmptyString("title", "Title is required")
            ->minLength("title", 3, "Title must be 3-20 characters")
            ->maxLength("title", 20, "Title must be 3-20 characters")
            ->add("title", ['unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Project title is already in use']])

            ->requirePresence("coin_id")
            ->allowEmptyString("coin_id", "Coin ID is required")
            ->minLength("coin_id", 3, "Coin ID must be 3-20 characters")
            ->maxLength("coin_id", 20, "Coin ID must be 3-20 characters")
            ->add("coin_id", ['unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Coin ID already in use']])

            ->requirePresence("ticker")
            ->notEmptyString("ticker", "Ticker name is required")
            ->minLength("ticker", 3, "Ticker name must be 3-20 characters")
            ->maxLength("ticker", 20, "Ticker name must be 3-20 characters")
            ->add("ticker", ['unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Ticker is already in use']])


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
