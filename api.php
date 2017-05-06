<?php

require(__DIR__ . '/vendor/autoload.php');

use MongoDB\Client;

$return = function ($response = [], $code = 200) {
    header('Content-Type:Application/json; Charset=utf-8');
        die(json_encode([
            'code'    => $code,
            'message' => 'OK',
            'result'  => $response
        ],JSON_UNESCAPED_UNICODE)
    );
};

$mongo = function ($host = 'mongodb://127.0.0.1:27017', $database = 'env-loose') {
    $client = new Client($host);
    $database = $client->selectDatabase($database);
    return $database;
};

$loadEnv = function () {
    return parse_ini_file(__DIR__ . '/.env', true);
};

$request = json_decode(
    file_get_contents('php://input'),
    true
);

/*-------------- operation data ------------*/

if ($request['api'] === 'getProject') {
    $name = $loadEnv()['project']['name'];
    if (! $name) {
        return [];
    }
    foreach ($name as &$v) {
        $value = $v;
        $v = [];
        $v['value'] = $value;
        $v['label'] = $value;
    }
    unset($v);
    $return([
        'list' => $name
    ]);
}

$host = $loadEnv()['mongo']['host'];

if ($request['api'] === 'get') {
    $res = $mongo($host)->data->findOne([
        'env'     => $request['env'],
        'project' => $request['project']
    ]);
    if (! $res) {
        $res['checkbox'] = [];
    }
    $return([
        'checkbox' => $res['checkbox']
    ]);
}

if ($request['api'] === 'update') {
    $res = $mongo($host)->data->findOne([
        'env'     => $request['env'],
        'project' => $request['project']
    ]);
    if (! $res) {
        $res = $mongo($host)->data->insertOne([
            'env'     => $request['env'],
            'project' => $request['project'],
            'checkbox' => $request['checkbox']
        ]);
        $return();
    }

    $res = $mongo($host)->data->findOneAndUpdate([
        'env'     => $request['env'],
        'project' => $request['project']
        ],
        [
        '$set' => ['checkbox' => $request['checkbox']]
        ]
    );

    if (! $res) {
        $return([], 500);
    }

    $return();
}
