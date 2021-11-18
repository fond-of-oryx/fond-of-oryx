<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Business\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiDataTransfer;

class ErpInvoiceApiValidatorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

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

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceApiValidator = new ErpInvoiceApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        static::assertCount(0, $this->erpInvoiceApiValidator->validate($this->apiDataTransferMock));
    }
}
