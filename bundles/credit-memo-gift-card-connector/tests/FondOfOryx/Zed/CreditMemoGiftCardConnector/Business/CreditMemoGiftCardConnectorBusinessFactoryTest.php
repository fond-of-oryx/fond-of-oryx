<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardsWriterInterface;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardWriterInterface;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorEntityManager;

class CreditMemoGiftCardConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorEntityManager|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\CreditMemoGiftCardConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this
            ->getMockBuilder(CreditMemoGiftCardConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CreditMemoGiftCardConnectorBusinessFactory();
        $this->factory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateCreditMemoGiftCardWriter(): void
    {
        static::assertInstanceOf(
            CreditMemoGiftCardWriterInterface::class,
            $this->factory->createCreditMemoGiftCardWriter(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCreditMemoGiftCardsWriter(): void
    {
        static::assertInstanceOf(
            CreditMemoGiftCardsWriterInterface::class,
            $this->factory->createCreditMemoGiftCardsWriter(),
        );
    }
}
