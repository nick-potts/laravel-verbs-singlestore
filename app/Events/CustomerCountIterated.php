<?php

namespace App\Events;

use App\States\CustomerState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

class CustomerCountIterated extends Event
{

    public function __construct(
        #[StateId(CustomerState::class)]
        public int   $customer_id
    )
    {
    }

    public function apply(CustomerState $state) {
        $state->count++;
    }
}
