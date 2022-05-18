<?php

namespace FondOfOryx\Zed\GiftCardApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardApi\Business\Model\Validator\GiftCardApiValidator;
use Generated\Shared\Transfer\ApiDataTransfer;

class GiftCardApiValidatorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

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

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new GiftCardApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        static::assertIsArray($this->model->validate($this->apiDataTransferMock));
    }
}
