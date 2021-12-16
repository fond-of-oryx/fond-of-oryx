<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClient;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Reader\SplittableTotalsReader;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\SplittableCheckout\SplittableCheckoutProcessor;
use Spryker\Client\Kernel\AbstractClient;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\Kernel\AbstractBundleConfig;
use Spryker\Glue\Kernel\Container;

class SplittableCheckoutRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClient|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(SplittableCheckoutRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(SplittableCheckoutRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class (
            $this->configMock,
            $this->clientMock,
            $this->restResourceBuilderMock,
            $this->containerMock,
        ) extends SplittableCheckoutRestApiFactory {
            /**
             * @var \Spryker\Glue\Kernel\AbstractBundleConfig
             */
            protected $abstractBundleConfig;

            /**
             * @var \Spryker\Client\Kernel\AbstractClient
             */
            protected $abstractClient;

            /**
             * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            protected $restResourceBuilder;

            /**
             * @var \Spryker\Glue\Kernel\Container
             */
            protected $container;

            /**
             * @param \Spryker\Glue\Kernel\AbstractBundleConfig $abstractBundleConfig
             * @param \Spryker\Client\Kernel\AbstractClient $abstractClient
             * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
             * @param \Spryker\Glue\Kernel\Container $container
             */
            public function __construct(
                AbstractBundleConfig $abstractBundleConfig,
                AbstractClient $abstractClient,
                RestResourceBuilderInterface $restResourceBuilder,
                Container $container
            ) {
                $this->restResourceBuilder = $restResourceBuilder;
                $this->abstractBundleConfig = $abstractBundleConfig;
                $this->abstractClient = $abstractClient;
                $this->container = $container;
            }

            /**
             * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            public function getResourceBuilder(): RestResourceBuilderInterface
            {
                return $this->restResourceBuilder;
            }

            /**
             * @return \Spryker\Client\Kernel\AbstractClient
             */
            protected function getClient(): AbstractClient
            {
                return $this->abstractClient;
            }

            /**
             * @return \Spryker\Glue\Kernel\AbstractBundleConfig
             */
            public function getConfig(): AbstractBundleConfig
            {
                return $this->abstractBundleConfig;
            }

            /**
             * @return \Spryker\Glue\Kernel\Container
             */
            protected function getContainer(): Container
            {
                return $this->container;
            }
        };
    }

    /**
     * @return void
     */
    public function testCreateSplittableCheckoutProcessor(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(SplittableCheckoutRestApiDependencyProvider::PLUGINS_REST_SPLITTABLE_CHECKOUT_EXPANDER)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(SplittableCheckoutRestApiDependencyProvider::PLUGINS_REST_SPLITTABLE_CHECKOUT_EXPANDER)
            ->willReturn([]);

        static::assertInstanceOf(
            SplittableCheckoutProcessor::class,
            $this->factory->createSplittableCheckoutProcessor(),
        );
    }

    /**
     * @return void
     */
    public function testCreateSplittableTotalsReader(): void
    {
        static::assertInstanceOf(
            SplittableTotalsReader::class,
            $this->factory->createSplittableTotalsReader(),
        );
    }
}
