<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiDataTransfer;

class ThirtyFiveUpApiValidatorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\Validator\ThirtyFiveUpApiValidatorInterface
     */
    protected $validator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->validator = new ThirtyFiveUpApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->assertSame([], $this->validator->validate($this->apiDataTransferMock));
    }
}
