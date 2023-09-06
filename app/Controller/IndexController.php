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
namespace App\Controller;

use App\Annotation\AfterCallback;
use App\Annotation\BeforeCallback;
use App\Annotation\Permission;
use App\Model\SysUser;
use App\Service\AuthService;
use App\Service\LoginUser;
use App\Utils\Auth;
use Hyperf\HttpServer\Annotation\AutoController;

#[AutoController]
//#[Middleware(AuthMiddleware::class)]
class IndexController extends AbstractController
{

//    #[Permission('Index:index', '首页')]
    #[BeforeCallback('var_dump', ['before'])]
    #[AfterCallback('var_dump', ['after'])]
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();
        $token = Auth::login(SysUser::findOrFail(1));
        var_dump($this->test()->id);

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
            'token' => $token,
            'user' => Auth::user($token)
        ];
    }

    public function test()
    {
        $s = new SysUser();
        try {
            $s->id = 1;
            return $s;
        } finally {
            $s->id = 2;
        }
    }
}
