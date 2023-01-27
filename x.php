<?php

use GuzzleHttp\Client;

require_once 'vendor/autoload.php';

$json = file_get_contents('./dandelion.json');
$dandelion = json_decode($json, true);
$httpClient = new Client();
$token = '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';

foreach ($dandelion['repositories'] as $repositoryName => $repositoryInfo) {
    echo sprintf("Remove tag \"%s\" from \"%s\"\n", $repositoryName, $repositoryInfo['version']);

    $url = sprintf(
        'https://api.github.com/repos/fond-of-oryx/%s/git/refs/tags/%s',
        $repositoryName,
        $repositoryInfo['version'],
    );

    try {
        $response = $httpClient->request('DELETE', $url, [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $token),
            ],
        ]);

        if ($response->getStatusCode() === 204) {
            echo "Removed tag successfully.\n";

            continue;
        }
    } catch (Throwable $exception) {
    }

    echo "Could not remove tag.\n\n";
}
