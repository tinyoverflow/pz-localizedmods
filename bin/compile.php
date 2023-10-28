<?php

require_once __DIR__ . "/../vendor/autoload.php";

use App\TranslationCollection;
use App\TranslationWriter;


$files = glob('data/**/*.json');
$collection = new TranslationCollection();

// Iterate Files
foreach ($files as $file) {
    $section = basename($file, '.json');

    // Read file
    $json = json_decode(
        json: file_get_contents($file),
        associative: true,
        flags: JSON_OBJECT_AS_ARRAY & JSON_BIGINT_AS_STRING
    );

    // Iterate Translation Keys
    foreach (array_keys($json) as $key) {

        // Iterate Translation Values
        foreach ($json[$key] as $language => $value) {
            $collection->add($section, $language, $key, $value);
        }
    }
}

// Write Files
$writer = new TranslationWriter('output');
foreach ($collection->getLocales() as $locale) {
    foreach ($collection->getSections() as $section) {
        $translations = $collection->getSectionTranslations($section, $locale);

        if (empty($translations)) {
            continue;
        }

        $writer->write($locale, $section, $translations);
    }
}
