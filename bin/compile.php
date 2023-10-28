<?php

require_once __DIR__ . "/../vendor/autoload.php";

use App\TranslationCollection;


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
foreach ($collection->getLocales() as $locale) {
    $localeDir = "output/{$locale}";
    if (!file_exists($localeDir)) {
        mkdir($localeDir, recursive: true);
    }

    foreach ($collection->getSections() as $section) {
        $file = "{$section}_{$locale}";
        $data = [$file => $collection->getSectionTranslations($section, $locale)];

        $fileContent = "$file = {\n";

        foreach ($collection->getSectionTranslations($section, $locale) as $key => $value) {
            $fileContent .= "    $key = \"$value\"\n";
        }

        $fileContent .= "}";

        file_put_contents(
            "output/{$locale}/{$file}.txt",
            $fileContent
        );
    }
}
