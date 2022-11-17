<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CustomerRegistrationRestApi\CustomerRegistrationRestApiFactory;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\CustomerRegistrationProcessorInterface;
use Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerRegistrationResourceControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Controller\CustomerRegistrationResourceController
     */
    protected $customerRegistrationResourceController;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\CustomerRegistrationRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCustomerRegistrationRequestAttributesTransferMock;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\CustomerRegistrationProcessorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationProcessorMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerRegistrationRestApiFactoryMock = $this->getMockBuilder(CustomerRegistrationRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationProcessorMock = $this->getMockBuilder(CustomerRegistrationProcessorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCustomerRegistrationRequestAttributesTransferMock = $this->getMockBuilder(RestCustomerRegistrationRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationResourceController = new class ($this->customerRegistrationRestApiFactoryMock) extends CustomerRegistrationResourceController {
            /**
             * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\CustomerRegistrationRestApiFactory
             */
            protected $customerRegistrationRestApiFactory;

            /**
             * @param \FondOfOryx\Glue\CustomerRegistrationRestApi\CustomerRegistrationRestApiFactory $customerRegistrationRestApiFactory
             */
            public function __construct(CustomerRegistrationRestApiFactory $customerRegistrationRestApiFactory)
            {
                $this->customerRegistrationRestApiFactory = $customerRegistrationRestApiFactory;
            }

            /**
             * @return \FondOfOryx\Glue\CustomerRegistrationRestApi\CustomerRegistrationRestApiFactory
             */
            public function getFactory(): CustomerRegistrationRestApiFactory
            {
                return $this->customerRegistrationRestApiFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testPostAction(): void
    {
        $this->customerRegistrationRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createCustomerRegistrationProcessor')
            ->willReturn($this->customerRegistrationProcessorMock);

        $this->customerRegistrationProcessorMock->expects($this->atLeastOnce())
            ->method('register')
            ->with(
                $this->restRequestMock,
                $this->restCustomerRegistrationRequestAttributesTransferMock,
            )
            ->willReturn($this->restResponseMock);

        $this->assertSame(
            $this->restResponseMock,
            $this->customerRegistrationResourceController->postAction(
                $this->restRequestMock,
                $this->restCustomerRegistrationRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testPatchAction(): void
    {
        $this->customerRegistrationRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createCustomerRegistrationProcessor')
            ->willReturn($this->customerRegistrationProcessorMock);

        $this->customerRegistrationProcessorMock->expects($this->atLeastOnce())
            ->method('updateRegistration')
            ->with(
                $this->restRequestMock,
                $this->restCustomerRegistrationRequestAttributesTransferMock,
            )
            ->willReturn($this->restResponseMock);

        $this->assertSame(
            $this->restResponseMock,
            $this->customerRegistrationResourceController->patchAction(
                $this->restRequestMock,
                $this->restCustomerRegistrationRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetAction(): void
    {
        $this->customerRegistrationRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createCustomerRegistrationProcessor')
            ->willReturn($this->customerRegistrationProcessorMock);

        $this->customerRegistrationProcessorMock->expects($this->atLeastOnce())
            ->method('verifyEmail')
            ->with(
                $this->restRequestMock,
                $this->restCustomerRegistrationRequestAttributesTransferMock,
            )
            ->willReturn($this->restResponseMock);

        $this->assertSame(
            $this->restResponseMock,
            $this->customerRegistrationResourceController->getAction(
                $this->restRequestMock,
                $this->restCustomerRegistrationRequestAttributesTransferMock,
            ),
        );
    }
}
