<?php

namespace FondOfOryx\Zed\StockApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiDataTransfer;

class StockApiValidatorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransfer;

    /**
     * @var \FondOfOryx\Zed\StockApi\Business\Model\Validator\StockApiValidator
     */
    protected $stockApiValidator;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->apiDataTransfer = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiValidator = new StockApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate()
    {
        $errors = $this->stockApiValidator->validate($this->apiDataTransfer);

        $this->assertIsArray($errors);
    }
}
