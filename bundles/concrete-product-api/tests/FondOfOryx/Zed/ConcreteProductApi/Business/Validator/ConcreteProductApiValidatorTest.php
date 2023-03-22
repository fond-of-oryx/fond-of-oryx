<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Business\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ConcreteProductApiValidatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ConcreteProductApi\Business\Validator\ConcreteProductApiValidator
     */
    protected $concreteProductApiValidator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->concreteProductApiValidator = new ConcreteProductApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        static::assertIsArray($this->concreteProductApiValidator->validate($this->apiRequestTransferMock));
    }
}
