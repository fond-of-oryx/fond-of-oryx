<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ErpDeliveryNoteApiValidatorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Validator\ErpDeliveryNoteApiValidator
     */
    protected $erpDeliveryNoteApiValidator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteApiValidator = new ErpDeliveryNoteApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        static::assertCount(0, $this->erpDeliveryNoteApiValidator->validate($this->apiRequestTransferMock));
    }
}
