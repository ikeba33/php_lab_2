<?php

namespace core;

class Language {
    private static $languages = [
        'uk' => [
            'name' => 'Українська',
            'locale' => 'uk-UA'
        ],
        'ru' => [
            'name' => 'Русский',
            'locale' => 'ru-RU'
        ],
        'en' => [
            'name' => 'English',
            'locale' => 'en-US'
        ],
        'it' => [
            'name' => 'Italian',
            'locale' => 'it-IT'
        ]
    ];

    private static $translations = [
        'uk-UA' => [
            'admin' => 'адмін',
            'client' => 'клієнт',
            'manager' => 'менеджер',
            'hello_message' => 'Вітаю {role}: {name}',
            'logout' => 'Покинути сайт'
        ],
        'ru-RU' => [
            'admin' => 'админ',
            'client' => 'клиент',
            'manager' => 'менеджер',
            'hello_message' => 'Здравствуйте {role}: {name}',
            'logout' => 'Выйти'
        ],
        'en-US' => [
            'admin' => 'admin',
            'client' => 'client',
            'manager' => 'manager',
            'hello_message' => 'Hello {role}: {name}',
            'logout' => 'Log Out'
        ],
        'it-IT' => [
            'admin' => 'admin (Italy)',
            'client' => 'client (Italy)',
            'manager' => 'manager (Italy)',
            'hello_message' => 'Aloha {role}: {name} (Italy)',
            'logout' => 'Log Out (Italy)'
        ]
    ];

    private static $current_translation = null;

    public static function getAllLanguages() {
        return self::$languages;
    }

    // Установить язык
    public function setCurrentLanguage($lang) {
        if(isset(self::$languages[$lang]['locale']) && isset(self::$translations[self::$languages[$lang]['locale']])) {
            setlocale(LC_ALL, self::$languages[$lang]['locale']);
            self::$current_translation = self::$translations[self::$languages[$lang]['locale']];
        } else {
            die('Not supported language');
        }
    }

    // Перевести переменую
    public function translate($text, $variables = []) {
        if(isset(self::$current_translation[$text])) {
            return str_replace(array_keys($variables), array_values($variables), self::$current_translation[$text]);
        } else {
            return $text;
        }
    }
    
}