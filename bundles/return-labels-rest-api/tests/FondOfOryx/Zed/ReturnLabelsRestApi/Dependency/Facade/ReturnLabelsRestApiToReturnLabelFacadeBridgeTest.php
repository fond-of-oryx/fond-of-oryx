<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelFacade;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelResponseTransfer;

class ReturnLabelsRestApiToReturnLabelFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var ReturnLabelsRestApiToReturnLabelFacadeInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->returnLabelFacadeMock = $this->getMockBuilder(ReturnLabelFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ReturnLabelsRestApiToReturnLabelFacadeBridge($this->returnLabelFacadeMock);
    }

    /**
     * @return void
     */
    public function testGenerateReturnLabel(): void
    {
        static::assertInstanceOf(
            ReturnLabelResponseTransfer::class,
            $this->returnLabelFacadeMock->generateReturnLabel($this->returnLabelRequestTransferMock)
        );
    }
}
