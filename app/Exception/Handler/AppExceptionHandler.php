<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Exception\Handler;

use App\Constant\ApiCode;
use App\Constant\HttpCode;
use App\Data\ApiResult;
use App\Exception\ApiException;
use App\Utils\System;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Database\Model\ModelNotFoundException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Exception\ForbiddenHttpException;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;
use Hyperf\HttpMessage\Exception\UnauthorizedHttpException;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    public function __construct(protected StdoutLoggerInterface $logger)
    {
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $message = $throwable->getMessage();
        $httpStatus = HttpCode::INTERNAL_SERVER_ERROR;
        $body = 'Internal Server Error.';

        if ($throwable instanceof ApiException) {
            $message = $throwable->error ?: $throwable->getMessage();
            $httpStatus = HttpCode::OK;
            $response = $response->withAddedHeader('Content-Type', 'application/json');
            $body = json_encode(new ApiResult($throwable->getMessage(), $throwable->getCode()));
        }
        elseif ($throwable instanceof ValidationException) {
            $httpStatus = HttpCode::OK;
            $response = $response->withAddedHeader('Content-Type', 'application/json');
            $errors = $throwable->errors();
            $message = array_shift($errors)[0] ?? $throwable->getMessage();
            $body = json_encode(new ApiResult($message, ApiCode::PARAMS_VERIFY_FAIL));
        }
        elseif ($throwable instanceof UnauthorizedHttpException) {
            $httpStatus = $throwable->getCode();
            $body = '401 Unauthorized';
        }
        elseif (
            $throwable instanceof SignatureInvalidException
            || $throwable instanceof ExpiredException
            || $throwable instanceof BeforeValidException
            || $throwable instanceof ForbiddenHttpException
        ) {
            $httpStatus = $throwable->getCode();
            $body = '403 Forbidden';
        }
        elseif (
            $throwable instanceof ModelNotFoundException
            || $throwable instanceof NotFoundHttpException
        ) {
            $httpStatus = $throwable->getCode();
            $body = '404 NotFound';
        }

        $this->logger->error(sprintf('%s[%s] in %s', $message, $throwable->getLine(), $throwable->getFile()));
        $this->logger->error($throwable->getTraceAsString());

        return $response->withStatus($httpStatus)->withBody(new SwooleStream($body));
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
