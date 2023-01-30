<?php

namespace FondOfOryx\Zed\InvoiceApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiRequestTransfer;

class InvoiceApiValidatorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\InvoiceApi\Business\Model\Validator\InvoiceApiValidator
     */
    protected $validator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->validator = new InvoiceApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        static::assertEquals([], $this->validator->validate($this->apiRequestTransferMock));
    }
}
