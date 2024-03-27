<?php

namespace App\Tests\Generator;

use App\Entity\Task;
use App\Entity\User;
use App\Generator\UniqueStringGenerator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UniqueStringGeneratorTest extends KernelTestCase
{
    /**
     * @dataProvider getData
     */
    public function testGenerator($entity, string $expected)
    {
        self::bootKernel();
        $manager = self::getContainer()->get('doctrine')->getManager();
        $generator = self::getContainer()->get(UniqueStringGenerator::class);

        $output = $generator->generateId($manager, $entity);
        self::assertEquals($expected, substr($output, 0, strlen($expected)));
    }

    public function getData(): \Generator
    {
        yield 'User' => [new User(), "user_"];
        yield 'Task' => [new Task(), "tsk_"];
    }
}