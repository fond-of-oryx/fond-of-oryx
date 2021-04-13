<?php


namespace FondOfOryx\Zed\ReturnLabel\Business;


use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGenerator;
use FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepository;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelResponseTransfer;

class ReturnLabelFacadeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGeneratorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelGeneratorMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelFacadeInterface
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelResponseTransferMock = $this->getMockBuilder(ReturnLabelResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ReturnLabelRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(ReturnLabelBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelGeneratorMock = $this->getMockBuilder(ReturnLabelGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ReturnLabelFacade();
        $this->facade->setFactory($this->factoryMock);
        $this->facade->setRepository($this->repositoryMock);
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
            ->willReturn($this->returnLabelResponseTransferMock);

        static::assertInstanceOf(
            ReturnLabelResponseTransfer::class,
            $this->facade->generateReturnLabel($this->returnLabelRequestTransferMock)
        );
    }
}
