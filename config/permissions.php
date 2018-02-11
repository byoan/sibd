<?php

return [
    'admin' => '*',
    'moderator' => array(
        'user' => array('delete', 'update')
    ),
    'specialist' => array(
        'horse' => array('select', 'update')
    )
];
