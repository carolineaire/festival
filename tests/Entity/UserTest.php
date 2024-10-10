<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetSetEmail()
    {
        $user = new User();
        $email = 'test@example.com';
        $user->setEmail($email);

        $this->assertEquals($email, $user->getEmail());
    }
    public function testGetSetRoles()
    {
        $user = new User();
        $roles = ['ROLE_ADMIN'];
        $user->setRoles($roles);
    
        $expectedRoles = ['ROLE_ADMIN', 'ROLE_USER'];
        $this->assertEquals($expectedRoles, $user->getRoles());
    }

    public function testGetSetPassword()
    {
        $user = new User();
        $password = 'password123';
        $user->setPassword($password);

        $this->assertEquals($password, $user->getPassword());
    }

    public function testGetSetFirstname()
    {
        $user = new User();
        $firstname = 'John';
        $user->setFirstname($firstname);

        $this->assertEquals($firstname, $user->getFirstname());
    }

    public function testGetSetLastname()
    {
        $user = new User();
        $lastname = 'Doe';
        $user->setLastname($lastname);

        $this->assertEquals($lastname, $user->getLastname());
    }

    public function testGetSetCity()
    {
        $user = new User();
        $city = 'Paris';
        $user->setCity($city);

        $this->assertEquals($city, $user->getCity());
    }

    public function testGetSetCountry()
    {
        $user = new User();
        $country = 'France';
        $user->setCountry($country);

        $this->assertEquals($country, $user->getCountry());
    }

    public function testGetSetPhone()
    {
        $user = new User();
        $phone = '1234567890';
        $user->setPhone($phone);

        $this->assertEquals($phone, $user->getPhone());
    }

    public function testGetSetAvatar()
    {
        $user = new User();
        $avatar = 'avatar.png';
        $user->setAvatar($avatar);

        $this->assertEquals($avatar, $user->getAvatar());
    }

    public function testGetSetUsername()
    {
        $user = new User();
        $username = 'johndoe';
        $user->setUsername($username);

        $this->assertEquals($username, $user->getUsername());
    }

    public function testGetSetRgpd()
    {
        $user = new User();
        $rgpd = true;
        $user->setRgpd($rgpd);

        $this->assertEquals($rgpd, $user->isRgpd());
    }


    public function testGetSetCreatedAt()
    {
        $user = new User();
        $createdAt = new \DateTimeImmutable();
        $user->setCreatedAt($createdAt);

        $this->assertEquals($createdAt, $user->getCreatedAt());
    }

    public function testGetSetOpption()
    {
        $user = new User();
        $opption = 'opt';
        $user->setOpption($opption);

        $this->assertEquals($opption, $user->getOpption());
    }
}