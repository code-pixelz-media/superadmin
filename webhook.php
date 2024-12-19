<?php
function receiveWebhook()
{
   
    $logFile = 'webhook.log';

    $rawPayload = file_get_contents('php://input');

    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Payload: " . $rawPayload . PHP_EOL, FILE_APPEND);

    $data = json_decode($rawPayload, true);


    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo "Invalid JSON payload";
        return;
    }

   
    if (isset($data['event'])) {
        file_put_contents($logFile, "Event: " . $data['event'] . PHP_EOL, FILE_APPEND);
    }

   
    http_response_code(200);
    echo "Webhook received successfully";
}

// Call the function to handle the incoming request
receiveWebhook();
?>