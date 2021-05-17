<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\ReturnLabelGenerator;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;

class ReturnLabelsRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Business\ReturnLabelsRestApiFacadeInterface
     */
    protected $returnLabelsRestApiFacade;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Business\ReturnLabelsRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model\ReturnLabelGenerator|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelGeneratorMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ReturnLabelsRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelGeneratorMock = $this->getMockBuilder(ReturnLabelGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelResponseTransferMock = $this->getMockBuilder(RestReturnLabelResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelsRestApiFacade = new ReturnLabelsRestApiFacade();
        $this->returnLabelsRestApiFacade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testGenerateReturnLabel(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createReturnLabelGenerator')
            ->willReturn($this->returnLabelGeneratorMock);

        $this->returnLabelGeneratorMock->expects(static::atLeastOnce())
            ->method('generate')
            ->willReturn($this->restReturnLabelResponseTransferMock);

        $this->assertEquals(
            $this->restReturnLabelResponseTransferMock,
            $this->returnLabelsRestApiFacade->generateReturnLabel($this->restReturnLabelRequestTransferMock)
        );
    }
}
