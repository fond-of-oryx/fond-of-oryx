<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Event\Subscriber;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ProductLocaleRestriction\Dependency\ProductLocaleRestrictionEvents;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Event\Listener\ProductAbstractListener;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Event\Listener\ProductAbstractLocaleRestrictionListener;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventBaseHandlerInterface;
use Spryker\Zed\Kernel\AbstractBundleConfig;
use Spryker\Zed\Product\Dependency\ProductEvents;

class ProductLocaleRestrictionStorageEventSubscriberTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    protected $eventCollectionMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Event\Subscriber\ProductLocaleRestrictionStorageEventSubscriber
     */
    protected $productLocaleRestrictionStorageEventSubscriber;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ProductLocaleRestrictionStorageConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventCollectionMock = $this->getMockBuilder(EventCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        if (method_exists(ProductLocaleRestrictionStorageEventSubscriber::class, 'setConfig')) {
            $this->productLocaleRestrictionStorageEventSubscriber = new ProductLocaleRestrictionStorageEventSubscriber();
            $this->productLocaleRestrictionStorageEventSubscriber->setConfig($this->configMock);
        } else {
            $this->productLocaleRestrictionStorageEventSubscriber = new class ($this->configMock) extends ProductLocaleRestrictionStorageEventSubscriber {
                /**
                 * @var \Spryker\Zed\Kernel\AbstractBundleConfig
                 */
                protected $productLocaleRestrictionStorageConfig;

                /**
                 * @param \Spryker\Zed\Kernel\AbstractBundleConfig $config
                 */
                public function __construct(AbstractBundleConfig $config)
                {
                    $this->productLocaleRestrictionStorageConfig = $config;
                }

                /**
                 * @return \Spryker\Zed\Kernel\AbstractBundleConfig
                 */
                public function getConfig(): AbstractBundleConfig
                {
                    return $this->productLocaleRestrictionStorageConfig;
                }
            };
        }
    }

    /**
     * @return void
     */
    public function testGetSubscribedEvents(): void
    {
        $self = $this;

        $productAbstractLocaleRestrictionEventQueueName = 'foo';

        $callCount = $this->atLeastOnce();
        $this->eventCollectionMock->expects($callCount)
            ->method('addListenerQueued')
            ->willReturnCallback(static function ($eventName, EventBaseHandlerInterface $eventHandler, $priority = 0, $queuePoolName = null, $eventQueueName = null) use ($self, $callCount, $productAbstractLocaleRestrictionEventQueueName) {
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
                        $self->assertSame(ProductEvents::PRODUCT_ABSTRACT_PUBLISH, $eventName);
                        $self->assertInstanceOf(ProductAbstractListener::class, $eventHandler);
                        $self->assertSame(0, $priority);
                        $self->assertNull($queuePoolName);
                        $self->assertSame($productAbstractLocaleRestrictionEventQueueName, $eventQueueName);

                        return $self->eventCollectionMock;
                    case 2:
                        $self->assertSame(ProductEvents::ENTITY_SPY_PRODUCT_ABSTRACT_CREATE, $eventName);
                        $self->assertInstanceOf(ProductAbstractListener::class, $eventHandler);
                        $self->assertSame(0, $priority);
                        $self->assertNull($queuePoolName);
                        $self->assertSame($productAbstractLocaleRestrictionEventQueueName, $eventQueueName);

                        return $self->eventCollectionMock;
                    case 3:
                        $self->assertSame(ProductEvents::ENTITY_SPY_PRODUCT_ABSTRACT_UPDATE, $eventName);
                        $self->assertInstanceOf(ProductAbstractListener::class, $eventHandler);
                        $self->assertSame(0, $priority);
                        $self->assertNull($queuePoolName);
                        $self->assertSame($productAbstractLocaleRestrictionEventQueueName, $eventQueueName);

                        return $self->eventCollectionMock;
                    case 4:
                        $self->assertSame(ProductLocaleRestrictionEvents::ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_CREATE, $eventName);
                        $self->assertInstanceOf(ProductAbstractLocaleRestrictionListener::class, $eventHandler);
                        $self->assertSame(0, $priority);
                        $self->assertNull($queuePoolName);
                        $self->assertSame($productAbstractLocaleRestrictionEventQueueName, $eventQueueName);

                        return $self->eventCollectionMock;
                    case 5:
                        $self->assertSame(ProductLocaleRestrictionEvents::ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_UPDATE, $eventName);
                        $self->assertInstanceOf(ProductAbstractLocaleRestrictionListener::class, $eventHandler);
                        $self->assertSame(0, $priority);
                        $self->assertNull($queuePoolName);
                        $self->assertSame($productAbstractLocaleRestrictionEventQueueName, $eventQueueName);

                        return $self->eventCollectionMock;
                    case 6:
                        $self->assertSame(ProductLocaleRestrictionEvents::ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_DELETE, $eventName);
                        $self->assertInstanceOf(ProductAbstractLocaleRestrictionListener::class, $eventHandler);
                        $self->assertSame(0, $priority);
                        $self->assertNull($queuePoolName);
                        $self->assertSame($productAbstractLocaleRestrictionEventQueueName, $eventQueueName);

                        return $self->eventCollectionMock;
                }

                throw new Exception('Unexpected call count');
            });

        $this->configMock->expects(static::atLeastOnce())
            ->method('getProductAbstractLocaleRestrictionEventQueueName')
            ->willReturn($productAbstractLocaleRestrictionEventQueueName);

        static::assertEquals(
            $this->eventCollectionMock,
            $this->productLocaleRestrictionStorageEventSubscriber->getSubscribedEvents(
                $this->eventCollectionMock,
            ),
        );
    }
}
