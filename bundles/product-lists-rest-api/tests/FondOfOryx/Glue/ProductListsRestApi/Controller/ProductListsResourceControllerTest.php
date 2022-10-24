<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Updater\ProductListUpdaterInterface;
use FondOfOryx\Glue\ProductListsRestApi\ProductListsRestApiFactory;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class ProductListsResourceControllerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListsAttributesTransfer&\PHPUnit\Framework\MockObject\MockObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListsAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\ProductListsRestApiFactory&\PHPUnit\Framework\MockObject\MockObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Processor\Updater\ProductListUpdaterInterface&\PHPUnit\Framework\MockObject\MockObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListUpdaterMock;

    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Controller\ProductListsResourceController|\FondOfOryx\Glue\ProductListsRestApi\Controller\__anonymous @2616
     */
    protected $controller;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListsAttributesTransferMock = $this->getMockBuilder(RestProductListsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(ProductListsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListUpdaterMock = $this->getMockBuilder(ProductListUpdaterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->controller = new class ($this->factoryMock) extends ProductListsResourceController {
            /**
             * @var \Spryker\Glue\Kernel\AbstractFactory
             */
            protected $abstractFactory;

            /**
             * @param \Spryker\Glue\Kernel\AbstractFactory $abstractFactory
             */
            public function __construct(AbstractFactory $abstractFactory)
            {
                $this->abstractFactory = $abstractFactory;
            }

            /**
             * @return \Spryker\Glue\Kernel\AbstractFactory
             */
            protected function getFactory(): AbstractFactory
            {
                return $this->abstractFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testPatchAction(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductListUpdater')
            ->willReturn($this->productListUpdaterMock);

        $this->productListUpdaterMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($this->restRequestMock, $this->restProductListsAttributesTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->controller->patchAction($this->restRequestMock, $this->restProductListsAttributesTransferMock),
        );
    }
}
