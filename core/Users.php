<?php

namespace core;

class Users {

    const ROLE_CLIENT = 'client';
    const ROLE_MANAGER = 'manager';
    const ROLE_ADMIN = 'admin';

    private $users = [];
    private $current_user = null;
    private $instance = null;

    public function __construct(){
        $this->users = [ // Заполнение данными массив
                [
                    'login' => 'user1',
                    'password' => '12345678',
                    'first_name' => 'Afanasiy',
                    'last_name' => 'Afdotiev',
                    'lang' => 'uk',
                    'role' => self::ROLE_CLIENT
                ],
                [
                    'login' => 'user2',
                    'password' => '12345678',
                    'first_name' => 'Afanasiy2',
                    'lang' => 'en',
                    'last_name' => 'Afdotiev2',
                    'role' => self::ROLE_MANAGER
                ],
                [
                    'login' => 'user3',
                    'password' => '12345678',
                    'first_name' => 'Afanasiy3',
                    'last_name' => 'Afdotiev3',
                    'role' => self::ROLE_ADMIN
                ],        
            ];
    }

    // Получить пользователя по логину и паролю.
    public function getUserFromLoginAndPassword($login, $password) {

        $user = array_filter($this->users, function($value) use($login, $password) {
            return $value['login'] == $login && $value['password'] == $password;
        });

        if(empty($user)) return null;

        $user = current($user);

        // для каждой роли свой класс
        $class = '\\classes\\' . $user['role'];

        // инициализация обьекта для конкретной роли
        $instance = new $class();
        $instance->current_user = $user;
        $this->instance = $instance;

        return $this->instance;;
    }

    public function getLogin() {
        return $this->current_user['login'];
    }

    public function getPassword() {
        return $this->current_user['password'];
    }

    public function getFirstName() {
        return $this->current_user['first_name'];
    }

    public function getLastName() {
        return $this->current_user['last_name'];
    }

    public function getFullName() {
        return $this->current_user['first_name'] . ' ' . $this->current_user['last_name'];
    }

    public function setLang($lang) {
        $this->current_user['lang'] = $lang;
    }

    public function getLang() {
        return isset($this->current_user['lang']) ? $this->current_user['lang'] : null;
    }

    public function getRole() {
        return $this->current_user['role'];
    }

    public function isClient() {
        return $this->current_user['role'] == self::ROLE_CLIENT;
    }

    public function isManager() {
        return $this->current_user['role'] == self::ROLE_MANAGER;
    }

    public function isAdmin() {
        return $this->current_user['role'] == self::ROLE_ADMIN;
    }

    public function getMessage() {
        return 'hello_message';
    }
}