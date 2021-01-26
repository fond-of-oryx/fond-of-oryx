<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepository;
use Generated\Shared\Transfer\ErpOrderAddressTransfer;

class ErpOrderAddressReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderAddressTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderAddressReaderInterface
     */
    protected $reader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ErpOrderRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderAddressTransfer = $this->getMockBuilder(ErpOrderAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpOrderAddressReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFindErpOrderAddressByIdErpOrderAddress(): void
    {
        $this->repositoryMock->expects($this->once())->method('findErpOrderAddressByIdErpOrderAddress')->willReturn($this->erpOrderAddressTransfer);

        $result = $this->reader->findErpOrderAddressByIdErpOrderAddress(1);

        $this->assertInstanceOf(ErpOrderAddressTransfer::class, $result);
    }
}
