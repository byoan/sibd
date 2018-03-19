<?php

return [
    'admin' => '*',
    'moderator' => array(
        'user' => array('delete', 'update')
    ),
    'specialist' => array(
        'horses' => array('select', 'update')
    )
];
