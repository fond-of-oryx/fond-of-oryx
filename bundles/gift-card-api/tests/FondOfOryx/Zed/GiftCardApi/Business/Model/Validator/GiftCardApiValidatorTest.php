<?php

namespace FondOfOryx\Zed\GiftCardApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiRequestTransfer;

class GiftCardApiValidatorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Business\Model\Validator\GiftCardApiValidator
     */
    protected $model;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new GiftCardApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        static::assertIsArray($this->model->validate($this->apiRequestTransferMock));
    }
}
