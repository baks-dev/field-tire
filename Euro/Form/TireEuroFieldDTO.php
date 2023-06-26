<?php
/*
 *  Copyright 2023.  Baks.dev <admin@baks.dev>
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is furnished
 *  to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 */

declare(strict_types=1);

namespace BaksDev\Field\Tire\Euro\Form;

use BaksDev\Field\Tire\Euro\Type\ChoiceEconomyEnum;
use BaksDev\Field\Tire\Euro\Type\ChoiceGripEnum;
use Symfony\Component\Validator\Constraints as Assert;


final class TireEuroFieldDTO
{

    /** Топливная экономичность */

    private array|ChoiceEconomyEnum|null $economy = null;

    /** Класс сцепления на мокрой дороге */
    private array|ChoiceGripEnum|null $grip = null;

    /** Уровень шума */
    #[Assert\NotBlank]
    private ?int $sound = null;

    /** Топливная экономичность */

    public function getEconomy(): array|ChoiceEconomyEnum|null
    {
        return $this->economy;
    }

    public function setEconomy(array|ChoiceEconomyEnum|null $economy): void
    {
        $this->economy = $economy;
    }

    /** Класс сцепления на мокрой дороге */

    public function getGrip(): array|ChoiceGripEnum|null
    {
        return $this->grip;
    }

    public function setGrip(array|ChoiceGripEnum|null $grip): void
    {
        $this->grip = $grip;
    }

    /** Уровень шума */

    public function getSound(): ?int
    {
        return $this->sound;
    }

    public function setSound(?int $sound): void
    {
        $this->sound = $sound;
    }

}