<?php

namespace FondOfOryx\Zed\InvoiceApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiDataTransfer;

class InvoiceApiValidatorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

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

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->validator = new InvoiceApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        static::assertEquals([], $this->validator->validate($this->apiDataTransferMock));
    }
}
