<?php

namespace App;

class TranslationCollection {
    private array $translations;
    private array $locales;

    public function __construct()
    {
        $this->translations = [];
        $this->locales = [];
    }

    public function add(string $section, string $locale, string $key, string $value): void
    {
        $this->translations[$section][$locale][$key] = $value;

        if (!array_key_exists($locale, $this->locales)) {
            $this->locales[$locale] = 0;
        }

        $this->locales[$locale]++;
    }

    public function getSections(): array
    {
        return array_keys($this->translations);
    }

    public function getSectionTranslations(string $section, string $locale): array
    {
        return $this->translations[$section][$locale] ?? [];
    }

    public function getLocales(): array
    {
        return array_keys($this->locales);
    }
}