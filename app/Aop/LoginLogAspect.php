<?php
declare(strict_types=1);


namespace App\Aop;

use App\Annotation\LoginLog;
use App\Constant\LoginState;
use App\Model\SysLoginLog;
use App\Request\BaseFormRequest;
use App\Utils\Auth;
use App\Utils\System;
use Exception;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Validation\Request\FormRequest;

#[Aspect]
class LoginLogAspect extends AbstractAspect
{

    #[Inject]
    protected RequestInterface $request;

    public array $annotations = [
        LoginLog::class
    ];

    /**
     * @throws \Hyperf\Di\Exception\Exception
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $metadata = $proceedingJoinPoint->getAnnotationMetadata();

        /** @var LoginLog $annotation */
        $annotation = $metadata->method[LoginLog::class] ?? null;
        assert($annotation);

        // 获取登录账号
        $account   = '';
        $refMethod = $proceedingJoinPoint->getReflectMethod();
        foreach ($refMethod->getParameters() as $parameter) {
            $value = $proceedingJoinPoint->arguments['keys'][$parameter->name];

            if ($parameter->name == $annotation->accountKey && is_string($value)) {
                $account = $value;
                break;
            }

            if ($value instanceof BaseFormRequest) {
                $account = $value->{$annotation->accountKey};
                break;
            }

            if ($value instanceof FormRequest) {
                $account = $value->validated()[$annotation->accountKey] ?? '';
                break;
            }
        }

        $status = LoginState::SUCCESS;
        $statusMsg = 'ok';
        try {
            return $proceedingJoinPoint->process();
        } catch (Exception $e) {
            $status     = LoginState::FAIL;
            $statusMsg = $e->getMessage();
            throw $e;
        } finally {
            // 添加登录日志
            $loginLog             = new SysLoginLog();
            $loginLog->account    = $account;
            $loginLog->login_time = time();
            $loginLog->ip         = System::getClientIp($this->request);
            $loginLog->status     = $status;
            $loginLog->status_msg = $statusMsg;
            $loginLog->user_agent = $this->request->header('User-Agent');
            $loginLog->save();
        }
    }
}