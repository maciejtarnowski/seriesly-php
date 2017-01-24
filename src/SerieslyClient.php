<?php

namespace Seriesly;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Seriesly\Exception\DatabaseException;

class SerieslyClient
{
    /**
     * @var string
     */
    private $serieslyUrl;

    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * SerieslyClient constructor.
     * @param Client $guzzleClient
     * @param string $serieslyUrl
     */
    public function __construct(Client $guzzleClient, $serieslyUrl)
    {
        $this->serieslyUrl = $serieslyUrl;
        $this->guzzleClient = $guzzleClient;
    }

    /**
     * @param string $serieslyUrl
     * @return SerieslyClient
     */
    public static function create($serieslyUrl)
    {
        return new self(new Client(), $serieslyUrl);
    }

    /**
     * @param string $suffix
     * @return string
     */
    private function getUrl($suffix)
    {
        return $this->serieslyUrl . '/' . $suffix;
    }

    /**
     * @param Request $request
     * @return ResponseInterface
     * @throws DatabaseException
     */
    private function execute(Request $request)
    {
        $response = $this->guzzleClient->send($request);

        if ($response->getStatusCode() > 399) {
            throw new DatabaseException('Database API request failed', $response->getStatusCode());
        }

        return $response;
    }

    /**
     * @param string $name
     * @return bool
     *
     * @throws DatabaseException
     */
    public function createDatabase($name)
    {
        $request = new Request('PUT', $this->getUrl($name));

        $response = $this->execute($request);

        return $response->getStatusCode() === 201;
    }

    /**
     * @return array
     * @throws DatabaseException
     */
    public function getDatabases()
    {
        $request = new Request('GET', $this->getUrl('_all_dbs'));

        $response = $this->execute($request);

        return json_decode($response->getBody(), true);
    }

    /**
     * @param string $name
     * @return DatabaseInfo
     * @throws DatabaseException
     */
    public function getDatabaseInfo($name)
    {
        $request = new Request('GET', $this->getUrl($name));

        $response = $this->execute($request);

        $data = json_decode($response->getBody(), true);

        return new DatabaseInfo(
            $data['deleted_count'],
            $data['doc_count'],
            $data['header_pos'],
            $data['last_seq'],
            $data['space_used']
        );
    }

    /**
     * @param string $databaseName
     * @param DataQuery $dataQuery
     * @return array
     * @throws DatabaseException
     */
    public function query($databaseName, DataQuery $dataQuery)
    {
        $request = new Request('GET', $this->getUrl($databaseName . '/_query?' . $dataQuery->getQueryString()));

        $response = $this->execute($request);

        $data = json_decode($response->getBody(), true);

        $resultKeys = $dataQuery->getResultKeys();
        $dataPoints = [];

        foreach ($data as $time => $dataPoint) {
            $dataPoints[$time] = array_combine($resultKeys, $dataPoint);
        }

        return $dataPoints;
    }

    /**
     * @param string $name
     * @return bool
     * @throws DatabaseException
     */
    public function compactDatabase($name)
    {
        $request = new Request('POST', $this->getUrl($name . '/_compact'));

        $response = $this->execute($request);

        return $response->getStatusCode() === 200;
    }
}
