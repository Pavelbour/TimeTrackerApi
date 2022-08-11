<?php

$dbName = getenv('POSTGRES_DB');
$dbUser = getenv('POSTGRES_USER');
$dbPassword = getenv('POSTGRES_PASSWORD');

return [
    'class' => 'yii\db\Connection',
    'dsn' => "pgsql:host=db;dbname=$dbName",
    'username' => $dbUser,
    'password' => $dbPassword,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
