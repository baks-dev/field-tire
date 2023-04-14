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

use BaksDev\Field\Tire\CarType\Type\TireCarTypeEnum;
use BaksDev\Field\Tire\CarType\Type\TireCarTypeField;
use BaksDev\Field\Tire\Euro\Type\ChoiceEconomyEnum;
use BaksDev\Field\Tire\Euro\Type\ChoiceGripEnum;
use Symfony\Component\Form\DataTransformerInterface;

final class TireEuroFieldTransformer implements DataTransformerInterface
{
    private bool $required;


    public function __construct(bool $required)
    {
        $this->required = $required;
    }

    public function transform(mixed $value)
    {
        $TireEuroFieldDTO = new TireEuroFieldDTO();

        $economy = null;
        $grip = null;

        if ($value && $value !== 'false') {
            $value = json_decode($value);

            if ($value[0]) {
                $economy = ChoiceEconomyEnum::from($value[0]);
            }


            if ($value[1]) {
                $grip = ChoiceGripEnum::from($value[1]);
            }


            if ($this->required) {

                if ($economy) {
                    $TireEuroFieldDTO->setEconomy($economy);
                }

                if ($grip) {
                    $TireEuroFieldDTO->setGrip($grip);
                }

            }
            else
            {

                if ($economy) {
                    $TireEuroFieldDTO->setEconomy([$economy]);
                }
                if ($grip) {
                    $TireEuroFieldDTO->setGrip([$grip]);
                }
            }

            $TireEuroFieldDTO->setSound($value[2]);
        }

        return $TireEuroFieldDTO;
    }


    public function reverseTransform(mixed $value): string
    {
        /** @var \BaksDev\Field\Tire\Euro\Form\TireEuroFieldDTO $value */

        $economy = $value->getEconomy();
        $grip = $value->getGrip();

        if (!$this->required) {
            $economy = end($economy);
            $grip = end($grip);
        }

        $sound = $value->getSound();

        if (!$economy || !$grip || !$sound)
        {
            return 'false';
        }

        return json_encode([$economy->value ?? null, $grip->value ?? null, $sound], JSON_THROW_ON_ERROR);
    }

}