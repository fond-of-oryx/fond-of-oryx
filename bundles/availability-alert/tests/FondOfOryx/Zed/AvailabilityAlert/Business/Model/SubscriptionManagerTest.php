<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriberPluginExecutor;
use FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriptionPluginExecutor;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreBridge;
use FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertEntityManager;
use FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertRepository;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionCollectionTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\StoreTransfer;

class SubscriptionManagerTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriberTransferMock;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $collectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriptionPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionPluginExecutor;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriberPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriberPluginExecutor;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionManagerInterface
     */
    protected $manager;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->subscriptionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->subscriberTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriberTransfer::class)->disableOriginalConstructor()->getMock();
        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)->disableOriginalConstructor()->getMock();
        $this->collectionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionCollectionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->entityManagerMock = $this->getMockBuilder(AvailabilityAlertEntityManager::class)->disableOriginalConstructor()->getMock();
        $this->repositoryMock = $this->getMockBuilder(AvailabilityAlertRepository::class)->disableOriginalConstructor()->getMock();
        $this->storeFacadeMock = $this->getMockBuilder(AvailabilityAlertToStoreBridge::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionPluginExecutor = $this->getMockBuilder(AvailabilityAlertSubscriptionPluginExecutor::class)->disableOriginalConstructor()->getMock();
        $this->subscriberPluginExecutor = $this->getMockBuilder(AvailabilityAlertSubscriberPluginExecutor::class)->disableOriginalConstructor()->getMock();

        $this->manager = new SubscriptionManager($this->entityManagerMock, $this->repositoryMock, $this->storeFacadeMock, $this->subscriptionPluginExecutor, $this->subscriberPluginExecutor);
    }

    /**
     * @return void
     */
    public function testIsAlreadySubscribedWillReturnTrue(): void
    {
        $this->subscriptionTransferMock->expects(static::once())->method('requireSubscriber');
        $this->subscriptionTransferMock->expects(static::once())->method('requireFkProductAbstract');
        $this->subscriptionTransferMock->expects(static::once())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('getFkProductAbstract')->willReturn(1);
        $this->subscriberTransferMock->expects(static::once())->method('requireEmail');
        $this->subscriberTransferMock->expects(static::once())->method('getEmail')->willReturn('unit@test.com');
        $this->repositoryMock->expects(static::once())->method('findSubscriptionByEmailAndIdProductAbstractAndStatus')->willReturn($this->subscriptionTransferMock);

        $response = $this->manager->isAlreadySubscribed($this->subscriptionTransferMock);

        static::assertTrue($response);
    }

    /**
     * @return void
     */
    public function testIsAlreadySubscribedWillReturnFalse(): void
    {
        $this->subscriptionTransferMock->expects(static::once())->method('requireSubscriber');
        $this->subscriptionTransferMock->expects(static::once())->method('requireFkProductAbstract');
        $this->subscriptionTransferMock->expects(static::once())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('getFkProductAbstract')->willReturn(1);
        $this->subscriberTransferMock->expects(static::once())->method('requireEmail');
        $this->subscriberTransferMock->expects(static::once())->method('getEmail')->willReturn('unit@test.com');
        $this->repositoryMock->expects(static::once())->method('findSubscriptionByEmailAndIdProductAbstractAndStatus')->willReturn(null);

        $response = $this->manager->isAlreadySubscribed($this->subscriptionTransferMock);

        static::assertFalse($response);
    }

    /**
     * @return void
     */
    public function testSubscribeAndCreateSubscriber(): void
    {
        $this->subscriptionTransferMock->expects(static::once())->method('requireFkProductAbstract');
        $this->subscriptionTransferMock->expects(static::once())->method('requireFkLocale');
        $this->subscriptionTransferMock->expects(static::once())->method('requireFkStore');
        $this->subscriptionTransferMock->expects(static::once())->method('requireSubscriber');
        $this->subscriptionTransferMock->expects(static::once())->method('getFkSubscriber')->willReturn(null);
        $this->subscriptionTransferMock->expects(static::once())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('setSubscriber')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('setSentAt')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('setStatus')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('setFkSubscriber')->willReturn($this->subscriptionTransferMock);
        $this->subscriberTransferMock->expects(static::once())->method('requireEmail');
        $this->subscriberTransferMock->expects(static::once())->method('getIdAvailabilityAlertSubscriber')->willReturn(1);
        $this->subscriptionPluginExecutor->expects(static::once())->method('executePreSavePlugins')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionPluginExecutor->expects(static::once())->method('executePostSavePlugins')->willReturn($this->subscriptionTransferMock);
        $this->entityManagerMock->expects(static::once())->method('createOrUpdateSubscription')->willReturn($this->subscriptionTransferMock);
        $this->entityManagerMock->expects(static::once())->method('createOrUpdateSubscriber')->willReturn($this->subscriberTransferMock);
        $this->repositoryMock->expects(static::never())->method('findSubscriberById')->willReturn($this->subscriberTransferMock);
        $this->subscriberPluginExecutor->expects(static::once())->method('executePreSavePlugins')->willReturn($this->subscriberTransferMock);
        $this->subscriberPluginExecutor->expects(static::once())->method('executePostSavePlugins')->willReturn($this->subscriberTransferMock);

        $this->manager->subscribe($this->subscriptionTransferMock, false);
    }

    /**
     * @return void
     */
    public function testSubscribeAndUpdateSubscriber(): void
    {
        $this->subscriptionTransferMock->expects(static::once())->method('requireFkProductAbstract');
        $this->subscriptionTransferMock->expects(static::once())->method('requireFkLocale');
        $this->subscriptionTransferMock->expects(static::once())->method('requireFkStore');
        $this->subscriptionTransferMock->expects(static::never())->method('requireSubscriber');
        $this->subscriptionTransferMock->expects(static::exactly(2))->method('getFkSubscriber')->willReturn(1);
        $this->subscriptionTransferMock->expects(static::never())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('setSubscriber')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('setSentAt')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('setStatus')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('setFkSubscriber')->willReturn($this->subscriptionTransferMock);
        $this->subscriberTransferMock->expects(static::never())->method('requireEmail');
        $this->subscriberTransferMock->expects(static::once())->method('getIdAvailabilityAlertSubscriber')->willReturn(1);
        $this->subscriptionPluginExecutor->expects(static::once())->method('executePreSavePlugins')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionPluginExecutor->expects(static::once())->method('executePostSavePlugins')->willReturn($this->subscriptionTransferMock);
        $this->entityManagerMock->expects(static::once())->method('createOrUpdateSubscription')->willReturn($this->subscriptionTransferMock);
        $this->entityManagerMock->expects(static::once())->method('createOrUpdateSubscriber')->willReturn($this->subscriberTransferMock);
        $this->repositoryMock->expects(static::once())->method('findSubscriberById')->willReturn($this->subscriberTransferMock);
        $this->subscriberPluginExecutor->expects(static::once())->method('executePreSavePlugins')->willReturn($this->subscriberTransferMock);
        $this->subscriberPluginExecutor->expects(static::once())->method('executePostSavePlugins')->willReturn($this->subscriberTransferMock);

        $this->manager->subscribe($this->subscriptionTransferMock, false);
    }

    /**
     * @return void
     */
    public function testUpdateSubscription(): void
    {
        $this->subscriptionTransferMock->expects(static::once())->method('requireFkProductAbstract')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('requireFkLocale')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('requireFkStore')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionTransferMock->expects(static::never())->method('requireSubscriber')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionPluginExecutor->expects(static::once())->method('executePreSavePlugins')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionPluginExecutor->expects(static::once())->method('executePostSavePlugins')->willReturn($this->subscriptionTransferMock);
        $this->entityManagerMock->expects(static::once())->method('createOrUpdateSubscription')->willReturn($this->subscriptionTransferMock);

        $this->manager->updateSubscription($this->subscriptionTransferMock);
    }

    /**
     * @return void
     */
    public function testGetCurrentSubscriptionCountPerProductAbstract(): void
    {
        $this->repositoryMock->expects(static::once())->method('getCountOfSubscriberPerProductAbstract')->willReturn([]);
        $result = $this->manager->getCurrentSubscriptionCountPerProductAbstract();

        static::assertIsArray($result);
    }

    /**
     * @return void
     */
    public function testGetSubscriptionsForCurrentStoreAndStatus(): void
    {
        $this->storeFacadeMock->expects(static::once())->method('getCurrentStore')->willReturn($this->storeTransferMock);
        $this->repositoryMock->expects(static::once())->method('findSubscriptionsByIdStoreAndStatus')->willReturn($this->collectionTransferMock);
        $this->storeTransferMock->expects(static::once())->method('getIdStore')->willReturn(1);
        $result = $this->manager->getSubscriptionsForCurrentStoreAndStatus(1);

        static::assertInstanceOf(AvailabilityAlertSubscriptionCollectionTransfer::class, $result);
    }
}
