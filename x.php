<?php

$spryker = explode("\n", file_get_contents('spryker.csv'));
$magento = explode("\n", file_get_contents('magento.csv'));

$missing = array_diff($magento, $spryker);

echo sprintf("Missing: %s\n\n", count($missing));

foreach ($missing as $missingItem) {
    if (preg_match('/^[A-Z].*$/', $missingItem) !== 1) {
        continue;
    }

    echo sprintf("%s\n", $missingItem);
}
