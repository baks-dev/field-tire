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

namespace BaksDev\Field\Tire\Width\Type;

use BaksDev\Field\Tire\Width\Type\Width\Collection\TireWidthInterface;
use InvalidArgumentException;

final class TireWidthField
{
    public const TYPE = 'tire_width_field';

    private ?TireWidthInterface $width = null;

    public function __construct(TireWidthInterface|self|int|string $width)
    {
        if(is_string($width) && class_exists($width))
        {
            $instance = new $width();

            if($instance instanceof TireWidthInterface)
            {
                $this->width = $instance;
                return;
            }
        }

        if($width instanceof TireWidthInterface)
        {
            $this->width = $width;
            return;
        }

        if($width instanceof self)
        {
            $this->width = $width->getTireWidth();
            return;
        }

        /** @var TireWidthInterface $declare */
        foreach(self::getDeclared() as $declare)
        {
            if($declare::equals($width))
            {
                $this->width = new $declare();
                return;
            }
        }
    }

    public function __toString(): string
    {
        return $this->width->getValue();
    }

    public function getTireWidth(): ?TireWidthInterface
    {
        return $this->width;
    }

    public function getTireWidthValue(): ?int
    {
        return $this->width?->getValue();
    }

    public static function cases(): array
    {
        $case = [];

        foreach(self::getDeclared() as $width)
        {
            /** @var TireWidthInterface $width */
            $class = new $width();
            $case[$class::WIDTH] = new self($class);
        }

        ksort($case);

        return $case;
    }

    public static function getDeclared(): array
    {
        return array_filter(
            get_declared_classes(),
            static function ($className) {
                return in_array(TireWidthInterface::class, class_implements($className), true);
            }
        );
    }

    public function equals(mixed $width): bool
    {
        $width = new self($width);

        return $this->getTireWidthValue() === $width->getTireWidthValue();
    }

}
