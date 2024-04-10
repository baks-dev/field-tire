<?php
/*
*  Copyright Baks.dev <admin@baks.dev>
*
*  Licensed under the Apache License, Version 2.0 (the "License");
*  you may not use this file except in compliance with the License.
*  You may obtain a copy of the License at
*
*  http://www.apache.org/licenses/LICENSE-2.0
*
*  Unless required by applicable law or agreed to in writing, software
*  distributed under the License is distributed on an "AS IS" BASIS,
*  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
*  See the License for the specific language governing permissions and
*   limitations under the License.
*
*/

namespace BaksDev\Field\Tire\Radius\Type;

use BaksDev\Field\Tire\Radius\Type\Radius\Collection\TireRadiusInterface;
use InvalidArgumentException;

final class TireRadiusField
{
    public const TYPE = 'tire_radius_field';

    private ?TireRadiusInterface $radius = null;

    public function __construct(TireRadiusInterface|self|int|string $radius)
    {
        if(is_string($radius) && class_exists($radius))
        {
            $instance = new $radius();

            if($instance instanceof TireRadiusInterface)
            {
                $this->radius = $instance;
                return;
            }
        }

        if($radius instanceof TireRadiusInterface)
        {
            $this->radius = $radius;
            return;
        }

        if($radius instanceof self)
        {
            $this->radius = $radius->getTireRadius();
            return;
        }

        /** @var TireRadiusInterface $declare */
        foreach(self::getDeclared() as $declare)
        {
            if($declare::equals($radius))
            {
                $this->radius = new $declare;
                return;
            }
        }

        throw new InvalidArgumentException(sprintf('Not found TireRadiusField %s', $radius));

    }

    public function __toString(): string
    {
        return $this->radius?->getValue() ?: '';
    }

    public function getTireRadius(): ?TireRadiusInterface
    {
        return $this->radius;
    }

    public function getTireRadiusValue(): ?string
    {
        return $this->radius?->getValue();
    }

    public static function cases(): array
    {
        $case = [];

        foreach(self::getDeclared() as $radius)
        {
            /** @var TireRadiusInterface $radius */
            $class = new $radius;
            $case[$class::RADIUS] = new self($class);
        }

        ksort($case);

        return $case;
    }

    public static function getDeclared(): array
    {
        return array_filter(
            get_declared_classes(),
            static function($className) {
                return in_array(TireRadiusInterface::class, class_implements($className), true);
            }
        );
    }

    public function equals(mixed $radius): bool
    {
        $radius = new self($radius);

        return $this->getTireRadiusValue() === $radius->getTireRadiusValue();
    }

}