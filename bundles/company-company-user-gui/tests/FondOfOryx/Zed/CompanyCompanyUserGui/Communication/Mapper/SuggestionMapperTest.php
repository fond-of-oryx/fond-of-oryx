<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyTransfer;

class SuggestionMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Mapper\SuggestionMapper
     */
    protected $suggestionMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->suggestionMapper = new SuggestionMapper();
    }

    /**
     * @return void
     */
    public function testFromCompanyTransfers(): void
    {
        $idCompany = 1;
        $name = 'foo';
        $companyTransfers = [$this->companyTransferMock];

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($idCompany);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($name);

        $suggestions = $this->suggestionMapper->fromCompanyTransfers($companyTransfers);

        static::assertCount(1, $suggestions);
        static::assertEquals($idCompany, $suggestions[0]['id']);
        static::assertEquals(sprintf('%s (ID: %d)', $name, $idCompany), $suggestions[0]['text']);
    }
}
