<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2.local',
    'username' => 'root',
    'password' => '123456',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600 * 24 * 7,
    'schemaCache' => 'cache',
];
