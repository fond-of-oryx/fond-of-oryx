<?php

namespace FondOfOryx\Zed\EasyApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\EasyApi\Business\EasyApiFacade;
use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use Generated\Shared\Transfer\EasyApiResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\EasyApi\Business\EasyApiFacade
     */
    protected MockObject|EasyApiFacade $facadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\EasyApiFilterTransfer
     */
    protected MockObject|EasyApiFilterTransfer $easyApiFilterTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    protected MockObject|EasyApiResponseTransfer $easyApiResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\EasyApiRequestTransfer
     */
    protected MockObject|EasyApiRequestTransfer $easyApiRequestTransfer;

    /**
     * @var \FondOfOryx\Zed\EasyApi\Communication\Controller\GatewayController
     */
    protected GatewayController $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(EasyApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiResponseTransferMock = $this->getMockBuilder(EasyApiResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiFilterTransferMock = $this->getMockBuilder(EasyApiFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiRequestTransfer = $this->getMockBuilder(EasyApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->facadeMock) extends GatewayController {
            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected AbstractFacade $easyApiFacade;

            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $easyApiFacade
             */
            public function __construct(AbstractFacade $easyApiFacade)
            {
                $this->easyApiFacade = $easyApiFacade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->easyApiFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testFindDocumentAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('findDocument')
            ->with($this->easyApiFilterTransferMock)
            ->willReturn($this->easyApiResponseTransferMock);

        static::assertEquals(
            $this->easyApiResponseTransferMock,
            $this->gatewayController->findDocumentAction(
                $this->easyApiFilterTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetDocumentAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getFile')
            ->with($this->easyApiRequestTransfer)
            ->willReturn($this->easyApiResponseTransferMock);

        static::assertEquals(
            $this->easyApiResponseTransferMock,
            $this->gatewayController->getDocumentAction(
                $this->easyApiRequestTransfer,
            ),
        );
    }
}
