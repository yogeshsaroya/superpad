<?php

namespace App\Model\Table;
use Cake\ORM\Table;

class PaymentsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Projects');
        $this->belongsTo('Users');
        $this->belongsTo('Applications');
    }

}
