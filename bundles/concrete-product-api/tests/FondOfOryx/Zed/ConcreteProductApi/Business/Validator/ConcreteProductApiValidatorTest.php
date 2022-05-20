<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Business\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiDataTransfer;

class ConcreteProductApiValidatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ConcreteProductApi\Business\Validator\ConcreteProductApiValidator
     */
    protected $concreteProductApiValidator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->concreteProductApiValidator = new ConcreteProductApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        static::assertIsArray($this->concreteProductApiValidator->validate($this->apiDataTransferMock));
    }
}
