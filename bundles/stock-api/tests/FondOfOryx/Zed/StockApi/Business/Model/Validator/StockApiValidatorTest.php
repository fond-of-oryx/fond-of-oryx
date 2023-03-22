<?php

namespace FondOfOryx\Zed\StockApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiRequestTransfer;

class StockApiValidatorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransfer;

    /**
     * @var \FondOfOryx\Zed\StockApi\Business\Model\Validator\StockApiValidator
     */
    protected $stockApiValidator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiRequestTransfer = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiValidator = new StockApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $errors = $this->stockApiValidator->validate($this->apiRequestTransfer);

        $this->assertIsArray($errors);
    }
}
