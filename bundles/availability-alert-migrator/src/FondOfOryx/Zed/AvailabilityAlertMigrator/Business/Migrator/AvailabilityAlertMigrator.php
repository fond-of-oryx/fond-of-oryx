<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Business\Migrator;

use FondOfOryx\Shared\AvailabilityAlertMigrator\AvailabilityAlertMigratorConstants;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Facade\AvailabilityAlertMigrationToAvailabilityAlertFacadeInterface;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorEntityManagerInterface;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorRepositoryInterface;
use Psr\Log\LoggerInterface;

class AvailabilityAlertMigrator implements AvailabilityAlertMigratorInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Facade\AvailabilityAlertMigrationToAvailabilityAlertFacadeInterface
     */
    protected $availabilityAlertFacade;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Facade\AvailabilityAlertMigrationToAvailabilityAlertFacadeInterface $availabilityAlertFacade
     * @param \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorRepositoryInterface $repository
     * @param \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorEntityManagerInterface $entityManager
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        AvailabilityAlertMigrationToAvailabilityAlertFacadeInterface $availabilityAlertFacade,
        AvailabilityAlertMigratorRepositoryInterface $repository,
        AvailabilityAlertMigratorEntityManagerInterface $entityManager,
        LoggerInterface $logger
    ) {
        $this->availabilityAlertFacade = $availabilityAlertFacade;
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * @return void
     */
    public function migrate(): void
    {
        $count = $this->repository->getSubscriptionCount();
        $offset = 0;

        do {
            $subscriptions = $this->repository->getAllSubscriptions($offset, AvailabilityAlertMigratorConstants::LIMIT);

            foreach ($subscriptions as $subscription) {
                $subscriptionResponse = $this->availabilityAlertFacade->subscribe($subscription);
                $marked = null;
                if ($subscriptionResponse->getIsSuccess() === true) {
                    $marked = $this->entityManager->setMigrated($subscription);
                }

                if ($marked !== null && $subscriptionResponse->getSubscription() !== null) {
                    $this->logger->info(sprintf('Migration %s as %s was successful!', $marked, $subscriptionResponse->getSubscription()->getIdAvailabilityAlertSubscription()));

                    continue;
                }
                $this->logger->error(sprintf('Migration incomplete! Wrote new entry "%s" updated old entry "%s"', $subscriptionResponse->getIsSuccess(), $marked));
            }

            $offset += AvailabilityAlertMigratorConstants::LIMIT;
            $count -= AvailabilityAlertMigratorConstants::LIMIT;
        } while ($count >= 0);
    }
}
