<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderApi\Business\Mapper\TransferMapper;
use Generated\Shared\Transfer\ErpOrderApiTransfer;
use Orm\Zed\ErpOrder\Persistence\ErpOrder;

class TransferMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Business\Mapper\TransferMapperInterface
     */
    protected $transferMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->transferMapper = new TransferMapper();
    }

    /**
     * @return void
     */
    public function testToTransfer(): void
    {

        static::assertInstanceOf(
            ErpOrderApiTransfer::class,
            $this->transferMapper->toTransfer([])
        );
    }

    /**
     * @return void
     */
    public function testToTransferCollection(): void
    {
        $datas = [
            'data' => []
        ];

        $collection = $this->transferMapper->toTransferCollection($datas);
        static::assertIsArray($this->transferMapper->toTransferCollection([]));
        static::assertInstanceOf(
            ErpOrderApiTransfer::class,
            $collection[0]
        );
    }
}
