<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\Event\Subscriber;

use Codeception\Test\Unit;
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
        $this->eventCollectionMock->expects(static::atLeastOnce())
            ->method('addListenerQueued')
            ->withConsecutive(
                [
                    RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_EXPIRE,
                    static::callback(
                        static function (EventBaseHandlerInterface $eventHandler) {
                            return $eventHandler instanceof RepresentativeCompanyUserCompanyUserDeleterListener;
                        },
                    ),
                    0,
                    null,
                    null,
                ],
                [
                    RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_REVOCATION,
                    static::callback(
                        static function (EventBaseHandlerInterface $eventHandler) {
                            return $eventHandler instanceof RepresentativeCompanyUserCompanyUserDeleterListener;
                        },
                    ),
                    0,
                    null,
                    null,
                ],
                [
                    RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_CREATE_COMPANY_USER,
                    static::callback(
                        static function (EventBaseHandlerInterface $eventHandler) {
                            return $eventHandler instanceof RepresentativeCompanyUserCompanyUserCreatorListener;
                        },
                    ),
                    0,
                    null,
                    null,
                ],
            );

        static::assertEquals(
            $this->eventCollectionMock,
            $this->representativeCompanyUserEventSubscriber->getSubscribedEvents(
                $this->eventCollectionMock,
            ),
        );
    }
}
