<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiDataTransfer;

class ErpOrderApiValidatorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Business\Validator\ErpOrderApiValidator
     */
    protected $erpOrderApiValidator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderApiValidator = new ErpOrderApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        static::assertCount(0, $this->erpOrderApiValidator->validate($this->apiDataTransferMock));
    }
}
