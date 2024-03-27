<?php

namespace App\Generator;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Id\AbstractIdGenerator;

class UniqueStringGenerator extends AbstractIdGenerator
{

    /**
     * @inheritDoc
     */
    public function generateId(EntityManagerInterface $em, ?object $entity): string
    {
        $id = bin2hex(random_bytes(10));

        switch ($entity) {
            case $entity instanceof User:
                $prefix = "user_";
                break;
            case $entity instanceof Task:
                $prefix = "tsk_";
                break;
            default:
                $prefix = "xxx_";
                break;
        }

        return $prefix . $id;
    }
}