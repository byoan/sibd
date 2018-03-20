<?php

return [
    'admin' => '*',
    'moderator' => array(
        'user' => array('select', 'delete', 'update')
    ),
    'specialist' => array(
        'horses' => array('select', 'update')
    ),
    'manager' => array(
        '*' => array('index')
    ),
    'autoTask' => array(
        '*' => array('shutdown', 'reload', 'process')
    ),
    'developer' => array(
        '*' => array('select', 'insert', 'update', 'delete')
    ),
    'developer' => array(
        '*' => array('select', 'insert', 'update', 'delete')
    ),
    'contestAdmin' => array(
        'contest' => array('select', 'insert', 'update', 'delete')
    ),
    'editor' => array(
        'newspaper' => array('select', 'insert', 'update', 'delete')
    ),
    'client' => array(
        'contest' => array('select'),
        'newspaper' => array('select')
    ),
];
