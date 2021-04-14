<?php

class I18n {
    protected array $sets;
    protected string $locale;


    public function __construct(string $locale) {
        $this->locale = $locale;
        $this->sets = [
            "en" => include "./locales/en.php",
            "fr" => include "./locales/fr.php",
        ];
    }

    public function __invoke ( ...$values ) : string {
        if(count($values) > 1 || count($values) === 0) {
            return "Invalid arguments passed to i18n";
        }

        $keys = explode('.', $values[0]);
        $pointer = $this->sets[$this->locale];

        foreach ($keys as $key) {
            if(!array_key_exists($key, $pointer)) {
                return "[$values[0]]";
            }

            $pointer = $pointer[$key];
        }

        return $pointer;
    }
}
