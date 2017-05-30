<?php
/**
 * This file is part of Railgun package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Railgun\Schema;

/**
 * Interface SchemaInterface
 * @package Serafim\Railgun\Schema
 */
interface SchemaInterface
{
    /**
     * @param string $action
     * @param \Closure $then
     * @return mixed
     */
    public function extend(string $action, \Closure $then);
}