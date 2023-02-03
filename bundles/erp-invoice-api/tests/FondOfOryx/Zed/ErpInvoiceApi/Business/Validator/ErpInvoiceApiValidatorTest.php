<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Business\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ErpInvoiceApiValidatorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Business\Validator\ErpInvoiceApiValidator
     */
    protected $erpInvoiceApiValidator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceApiValidator = new ErpInvoiceApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        static::assertCount(0, $this->erpInvoiceApiValidator->validate($this->apiRequestTransferMock));
    }
}
