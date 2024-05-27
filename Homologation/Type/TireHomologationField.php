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

namespace BaksDev\Field\Tire\Homologation\Type;

use BaksDev\Field\Tire\Homologation\Type\Choice\Collection\TireHomologationInterface;
use InvalidArgumentException;

final class TireHomologationField
{
    public const TYPE = 'tire_homologation_field';

    private ?TireHomologationInterface $homologation = null;

    public function __construct(TireHomologationInterface|self|int|string $homologation)
    {
        if(is_string($homologation) && class_exists($homologation))
        {
            $instance = new $homologation();

            if($instance instanceof TireHomologationInterface)
            {
                $this->homologation = $instance;
                return;
            }
        }

        if($homologation instanceof TireHomologationInterface)
        {
            $this->homologation = $homologation;
            return;
        }

        if($homologation instanceof self)
        {
            $this->homologation = $homologation->getTireHomologation();
            return;
        }

        /** @var TireHomologationInterface $declare */
        foreach(self::getDeclared() as $declare)
        {
            if($declare::equals($homologation))
            {
                $this->homologation = new $declare;
                return;
            }
        }

        //throw new InvalidArgumentException(sprintf('Not found TireHomologationField %s', $homologation));

    }

    public function __toString(): string
    {
        return $this->homologation?->getValue() ?: '';
    }

    public function getTireHomologation(): ?TireHomologationInterface
    {
        return $this->homologation;
    }

    public function getTireHomologationValue(): ?string
    {
        return $this->homologation?->getValue();
    }

    public static function cases(): array
    {
        $case = [];

        foreach(self::getDeclared() as $homologation)
        {
            /** @var TireHomologationInterface $homologation */
            $class = new $homologation;
            $case[$class::HOMOLOGATION] = new self($class);
        }

        ksort($case);

        return $case;
    }

    public static function getDeclared(): array
    {
        return array_filter(
            get_declared_classes(),
            static function($className) {
                return in_array(TireHomologationInterface::class, class_implements($className), true);
            }
        );
    }

    public function equals(mixed $homologation): bool
    {
        $homologation = new self($homologation);

        return $this->getTireHomologationValue() === $homologation->getTireHomologationValue();
    }

}