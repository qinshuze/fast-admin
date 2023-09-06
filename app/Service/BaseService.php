<?php
declare(strict_types=1);


namespace App\Service;

use Hyperf\Database\Model\Model;

abstract class BaseService
{
    abstract function getModel(): Model;
}