<?php
// Discord Bot not yet finished!
// We plan to add stop/start/restart/suspend vm for administrators



//CHECK OUT MYLIR.CO.UK
//CHECK OUT MYLIR.CO.UK
//CHECK OUT MYLIR.CO.UK
//CHECK OUT MYLIR.CO.UK
//CHECK OUT MYLIR.CO.UK
//CHECK OUT MYLIR.CO.UK
//CHECK OUT MYLIR.CO.UK
//CHECK OUT MYLIR.CO.UK
//CHECK OUT MYLIR.CO.UK
//CHECK OUT MYLIR.CO.UK
//CHECK OUT MYLIR.CO.UK


// Get the incoming payload
$payload = file_get_contents('php://input');

// Process the payload
$data = json_decode($payload, true);

// Retrieve relevant information from the payload
$event = $data['event'] ?? '';
$server = $data['data']['server'] ?? null;

// Retrieve the server status
$serverStatus = $server['state'] ?? '';

// Set the color based on the server status
$colorMapping = [
    'powered off' => 0xFF0000, // Red color
    'powered on' => 0x00FF00,  // Green color
    'restart' => 0x0000FF,     // Blue color
];

$embedColor = $colorMapping[$serverStatus] ?? 0xFFFF00; // Yellow color (default)

// Format the event name
$eventFormatted = ucwords(str_replace(".", " ", $event));

// Prepare the message to send to Discord
$message = "Notification received: **{$eventFormatted}**";

// Prepare additional server details
$serverDetails = '';
if ($server) {
    $serverName = $server['name'] ?? '';
    $serverId = $server['id'] ?? '';
    $serverDetails .= "**Server Name:** {$serverName}\n";
    $serverDetails .= "**Server ID:** {$serverId}\n";

    // Retrieve RAM and IP values if available
    $ip = $server['network']['interfaces'][0]['ipv4'][0]['address'] ?? '';


    $ram = $server['settings']['resources']['memory'] ?? '';
    if (!empty($ram)) {
    $serverDetails .= "**RAM:** {$ram} MB\n";
    }

    if (!empty($ip)) {
        $serverDetails .= "**Server IP:** {$ip}\n";
    }

    // Handle CPU details
    if (isset($server['cpu']) && is_array($server['cpu'])) {
        $cpuCores = $server['cpu']['cores'] ?? '';
        $cpuType = $server['cpu']['type'] ?? '';
        $cpuTypeExact = $server['cpu']['typeExact'] ?? '';
        $cpuShares = $server['cpu']['shares'] ?? '';
        $cpuThrottle = $server['cpu']['throttle'] ?? '';

        $cpuDetails = "**CPU Cores:** {$cpuCores}\n";
        $cpuDetails .= "**CPU Type:** {$cpuType}\n";
        $cpuDetails .= "**CPU Type Exact:** {$cpuTypeExact}\n";
        $cpuDetails .= "**CPU Shares:** {$cpuShares}\n";
        $cpuDetails .= "**CPU Throttle:** {$cpuThrottle}\n";

        $serverDetails .= $cpuDetails;
    }

    // Add more server details as needed
    // ...

    // Add the server details to the message
    $message .= "\n\n{$serverDetails}";
}

// Prepare the payload to send to Discord
$discordPayload = [
    'content' => null,
    'embeds' => [
        [
            'title' => null,
            'description' => $message,
            'color' => $embedColor,
        ],
    ],
    'components' => [
        [
            'type' => 1,
            'components' => [
                [
                    'type' => 2,
                    'style' => 2,
                    'label' => 'Stop',
                    'custom_id' => 'stop_button',
                ],
                [
                    'type' => 2,
                    'style' => 3,
                    'label' => 'Start',
                    'custom_id' => 'start_button',
                ],
            ],
        ],
    ],
    'allowed_mentions' => [
        'parse' => [],
    ],
];
// Convert the payload to JSON
$discordPayloadJson = json_encode($discordPayload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

// Set the Discord webhook URL
$discordWebhookUrl = '[WEBHOOK]';

// Prepare cURL options
$options = [
    CURLOPT_URL => $discordWebhookUrl,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $discordPayloadJson,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10,
];

// Send the payload to Discord
$ch = curl_init();
curl_setopt_array($ch, $options);
$response = curl_exec($ch);
curl_close($ch);

// Check the response
if ($response === false) {
    // Handle the error
    // ...
} else {
    // Process the response
    // ...

    // Get the message ID from the response
    $responseData = json_decode($response, true);
    $messageId = $responseData['id'] ?? null;

    if ($messageId) {
        // React to the message with stop and start emojis
        $discordReactionUrl = "https://discord.com/api/v9/channels/1128445574258114681/messages/{$messageId}/reactions";
        $discordToken = 'DiscordBot[Not Working!]';

        $stopEmoji = urlencode('⏹️');
        $startEmoji = urlencode('▶️');

        $reactions = [
            $stopEmoji,
            $startEmoji,
        ];

        foreach ($reactions as $reaction) {
            $reactionUrl = "{$discordReactionUrl}/{$reaction}/@me";

            $reactionOptions = [
                CURLOPT_URL => $reactionUrl,
                CURLOPT_PUT => true,
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bot ' . $discordToken,
                ],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 10,
            ];

            $ch = curl_init();
            curl_setopt_array($ch, $reactionOptions);
            $reactionResponse = curl_exec($ch);
            curl_close($ch);

            // Check the reaction response
            if ($reactionResponse === false) {
                // Handle the error
                // ...
            } else {
                // Process the reaction response
                // ...
            }
        }
    }
}
