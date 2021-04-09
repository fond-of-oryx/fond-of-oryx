<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Event\Subscriber;

use Codeception\Test\Unit;
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
                protected function getConfig(): AbstractBundleConfig
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
        $productAbstractLocaleRestrictionEventQueueName = 'foo';

        $this->eventCollectionMock->expects(static::atLeastOnce())
            ->method('addListenerQueued')
            ->withConsecutive(
                [
                    ProductEvents::PRODUCT_ABSTRACT_PUBLISH,
                    static::callback(
                        static function (EventBaseHandlerInterface $eventHandler) {
                            return $eventHandler instanceof ProductAbstractListener;
                        }
                    ),
                    0,
                    null,
                    $productAbstractLocaleRestrictionEventQueueName,
                ],
                [
                    ProductEvents::ENTITY_SPY_PRODUCT_ABSTRACT_CREATE,
                    static::callback(
                        static function (EventBaseHandlerInterface $eventHandler) {
                            return $eventHandler instanceof ProductAbstractListener;
                        }
                    ),
                    0,
                    null,
                    $productAbstractLocaleRestrictionEventQueueName,
                ],
                [
                    ProductEvents::ENTITY_SPY_PRODUCT_ABSTRACT_UPDATE,
                    static::callback(
                        static function (EventBaseHandlerInterface $eventHandler) {
                            return $eventHandler instanceof ProductAbstractListener;
                        }
                    ),
                    0,
                    null,
                    $productAbstractLocaleRestrictionEventQueueName,
                ],
                [
                    ProductLocaleRestrictionEvents::ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_CREATE,
                    static::callback(
                        static function (EventBaseHandlerInterface $eventHandler) {
                            return $eventHandler instanceof ProductAbstractLocaleRestrictionListener;
                        }
                    ),
                    0,
                    null,
                    $productAbstractLocaleRestrictionEventQueueName,
                ],
                [
                    ProductLocaleRestrictionEvents::ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_UPDATE,
                    static::callback(
                        static function (EventBaseHandlerInterface $eventHandler) {
                            return $eventHandler instanceof ProductAbstractLocaleRestrictionListener;
                        }
                    ),
                    0,
                    null,
                    $productAbstractLocaleRestrictionEventQueueName,
                ],
                [
                    ProductLocaleRestrictionEvents::ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_DELETE,
                    static::callback(
                        static function (EventBaseHandlerInterface $eventHandler) {
                            return $eventHandler instanceof ProductAbstractLocaleRestrictionListener;
                        }
                    ),
                    0,
                    null,
                    $productAbstractLocaleRestrictionEventQueueName,
                ],
            );

        $this->configMock->expects(static::atLeastOnce())
            ->method('getProductAbstractLocaleRestrictionEventQueueName')
            ->willReturn($productAbstractLocaleRestrictionEventQueueName);

        static::assertEquals(
            $this->eventCollectionMock,
            $this->productLocaleRestrictionStorageEventSubscriber->getSubscribedEvents(
                $this->eventCollectionMock
            )
        );
    }
}
