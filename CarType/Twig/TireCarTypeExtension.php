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

namespace BaksDev\Field\Tire\CarType\Twig;

use BaksDev\Field\Tire\CarType\Type\TireCarTypeEnum;
use BaksDev\Field\Tire\CarType\Type\TireCarTypeField;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class TireCarTypeExtension extends AbstractExtension
{
	public function getFunctions() : array
	{
		return [
			new TwigFunction(TireCarTypeField::TYPE, [$this, 'content'], ['needs_environment' => true, 'is_safe' => ['html']]),
			new TwigFunction(TireCarTypeField::TYPE.'_render', [$this, 'render'], ['needs_environment' => true, 'is_safe' => ['html']]),
			new TwigFunction(TireCarTypeField::TYPE.'_template', [$this, 'template'], ['needs_environment' => true, 'is_safe' => ['html']]),
		];
	}
	
	public function content(Environment $twig, string $value): string
	{
		try
		{
			return $twig->render('@Template/TireCarTypeField/content.html.twig', ['value' => $value]);
		}
		catch(LoaderError $loaderError)
		{
			return $twig->render('@TireCarTypeField/content.html.twig', ['value' => $value]);
		}
	}
	
	public function render(Environment $twig, $value): string
	{
		try
		{
			return $twig->render('@Template/TireCarTypeField/render.html.twig', ['value' => $value]);
		}
		catch(LoaderError $loaderError)
		{
			return $twig->render('@TireCarTypeField/render.html.twig', ['value' => $value]);
		}
	}
	
	
	public function template(Environment $twig, $value): string
	{
		try
		{
			return $twig->render('@Template/TireCarTypeField/template.html.twig', ['value' => $value]);
		}
		catch(LoaderError $loaderError)
		{
			return $twig->render('@TireCarTypeField/template.html.twig', ['value' => $value]);
		}
	}
	
}
