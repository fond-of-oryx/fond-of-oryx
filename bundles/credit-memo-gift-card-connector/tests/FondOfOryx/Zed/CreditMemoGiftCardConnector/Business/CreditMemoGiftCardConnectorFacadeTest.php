<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardsWriterInterface;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorRepository;
use Generated\Shared\Transfer\CreditMemoTransfer;

class CreditMemoGiftCardConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\CreditMemoGiftCardConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardsWriterInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $creditMemoGiftCardsWriterMock;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $creditMemoTransferMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\CreditMemoGiftCardConnectorFacade
     */
    protected $facade;

    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorRepository|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $repositoryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->creditMemoTransferMock = $this
            ->getMockBuilder(CreditMemoTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->creditMemoGiftCardsWriterMock = $this
            ->getMockBuilder(CreditMemoGiftCardsWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this
            ->getMockBuilder(CreditMemoGiftCardConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this
            ->getMockBuilder(CreditMemoGiftCardConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CreditMemoGiftCardConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
        $this->facade->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCreditMemoGiftCards(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCreditMemoGiftCardsWriter')
            ->willReturn($this->creditMemoGiftCardsWriterMock);

        $this->creditMemoGiftCardsWriterMock->expects(static::atLeastOnce())
            ->method('create')
            ->with($this->creditMemoTransferMock)
            ->willReturn($this->creditMemoTransferMock);

        static::assertInstanceOf(
            CreditMemoTransfer::class,
            $this->facade->createCreditMemoGiftCards($this->creditMemoTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testFindCreditMemoGiftCardsByIdSalesOrderItem(): void
    {
        $idSalesOrderItem = 1;

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findCreditMemoGiftCardsByIdSalesOrderItem')
            ->with($idSalesOrderItem)
            ->willReturn([]);

        static::assertIsArray($this->facade->findCreditMemoGiftCardsByIdSalesOrderItem($idSalesOrderItem));
    }
}
