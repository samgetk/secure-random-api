<?php
require_once '../utils/utils.php';

use General\Utils;

header('Content-Type: application/json');

class SecureRandomController
{
    public static function generate(int $min, int $max)
    {
        if ($min > $max) {
            http_response_code(400);
            echo json_encode(["error" => "'min' cannot be greater than 'max'."]);
            exit;
        }
        return Utils::getSecureRandom($min, $max);
    }
}

$response = ["randomNumber" => null];
http_response_code(200);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $min = filter_input(INPUT_GET, 'min', FILTER_VALIDATE_INT);
    $max = filter_input(INPUT_GET, 'max', FILTER_VALIDATE_INT);

    if ($min === null || $max === null) {
        http_response_code(400);
        echo json_encode(["error" => "'min' and 'max' are required and must be integers."]);
        exit;
    }

    $response["randomNumber"] = SecureRandomController::generate($min, $max);
    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(["error" => "Only GET method allowed."]);
}
