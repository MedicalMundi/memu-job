<?php declare(strict_types=1);


namespace Ingesting\SharedKernel\Infrastructure\FeedIoAdapter;

use DateTime;
use FeedIo\Adapter\ClientInterface;
use FeedIo\Adapter\NotFoundException;
use FeedIo\Adapter\ResponseInterface;
use FeedIo\Adapter\ServerErrorException;

/**
 * GazzettaClient Http dependent Symfony HTTP client
 */
class GazzettaClient implements ClientInterface
{
    /**
     * Default user agent provided with the package
     */
    public const DEFAULT_USER_AGENT = 'Mozilla/5.0 (X11; U; Linux i686; fr; rv:1.9.1.1) Gecko/20090715 Firefox/3.5.1';

    public function __construct(
        protected object $symfonyClient,
        protected string $userAgent
    ) {
    }

    /**
     * @param  string $userAgent The new user-agent
     */
    public function setUserAgent(string $userAgent): GazzettaClient
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    public function getResponse(string $url, DateTime $modifiedSince = null): ResponseInterface
    {
        //        if ($modifiedSince) {
        //            //$headResponse = $this->request('HEAD', $url, $modifiedSince);
        //            $headResponse = $this->request('HEAD', $url, $modifiedSince);
        //            if (304 === $headResponse->getStatusCode()) {
        //                return $headResponse;
        //            }
        //        }

        return $this->request('GET', $url, $modifiedSince);
    }

    /**
     * @return ResponseInterface
     * throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request(string $method, string $url, DateTime $modifiedSince = null): ResponseInterface
    {
        $this->getOptions($modifiedSince);
        $duration = 0;
        // TODO FIX
        //        $options['on_stats'] = function (TransferStats $stats) use (&$duration) {
        //            $duration = $stats->getTransferTime();
        //        };
        //$psrResponse = $this->symfonyClient->request($method, $url, $options);
        $psrResponse = $this->symfonyClient->request($method, $url, [
            'verify_host' => false,
            'verify_peer' => false,
        ]);
        switch ((int) $psrResponse->getStatusCode()) {
            case 200:
            case 304:
                return new Response($psrResponse, $duration);
            case 404:
                throw new NotFoundException('not found', $duration);
            default:
                throw new ServerErrorException($psrResponse, $duration);
        }
    }

    protected function getOptions(DateTime $modifiedSince = null): array
    {
        $headers = [
            'Accept-Encoding' => 'gzip, deflate',
            'User-Agent' => $this->userAgent,
        ];
        if ($modifiedSince) {
            $headers['If-Modified-Since'] = $modifiedSince->format(DateTime::RFC2822);
        }
        return [
            'http_errors' => false,
            'timeout' => 30,
            'headers' => $headers,
        ];
    }
}
