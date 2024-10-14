<?php

namespace TeamTeaTime\Forum\Events;

use TeamTeaTime\Forum\Events\Types\BaseEvent;

class UserReorderingCategories extends BaseEvent
{
    /** @var mixed */
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}
