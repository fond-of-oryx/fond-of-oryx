<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Business\Migrator;

use Codeception\Test\Unit;
use FondOfOryx\Shared\AvailabilityAlertMigrator\AvailabilityAlertMigratorConstants;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Facade\AvailabilityAlertMigratorToAvailabilityAlertFacadeBridge;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorEntityManager;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorRepository;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Monolog\Logger;

class AvailabilityAlertMigratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Facade\AvailabilityAlertMigratorToAvailabilityAlertFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $availabilityAlertFacadeMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loggerMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertMigrator\Business\Migrator\AvailabilityAlertMigrator
     */
    protected $migrator;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->availabilityAlertFacadeMock = $this->getMockBuilder(AvailabilityAlertMigratorToAvailabilityAlertFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->repositoryMock = $this->getMockBuilder(AvailabilityAlertMigratorRepository::class)->disableOriginalConstructor()->getMock();
        $this->entityManagerMock = $this->getMockBuilder(AvailabilityAlertMigratorEntityManager::class)->disableOriginalConstructor()->getMock();
        $this->loggerMock = $this->getMockBuilder(Logger::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionResponseTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionResponseTransfer::class)->disableOriginalConstructor()->getMock();

        $this->migrator = new AvailabilityAlertMigrator(
            $this->availabilityAlertFacadeMock,
            $this->repositoryMock,
            $this->entityManagerMock,
            $this->loggerMock,
        );
    }

    /**
     * @return void
     */
    public function testMigrate(): void
    {
        $this->repositoryMock->expects(static::once())->method('getSubscriptionCount')->willReturn(1);
        $this->repositoryMock->expects(static::once())->method('getAllSubscriptions')->willReturn([$this->subscriptionTransferMock]);
        $this->availabilityAlertFacadeMock->expects(static::once())->method('subscribe')->willReturn($this->subscriptionResponseTransferMock);
        $this->subscriptionResponseTransferMock->expects(static::once())->method('getIsSuccess')->willReturn(true);
        $this->subscriptionResponseTransferMock->expects(static::exactly(2))->method('getSubscription')->willReturn($this->subscriptionTransferMock);
        $this->entityManagerMock->expects(static::once())->method('setMigrated')->willReturn(12);
        $this->subscriptionTransferMock->expects(static::once())->method('getIdAvailabilityAlertSubscription')->willReturn(12);
        $this->loggerMock->expects(static::once())->method('info');
        $this->loggerMock->expects(static::never())->method('error');

        $this->migrator->migrate();
    }

    /**
     * @return void
     */
    public function testMigrateSubscribeWillFail(): void
    {
        $this->repositoryMock->expects(static::once())->method('getSubscriptionCount')->willReturn(1);
        $this->repositoryMock->expects(static::once())->method('getAllSubscriptions')->willReturn([$this->subscriptionTransferMock]);
        $this->availabilityAlertFacadeMock->expects(static::once())->method('subscribe')->willReturn($this->subscriptionResponseTransferMock);
        $this->subscriptionResponseTransferMock->expects(static::exactly(2))->method('getIsSuccess')->willReturn(false);
        $this->subscriptionResponseTransferMock->expects(static::never())->method('getSubscription');
        $this->entityManagerMock->expects(static::never())->method('setMigrated');
        $this->subscriptionTransferMock->expects(static::never())->method('getIdAvailabilityAlertSubscription');
        $this->loggerMock->expects(static::never())->method('info');
        $this->loggerMock->expects(static::once())->method('error');

        $this->migrator->migrate();
    }

    /**
     * @return void
     */
    public function testMigrateSubscribeWillSucceedButCantUpdateOldEntry(): void
    {
        $this->repositoryMock->expects(static::once())->method('getSubscriptionCount')->willReturn(1);
        $this->repositoryMock->expects(static::once())->method('getAllSubscriptions')->willReturn([$this->subscriptionTransferMock]);
        $this->availabilityAlertFacadeMock->expects(static::once())->method('subscribe')->willReturn($this->subscriptionResponseTransferMock);
        $this->subscriptionResponseTransferMock->expects(static::exactly(2))->method('getIsSuccess')->willReturn(true);
        $this->subscriptionResponseTransferMock->expects(static::never())->method('getSubscription')->willReturn($this->subscriptionTransferMock);
        $this->entityManagerMock->expects(static::once())->method('setMigrated');
        $this->subscriptionTransferMock->expects(static::never())->method('getIdAvailabilityAlertSubscription')->willReturn(1);
        $this->loggerMock->expects(static::never())->method('info');
        $this->loggerMock->expects(static::once())->method('error');

        $this->migrator->migrate();
    }

    /**
     * @return void
     */
    public function testMigrateLimit(): void
    {
        $this->repositoryMock->expects(static::once())->method('getSubscriptionCount')->willReturn(1);
        $entries = AvailabilityAlertMigratorConstants::LIMIT + 50;
        $subscription = [];
        for ($i = 0; $i < $entries; $i++) {
            $subscription[$i] = $this->subscriptionTransferMock;
        }
        $this->repositoryMock->expects(static::once())->method('getAllSubscriptions')->willReturn($subscription);
        $this->availabilityAlertFacadeMock->expects(static::exactly($entries))->method('subscribe')->willReturn($this->subscriptionResponseTransferMock);
        $this->subscriptionResponseTransferMock->expects(static::exactly($entries))->method('getIsSuccess')->willReturn(true);
        $this->subscriptionResponseTransferMock->expects(static::exactly($entries * 2))->method('getSubscription')->willReturn($this->subscriptionTransferMock);
        $this->entityManagerMock->expects(static::exactly($entries))->method('setMigrated')->willReturn(12);
        $this->subscriptionTransferMock->expects(static::exactly($entries))->method('getIdAvailabilityAlertSubscription')->willReturn(12);
        $this->loggerMock->expects(static::exactly($entries))->method('info');
        $this->loggerMock->expects(static::never())->method('error');

        $this->migrator->migrate();
    }
}
