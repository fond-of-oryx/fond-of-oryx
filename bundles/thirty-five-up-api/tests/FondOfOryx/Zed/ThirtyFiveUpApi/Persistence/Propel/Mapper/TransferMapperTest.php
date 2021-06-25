<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer;

class TransferMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper\TransferMapperInterface
     */
    protected $mapper;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->mapper = new TransferMapper();
    }

    /**
     * @return void
     */
    public function testToArray(): void
    {
        $this->assertInstanceOf(
            FosThirtyFiveUpOrderEntityTransfer::class,
            $this->mapper->toTransfer([])
        );
    }

    /**
     * @return void
     */
    public function testToTransferCollection(): void
    {
        $mapped = $this->mapper->toTransferCollection([[]]);
        $this->assertIsArray($mapped);
        $this->assertCount(1, $mapped);
        $this->assertInstanceOf(
            FosThirtyFiveUpOrderEntityTransfer::class,
            $mapped[0]
        );
    }
}
