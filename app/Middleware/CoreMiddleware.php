<?php
declare(strict_types=1);


namespace App\Middleware;

use Hyperf\Codec\Json;
use Hyperf\Contract\Arrayable;
use Hyperf\Contract\Jsonable;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CoreMiddleware extends \Hyperf\HttpServer\CoreMiddleware
{
    protected function transferToResponse($response, ServerRequestInterface $request): ResponseInterface
    {
        if (is_string($response)) {
            return $this->response()->withAddedHeader('content-type', 'text/plain')->withBody(new SwooleStream($response));
        }

        if (is_array($response) || $response instanceof Arrayable) {
            return $this->response()
                ->withAddedHeader('content-type', 'application/json')
                ->withBody(new SwooleStream(Json::encode($response)));
        }

        if ($response instanceof Jsonable) {
            return $this->response()
                ->withAddedHeader('content-type', 'application/json')
                ->withBody(new SwooleStream((string) $response));
        }

        if (is_object($response)) {
            return $this->response()->withAddedHeader('content-type', 'application/json')->withBody(new SwooleStream(json_encode($response)));
        }

        return $this->response()->withHeader('content-type', 'text/plain')->withBody(new SwooleStream((string) $response));
    }
}