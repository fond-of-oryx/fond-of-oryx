<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Mapper\SuggestionMapperInterface;
use FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepositoryInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class SuggestionReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Mapper\SuggestionMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $suggestionMapperMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Reader\SuggestionReader
     */
    protected $suggestionReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyCompanyUserGuiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->suggestionMapperMock = $this->getMockBuilder(SuggestionMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->suggestionReader = new SuggestionReader(
            $this->suggestionMapperMock,
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testGetByTerm(): void
    {
        $term = 'foo';
        $companyTransfers = [
            $this->companyTransferMock,
        ];
        $suggestion = [
            'id' => 1,
            'text' => 'foo',
        ];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findByNamePattern')
            ->with($term)
            ->willReturn($companyTransfers);

        $this->suggestionMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyTransfers')
            ->with($companyTransfers)
            ->willReturn($suggestion);

        $suggestions = $this->suggestionReader->getByTerm($term);

        static::assertArrayHasKey('results', $suggestions);
        static::assertEquals($suggestion, $suggestions['results']);
    }
}
