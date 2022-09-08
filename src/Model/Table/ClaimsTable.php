<?php
namespace App\Model\Table;
use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ClaimsTable extends Table{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Projects');
        $this->belongsTo('Users');
        $this->belongsTo('Applications');
        
    }
}