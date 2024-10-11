<?php

use PHPUnit\Framework\TestCase;
use App\Controller\HelloController;

class HelloControllerTest extends TestCase
{
    public function testHelloWorld()
    {
        $helloController = new HelloController();
        $result = $helloController->helloWorld();

        $this->assertEquals('Hello, World!', $result);
    }
}

?>