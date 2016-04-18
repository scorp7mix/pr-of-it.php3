<?php

namespace App\Models;

use T4\Orm\Model;

/**
 * Class User
 * @package App\Models
 *
 * @property string $email
 * @property string $password
 * @property string $firstName
 * @property string $secondName
 * @property string $lastName
 * @property string $fullName
 */
class User
    extends Model
{
    protected static $schema = [
        'columns' => [
            'email'      => ['type' => 'string'],
            'password'   => ['type' => 'string'],
            'firstName'  => ['type' => 'string'],
            'secondName' => ['type' => 'string'],
            'lastName'   => ['type' => 'string'],
        ],
    ];

    /**
     * @template "$firstName $lastName"
     *
     */
    public function getFullName()
    {
        $reflector = new \ReflectionMethod($this, 'getFullName');
        preg_match_all('~@template "(.*)"~U', $reflector->getDocComment(), $matches);
        $template = $matches[1][0];
        preg_match_all('~\$(\w+)\b~U', $template, $matches);
        $tokens = $matches[0];
        $fields = $matches[1];

        $replaces = [];
        foreach ($fields as $k => $field) {
            if (!empty($this->$field)) {
                $replaces[$tokens[$k]] = $this->$field;
            }
        }

        return count($replaces) === count($fields) ? strtr($template, $replaces) : $this->email;
    }
}