<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\Event\Subscriber;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Shared\RepresentativeCompanyUser\RepresentativeCompanyUserConstants;
use FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\Event\Listener\RepresentativeCompanyUserCompanyUserCreatorListener;
use FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\Event\Listener\RepresentativeCompanyUserCompanyUserDeleterListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventBaseHandlerInterface;

class RepresentativeCompanyUserEventSubscriberTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    protected $eventCollectionMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\Event\Subscriber\RepresentativeCompanyUserEventSubscriber
     */
    protected $representativeCompanyUserEventSubscriber;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->eventCollectionMock = $this->getMockBuilder(EventCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserEventSubscriber = new RepresentativeCompanyUserEventSubscriber();
    }

    /**
     * @return void
     */
    public function testGetSubscribedEvents(): void
    {
        $self = $this;

        $callCount = $this->atLeastOnce();
        $this->eventCollectionMock->expects($callCount)
            ->method('addListenerQueued')
            ->willReturnCallback(static function ($eventName, EventBaseHandlerInterface $eventHandler, $priority = 0, $queuePoolName = null, $eventQueueName = null) use ($self, $callCount) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame(RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_EXPIRE, $eventName);
                        $self->assertInstanceOf(RepresentativeCompanyUserCompanyUserDeleterListener::class, $eventHandler);
                        $self->assertSame(0, $priority);
                        $self->assertNull($queuePoolName);
                        $self->assertNull($eventQueueName);

                        return $self->eventCollectionMock;
                    case 2:
                        $self->assertSame(RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_REVOCATION, $eventName);
                        $self->assertInstanceOf(RepresentativeCompanyUserCompanyUserDeleterListener::class, $eventHandler);
                        $self->assertSame(0, $priority);
                        $self->assertNull($queuePoolName);
                        $self->assertNull($eventQueueName);

                        return $self->eventCollectionMock;
                    case 3:
                        $self->assertSame(RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_CREATE_COMPANY_USER, $eventName);
                        $self->assertInstanceOf(RepresentativeCompanyUserCompanyUserCreatorListener::class, $eventHandler);
                        $self->assertSame(0, $priority);
                        $self->assertNull($queuePoolName);
                        $self->assertNull($eventQueueName);

                        return $self->eventCollectionMock;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(
            $this->eventCollectionMock,
            $this->representativeCompanyUserEventSubscriber->getSubscribedEvents(
                $this->eventCollectionMock,
            ),
        );
    }
}
