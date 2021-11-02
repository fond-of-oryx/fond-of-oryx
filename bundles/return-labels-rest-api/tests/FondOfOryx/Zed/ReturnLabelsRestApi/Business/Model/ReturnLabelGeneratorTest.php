<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Expander\ReturnLabelRequestExpanderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeBridge;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelTransfer;

class ReturnLabelGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Expander\ReturnLabelRequestExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestExpanderMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\ReturnLabelGeneratorInterface
     */
    protected $returnLabelGenerator;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->returnLabelFacadeMock = $this->getMockBuilder(ReturnLabelsRestApiToReturnLabelFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestExpanderMock = $this->getMockBuilder(ReturnLabelRequestExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelResponseTransferMock = $this->getMockBuilder(ReturnLabelResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelTransferMock = $this->getMockBuilder(ReturnLabelTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelGenerator = new ReturnLabelGenerator(
            $this->returnLabelFacadeMock,
            $this->returnLabelRequestExpanderMock,
        );

        parent::_before();
    }

    /**
     * @return void
     */
    public function testGenerate(): void
    {
        $this->returnLabelRequestExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with(
                $this->restReturnLabelRequestTransferMock,
                static::callback(
                    static function (ReturnLabelRequestTransfer $returnLabelRequestTransfer) {
                        return $returnLabelRequestTransfer->toArray() == (new ReturnLabelRequestTransfer())->toArray();
                    },
                ),
            )->willReturn($this->returnLabelRequestTransferMock);

        $this->returnLabelFacadeMock->expects(static::atLeastOnce())
            ->method('generateReturnLabel')
            ->with($this->returnLabelRequestTransferMock)
            ->willReturn($this->returnLabelResponseTransferMock);

        $this->returnLabelResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->returnLabelResponseTransferMock->expects(static::atLeastOnce())
            ->method('getReturnLabel')
            ->willReturn($this->returnLabelTransferMock);

        $restReturnLabelResponseTransfer = $this->returnLabelGenerator->generate(
            $this->restReturnLabelRequestTransferMock,
        );

        static::assertTrue($restReturnLabelResponseTransfer->getIsSuccessful());
        static::assertEquals($this->returnLabelTransferMock, $restReturnLabelResponseTransfer->getReturnLabel());
    }
}
