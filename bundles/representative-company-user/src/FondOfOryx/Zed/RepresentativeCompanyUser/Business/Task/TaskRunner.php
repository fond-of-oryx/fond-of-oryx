<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business\Task;

use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserExtension\Dependency\Plugin\RepresentativeCompanyUserTaskCommandPluginInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserCommandTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;

class TaskRunner implements TaskRunnerInterface
{
    /**
     * @var array<\FondOfOryx\Zed\RepresentativeCompanyUserExtension\Dependency\Plugin\RepresentativeCompanyUserTaskCommandPluginInterface>
     */
    protected $tasks;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface $entityManager
     * @param array<\FondOfOryx\Zed\RepresentativeCompanyUserExtension\Dependency\Plugin\RepresentativeCompanyUserTaskCommandPluginInterface> $tasks
     */
    public function __construct(RepresentativeCompanyUserEntityManagerInterface $entityManager, array $tasks)
    {
        $this->tasks = $tasks;
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserCommandTransfer $commandTransfer
     *
     * @return void
     */
    public function runTask(RepresentativeCompanyUserCommandTransfer $commandTransfer): void
    {
        $resources = $commandTransfer->getResources();

        $filter = (new RepresentativeCompanyUserFilterTransfer())->setIds($commandTransfer->getIds());

        foreach ($this->tasks as $task) {
            if (count($resources) === 0) {
                $this->handleRepresentations($task, $filter);

                continue;
            }

            if (in_array($task->getName(), $resources)) {
                $this->handleRepresentations($task, $filter);
            }
        }
    }

    /**
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserExtension\Dependency\Plugin\RepresentativeCompanyUserTaskCommandPluginInterface $plugin
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filter
     *
     * @return void
     */
    protected function handleRepresentations(RepresentativeCompanyUserTaskCommandPluginInterface $plugin, RepresentativeCompanyUserFilterTransfer $filter): void
    {
        $plugin->run($filter);
    }

    /**
     * @return array<string>
     */
    public function getRegisteredProcessorNames(): array
    {
        $names = [];
        foreach ($this->tasks as $task) {
            $names[] = $task->getName();
        }

        return $names;
    }
}
