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
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 *
 *
 */

namespace BaksDev\Field\Tire\Euro\Twig;

use BaksDev\Field\Tire\CarType\Type\TireCarTypeEnum;
use BaksDev\Field\Tire\CarType\Type\TireCarTypeField;
use BaksDev\Field\Tire\Euro\Type\TireEuroField;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class TireEuroColorExtension extends AbstractExtension
{
	public function getFunctions() : array
	{
		return [
            new TwigFunction('euro_economy_color', $this->getEconomyColor(...)),
            new TwigFunction('euro_grip_color', $this->getGripColor(...)),
		];
	}
	
	public function getEconomyColor(string $value): string
	{
        return match ($value) {
            'A' => 'background-color: #008F30; color: #FFF;',
            'B' => 'background-color: #58A929; color: #FFF;',
            'C' => 'background-color: #C9D100; color: #000;',
            'D' => 'background-color: #FDEC00; color: #000;',
            'E' => 'background-color: #FBBB01; color: #000;',
            'F' => 'background-color: #EB690B; color: #FFF;',
            'G' => 'background-color: #E3001B; color: #FFF;',
        };
	}
	
	public function getGripColor($value): string
	{
        return match ($value) {
            'A' => 'background-color: #4684D0; color: #FFF;',
            'B' => 'background-color: #5890D4; color: #FFF;',
            'C' => 'background-color: #6A9CD9; color: #FFF;',
            'D' => 'background-color: #7CA8DD; color: #FFF;',
            'E' => 'background-color: #8FB5E2; color: #FFF;',
            'F' => 'background-color: #A1C1E7; color: #FFF;',
            'G' => 'background-color: #B4CDEC; color: #FFF;',
        };
	}

}
