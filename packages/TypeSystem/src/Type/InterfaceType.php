<?php

/**
 * This file is part of GraphQL TypeSystem package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Railt\TypeSystem\Type;

use Railt\TypeSystem\Common\FieldsTrait;
use Railt\TypeSystem\Common\InterfacesTrait;
use GraphQL\Contracts\TypeSystem\Type\InterfaceTypeInterface;

/**
 * {@inheritDoc}
 */
class InterfaceType extends NamedType implements InterfaceTypeInterface
{
    use FieldsTrait;
    use InterfacesTrait;
}
