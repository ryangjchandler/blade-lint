<?php

use RyanChandler\BladeLint\Rules;

return [

    'rules' => [
        Rules\VerifyForelseHasEmpty::class,
        Rules\DisallowRawEcho::class,
    ]

];
