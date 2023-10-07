<?php

namespace App\Controller;

use App\Entity\Action;
use App\Entity\ActionStatus;
use App\Repository\ActionStatusRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class ActionController extends AbstractController
{
    #[Route('/action-status/{id}', name: 'app_actions', methods:['get'])]
    public function actionStatus(ManagerRegistry $doctrine, string $id): JsonResponse
    {
        /** @var ActionStatus[] $actionStatuses */
        $actionStatuses = $doctrine
            ->getRepository(ActionStatus::class)
            ->findBy(['actorId' => $id]);

        if (empty($actionStatuses)) {
            $actionStatuses = $this->fillNewUser($doctrine, $id);
        }

        $tasks = [];
        $points = 0;

        /** @var ActionStatus $status */
        foreach ($actionStatuses as $actionStatus) {
            $action = $actionStatus->getAction();

            if ($actionStatus->getStatus() === 'done') {
                $points += $action->getPrice();
            }

            $tasks[] = [
                "name" => $action->getName(),
                "short_description" => $action->getShortDescription(),
                "full_description" => $action->getFullDescription(),
                "status" => $actionStatus->getStatus(),
                "progress" => $actionStatus->getProgress(),
                "price" => $action->getPrice(),
                "action_text" => $action->getActionText(),
                "due_time" => $action->getFinishDate()->getTimestamp(),
                "link" => $action->getlink(),
                "steps" => $action->getSteps()
            ];
        }

        return $this->json([
            "user_id" => $id,
            "points" => $points,
            "tasks" => $tasks
        ]);
    }

    #[Route('/action-trigger/{key}/{id}', name: 'app_trigger', methods:['post'])]
    public function actionTrigger(ManagerRegistry $doctrine, ActionStatusRepository $actionStatusRepository, string $key, string $id): JsonResponse
    {
        $actionStatus = $actionStatusRepository->findByKeyAndId($key, $id);
        if ($actionStatus === null) {
            return $this->json([], 404);
        }

        $currentValue = $actionStatus->getProgress() ?? 0;
        if ($currentValue === 0) {
            $actionStatus->setStatus("inProgres");
        }
        $actionStatus->setProgress($currentValue + 1);
        if ($actionStatus->getProgress() >= $actionStatus->getAction()->getGoal()) {
            $actionStatus->setStatus("done");
        }
        $doctrine->getManager()->persist($actionStatus);
        $doctrine->getManager()->flush();

        return $this->json([
            "status" => $actionStatus->getStatus(),
            "progress" => $actionStatus->getProgress(),
        ]);
    }

    /**
     * @return array | ActionStatus[]
     */
    private function fillNewUser(ManagerRegistry $doctrine, string $actorId): array
    {
        $actions = $doctrine
            ->getRepository(Action::class)
            ->findAll();

        $em = $doctrine->getManager();
        $returnValue = [];

        foreach ($actions as $action) {
            $actionStatus = new ActionStatus();
            $actionStatus->setStatus("new");
            $actionStatus->setActorId($actorId);
            $actionStatus->setAction($action);
            $returnValue[] = $actionStatus;

            $em->persist($actionStatus);
        }

        $em->flush();

        return $returnValue;
    }

}
