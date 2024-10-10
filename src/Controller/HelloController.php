<?php



namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;



class HelloController extends AbstractController

{

    // Existing methods



    public function helloWorld(): string

    {

        return 'Hello, World!';

    }

}

?>