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
        // $model will be used to compare the form data
        $expected = (new Contact())
            ->setFirstname($formData['firstname'])
            ->setLastname($formData['lastname'])
            ->setEmail($formData['email'])
            ->setContent($formData['content']);

        $form = $this->factory->create(ContactType::class, $model);

        // submit the data to the form directly
        $form->submit($formData);

        // This check ensures there are no transformation failures
        $this->assertTrue($form->isSynchronized());

        // check that $model was modified as expected when the form was submitted
        $this->assertEquals($expected, $model);

        // check that the form view has the expected fields
        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}