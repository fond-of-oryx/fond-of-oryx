<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\ItemMetadataTransfer;
use Generated\Shared\Transfer\ItemTransfer;

class MailjetTemplateVariablesItemsMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ItemMetadataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $metadataTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesItemsMapper
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->metadataTransferMock = $this->getMockBuilder(ItemMetadataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new MailjetTemplateVariablesItemsMapper();
    }

    /**
     * @return void
     */
    public function testMap(): void
    {
        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getMetadata')
            ->willReturn($this->metadataTransferMock);

        $this->metadataTransferMock->expects(static::atLeastOnce())
            ->method('getImage')
            ->willReturn('Image');

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn('Name');

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('SKU');

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getQuantity')
            ->willReturn('1');

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getUnitPrice')
            ->willReturn(9999);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getSumPrice')
            ->willReturn(9999);

        $response = $this->mapper->map(new ArrayObject([$this->itemTransferMock]));

        static::assertCount(1, $response);
        static::assertCount(6, $response[0]);
    }
}
