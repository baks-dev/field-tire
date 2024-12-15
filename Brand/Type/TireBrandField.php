<?php
/*
 *  Copyright 2024.  Baks.dev <admin@baks.dev>
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

namespace BaksDev\Field\Tire\Brand\Type;

final class TireBrandField
{
    public const string TYPE = 'tire_brand_field';
	
	private TireBrandEnum $value;
	
	
	public function __construct(string|TireBrandEnum $value)
	{
		if($value instanceof TireBrandEnum)
		{
			$this->value = $value;
		}
		else
		{
			$this->value = TireBrandEnum::from($value);
		}
	}
	
	public function __toString(): string
	{
		return $this->value->value;
	}
	
	/** Возвращает числовое значение   */
	public function getTireBrandEnumValue(): string
	{
		return $this->value->value;
	}
	
	/** Возвращает ключ значения */
	public function getTireBrandEnumName(): string
	{
		return $this->value->name;
	}
	
	/** Возвращает значение Enum   */
	public function getTireBrandEnum() : TireBrandEnum
	{
		return $this->value;
	}
	
	/** Возвращает массив из значнией TireProfileEnum */
	public static function cases() : array
	{
		$case = null;
		
		foreach(TireBrandEnum::cases() as $color)
		{
			$case[] = new self($color);
		}
		
		return $case;
	}
}