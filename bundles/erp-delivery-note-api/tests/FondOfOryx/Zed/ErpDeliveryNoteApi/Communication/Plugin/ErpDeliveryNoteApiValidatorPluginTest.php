<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Business\ErpDeliveryNoteApiFacade;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Communication\Plugin\Api\ErpDeliveryNoteApiValidatorPlugin;
use FondOfOryx\Zed\ErpDeliveryNoteApi\ErpDeliveryNoteApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ErpDeliveryNoteApiValidatorPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Communication\Plugin\Api\ErpDeliveryNoteApiValidatorPlugin
     */
    protected $erpDeliveryNoteApiValidatorPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNoteApi\Business\ErpDeliveryNoteApiFacade
     */
    protected $erpDeliveryNoteApiFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpDeliveryNoteApiFacadeMock = $this->getMockBuilder(ErpDeliveryNoteApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteApiValidatorPlugin = new ErpDeliveryNoteApiValidatorPlugin();
        $this->erpDeliveryNoteApiValidatorPlugin->setFacade($this->erpDeliveryNoteApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertSame(
            ErpDeliveryNoteApiConfig::RESOURCE_ERP_DELIVERY_NOTES,
            $this->erpDeliveryNoteApiValidatorPlugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $validationResult = [];

        $this->erpDeliveryNoteApiFacadeMock->expects(static::atLeastOnce())
            ->method('validateErpDeliveryNote')
            ->with($this->apiRequestTransferMock)
            ->willReturn($validationResult);

        static::assertEquals(
            $validationResult,
            $this->erpDeliveryNoteApiValidatorPlugin->validate(
                $this->apiRequestTransferMock,
            ),
        );
    }
}
