<?php

return array(
    'worker/add' => 'worker/add',
    'payment/([0-9]+)' => 'payment/view/$1',
    '([0-9]+)/([0-9]+)' => 'workers/calendar/$1/$2',
    '' => 'workers/index', 
);
