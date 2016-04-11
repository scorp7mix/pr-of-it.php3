<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../protected/boot.php';
require __DIR__ . '/../protected/autoload.php';

class UserTest
    extends PHPUnit_Framework_TestCase
{
    public function testFullName()
    {
        $user1 = new \App\Models\User(['firstName' => 'Иван', 'secondName' => 'Иванович', 'lastName' => 'Иванов', 'email' => 'ivanov@example.com']);
        $user2 = new \App\Models\User(['firstName' => 'Иван', 'lastName' => 'Иванов', 'email' => 'ivanov@example.com']);
        $user3 = new \App\Models\User(['firstName' => 'Иван', 'secondName' => 'Иванович', 'email' => 'ivanov@example.com']);

        $this->assertEquals('Иван Иванович Иванов', $user1->fullName);
        $this->assertEquals('Иван Иванов', $user2->fullName);
        $this->assertEquals('ivanov@example.com', $user3->fullName);

        $user1->secondName = '';

        $this->assertEquals('Иван Иванов', $user1->fullName);

        $user1->offsetUnset('lastName');

        $this->assertEquals('ivanov@example.com', $user1->fullName);
    }
}
