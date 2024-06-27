<?php

namespace App\Events;

use App\States\CustomerState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

class CustomerBeganTrial extends Event
{
    #[StateId(CustomerState::class, autofill: true)]
    public int|null $customer_id = null;

    public function apply(): void
    {
        for ($i = 0; $i < 5; $i++) {
            CustomerCountIterated::fire(customer_id: $this->customer_id);
        }
    }
}
