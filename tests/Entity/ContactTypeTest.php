<?php

namespace App\Tests\Form;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Form\Test\TypeTestCase;

class ContactTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john.doe@example.com',
            'content' => 'This is a test message.',
            'agreeTerms' => true,
        ];

        $model = new Contact();
        // $model sera utilisé pour comparer les données du formulaire
        $expected = (new Contact())
            ->setFirstname($formData['firstname'])
            ->setLastname($formData['lastname'])
            ->setEmail($formData['email'])
            ->setContent($formData['content']);

        $form = $this->factory->create(ContactType::class, $model);

        // soumettre les données directement au formulaire
        $form->submit($formData);

        // Cette vérification garantit qu'il n'y a pas d'échecs de transformation
        $this->assertTrue($form->isSynchronized());

        // vérifier que $model a été modifié comme prévu lorsque le formulaire a été soumis
        $this->assertEquals($expected, $model);

        // vérifier que la vue du formulaire contient les champs attendus
        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}