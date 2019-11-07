<?php

/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Railt\SDL\TypeSystem\Type;

use GraphQL\Contracts\TypeSystem\Type\NonNullTypeInterface;

/**
 * {@inheritDoc}
 */
class NonNullType extends WrappingType implements NonNullTypeInterface
{
    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return \sprintf('%s!', (string)$this->getOfType());
    }

    /**
     * @return string
     */
    public function getKind(): string
    {
        return 'NON_NULL';
    }
}