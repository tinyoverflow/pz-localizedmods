<?php

namespace App;

class TranslationWriter
{
    private string $outputDirectory;

    public function __construct(string $outputDirectory)
    {
        $this->outputDirectory = $outputDirectory;
    }

    public function write(string $locale, string $section, array $data): bool
    {
        $filePath = $this->buildPath($this->outputDirectory, $locale, "{$section}_{$locale}.txt");
        $directoryPath = dirname($filePath);

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, recursive: true);
        }

        $file = fopen($filePath, 'w+');
        $success = !!fwrite($file, $this->buildFileContent($locale, $section, $data));
        fclose($file);

        return $success;
    }

    private function buildFileContent(string $locale, string $section, array $data): string
    {
        $sanitizedSection = str_replace('_', '', $section);
        $fileContent = "{$sanitizedSection}_{$locale} = {\n";

        foreach ($data as $key => $value) {
            $fileContent .= "    $key = \"$value\"\n";
        }

        $fileContent .= "}";

        return mb_convert_encoding($fileContent, 'Windows-1252');
    }

    private function buildPath(string...$parts): string
    {
        $path = "";

        $lastIndex = sizeof($parts) - 1;
        foreach ($parts as $index => $part) {
            $path .= $part;

            if ($index != $lastIndex) {
                $path .= DIRECTORY_SEPARATOR;
            }
        }

        return $path;
    }
}