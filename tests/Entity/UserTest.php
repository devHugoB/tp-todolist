<?php

namespace App\Tests\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

class UserTest extends KernelTestCase
{
    public function getEntity(): User
    {
        return (new User())
            ->setEmail("email@test.fr")
            ->setPassword("123");
    }

    public function assertHasErrors(User $entity, int $number = 1)
    {
        self::bootKernel();
        $errors = self::getContainer()->get('validator')->validate($entity);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error) {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }

        $this->assertCount($number, $errors, implode(', ', $messages));
    }

    public function testValidEntity()
    {
        $this->assertHasErrors($this->getEntity(), 0);
    }

    public function testInvalidEmail()
    {
        $user = $this->getEntity();

        // Assert\Email
        $user->setEmail("wrong");
        $this->assertHasErrors($user);

        // UniqueEntity
        // DataFixtures/UserFixtures.php
        $user->setEmail("hugo@gmail.com");
        $this->assertHasErrors($user);
    }
}