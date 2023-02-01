<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ThirtyFiveUpApiValidatorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\Validator\ThirtyFiveUpApiValidatorInterface
     */
    protected $validator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->validator = new ThirtyFiveUpApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->assertSame([], $this->validator->validate($this->apiRequestTransferMock));
    }
}
