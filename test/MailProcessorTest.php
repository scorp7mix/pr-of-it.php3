<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../protected/boot.php';
require __DIR__ . '/../protected/autoload.php';

class MailProcessorTest
    extends PHPUnit_Framework_TestCase
{
    public function testValidateName()
    {
        \T4\Console\Application::instance()->setConfig(new \T4\Core\Config(ROOT_PATH_PROTECTED . '/config.php'));
        $mailer = new \App\Components\MailProcessor();

        $reflector = new ReflectionMethod($mailer, 'validateEmail');
        $reflector->setAccessible(true);

        $this->assertEquals(true, $reflector->invoke($mailer, 'scorp7mix@gmail.com'));
        $this->assertEquals(false, $reflector->invoke($mailer, 'scorp7mix.gmail.com'));
    }
}
