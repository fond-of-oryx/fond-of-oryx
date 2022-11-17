<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiClient;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\CustomerRegistrationProcessorInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;

class CustomerRegistrationRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\CustomerRegistrationRestApiFactory
     */
    protected $customerRegistrationRestApiFactory;

    /**
     * @var \FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiClient|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRestApiClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerRegistrationRestApiClientMock = $this->getMockBuilder(CustomerRegistrationRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRestApiFactory = new class ($this->restResourceBuilderMock) extends CustomerRegistrationRestApiFactory {
            /**
             * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            protected $restResourceBuilder;

            /**
             * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
             */
            public function __construct(RestResourceBuilderInterface $restResourceBuilder)
            {
                $this->restResourceBuilder = $restResourceBuilder;
            }

            /**
             * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            public function getResourceBuilder(): RestResourceBuilderInterface
            {
                return $this->restResourceBuilder;
            }
        };
        $this->customerRegistrationRestApiFactory->setClient($this->customerRegistrationRestApiClientMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerRegistrationProcessor(): void
    {
        $this->assertInstanceOf(
            CustomerRegistrationProcessorInterface::class,
            $this->customerRegistrationRestApiFactory->createCustomerRegistrationProcessor(),
        );
    }
}
