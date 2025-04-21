<?php

use App\Contract\CacheServiceInterface;
use App\Contract\DatabaseServiceInterface;
use App\Contract\LinkServiceInterface;
use App\Service\LinkService;
use App\Util\UriGenerator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class LinkServiceTest extends TestCase
{
    private LinkServiceInterface $linkService;
    private MockObject $cacheServiceMock;
    private MockObject $dbMock;

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    protected function setUp(): void
    {
        $this->cacheServiceMock = $this->createMock(CacheServiceInterface::class);
        $this->dbMock = $this->createMock(DatabaseServiceInterface::class);
        $this->linkService = new LinkService($this->dbMock, $this->cacheServiceMock);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testGetOriginalUrlFromCache(): void
    {
        $expectedUrl = 'https://example.com';

        $linkServiceMock = $this->createMock(LinkServiceInterface::class);

        $this->cacheServiceMock->method('get')->willReturn($expectedUrl);
        $linkServiceMock->method('getOriginalUrl')->with(UriGenerator::generate($expectedUrl))->willReturn($expectedUrl);

        $url = $this->linkService->getOriginalUrl(UriGenerator::generate($expectedUrl));

        $this->assertEquals($expectedUrl, $url);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testGetOriginalUrlFromDatabaseWhenNotInCache(): void
    {
        $expectedUrl = 'https://example.com';

        $pdoStatementMock = $this->createMock(PDOStatement::class);
        $pdoStatementMock->method('fetch')->willReturn((object) ['original_url' => $expectedUrl]);

        $this->cacheServiceMock->method('get')->willReturn(null);
        $this->dbMock->method('query')->willReturn($pdoStatementMock);
        $this->cacheServiceMock
            ->expects($this->once())
            ->method('set')
            ->with(UriGenerator::generate($expectedUrl), $expectedUrl);

        $url = $this->linkService->getOriginalUrl(UriGenerator::generate($expectedUrl));

        $this->assertEquals($expectedUrl, $url);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testCacheMissAndInsert(): void
    {
        $url = 'https://example.com';

        $pdoStatementMock = $this->createMock(PDOStatement::class);
        $pdoStatementMock->method('fetch')->willReturn(true);

        $this->cacheServiceMock->method('get')->willReturn(null);
        $this->dbMock->method('query')->willReturn($pdoStatementMock);

        $this->cacheServiceMock->expects($this->once())
            ->method('set')
            ->with(UriGenerator::generate($url), $url);

        $this->linkService->create($url);

        $this->assertTrue(true);
    }
}