<?php

declare(strict_types=1);

if (isset($_SERVER['HTTP_ORIGIN'])) {
	header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 86400'); // cache for 1 day
}
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$methodOverride = $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] ?? '';
if ($method === 'POST' && $methodOverride !== '' && preg_match('#^[A-Z]+$#D', $methodOverride) === 1) {
	$method = $methodOverride;
}
if ($method === 'OPTIONS') {
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
		header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	}
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
		header('Access-Control-Allow-Headers: ' . $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']);
	}
	die;
}

header('Content-Type: application/json; charset=utf-8');

$products = [
	['id' => 3, 'name' => 'Matematika'],
	['id' => 4, 'name' => 'Fyzika'],
	['id' => 5, 'name' => 'Chemie'],
];

echo json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
