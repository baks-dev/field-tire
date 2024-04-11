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

namespace BaksDev\Field\Tire\Radius\Choice;

use BaksDev\Core\Services\Fields\FieldsChoiceInterface;
use BaksDev\Core\Services\Reference\ReferenceChoiceInterface;
use BaksDev\Field\Tire\Radius\Form\TireRadiusFieldForm;
use BaksDev\Field\Tire\Radius\Form\TireRadiusFieldFormAvailable;
use BaksDev\Field\Tire\Radius\Form\TireRadiusFieldFormExists;
use BaksDev\Field\Tire\Radius\Type\TireRadiusField;

final class TireRadiusFieldChoice implements FieldsChoiceInterface, ReferenceChoiceInterface
{
	public function equals($key) : bool
	{
		return $key === TireRadiusField::TYPE;
	}
	
	public function type(): string
	{
		return TireRadiusField::TYPE;
	}

    public function class(): string
    {
        return TireRadiusField::class;
    }


    //	public function choice() : array
//	{
//		return TireRadiusField::cases();
//	}
	
	
	public function domain(): string
	{
		return 'field.tire.radius';
	}
	
	
	/** Возвращает класс формы для рендера */
	public function form(): string
	{
		return TireRadiusFieldForm::class;
	}

    /** Возвращает класс формы для рендера c имеющимися размерами в карточках */
    public function formFilterExists(): string
    {
        return TireRadiusFieldFormExists::class;
    }

    /** Возвращает класс формы для рендера c имеющимися размерами в карточках */
    public function formFilterAvailable(): string
    {
        return TireRadiusFieldFormAvailable::class;
    }
	
}