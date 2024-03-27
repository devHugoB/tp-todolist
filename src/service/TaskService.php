<?php

namespace App\service;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class TaskService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    /**
     * Sauvegarde la nouvelle tâche dans la base de données
     *
     * @param Task $task
     * @param User $user
     * @return void
     */
    public function createTask(Task $task, User $user): void
    {
        $task->setUser($user);

        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }

    /**
     * Met à jour la tâche en vérifiant si elle est fini ou pas
     *
     * @param Task $task
     * @return void
     */
    public function updateTask(Task $task): void
    {
        if ($task->isFinished()) {
            $task->setFinishedAt(new \DateTimeImmutable());
        }

        $this->entityManager->flush();
    }
}