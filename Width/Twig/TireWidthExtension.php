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

namespace BaksDev\Field\Tire\Width\Twig;

use BaksDev\Field\Tire\Width\Type\TireWidthEnum;
use BaksDev\Field\Tire\Width\Type\TireWidthField;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class TireWidthExtension extends AbstractExtension
{
	public function getFunctions() : array
	{
		return [

			new TwigFunction(TireWidthField::TYPE, [$this, 'content'], ['needs_environment' => true, 'is_safe' => ['html']]),
			new TwigFunction(TireWidthField::TYPE.'_render', [$this, 'render'], ['needs_environment' => true, 'is_safe' => ['html']]),
			new TwigFunction(TireWidthField::TYPE.'_template', [$this, 'template'], ['needs_environment' => true, 'is_safe' => ['html']]),
		];
	}
	
	
	public function content(Environment $twig, string $value) : string
	{
		try
		{
			return $twig->render('@Template/TireWidthField/content.html.twig', ['value' => $value]);
		}
		catch(LoaderError $loaderError)
		{
			return $twig->render('@TireWidthField/content.html.twig', ['value' => $value]);
		}
	}
	
	public function render(Environment $twig, $value) : string
	{
		try
		{
			return $twig->render('@Template/TireWidthField/render.html.twig', ['value' => $value]);
		}
		catch(LoaderError $loaderError)
		{
			return $twig->render('@TireWidthField/render.html.twig', ['value' => $value]);
		}
	}
	
	
	public function template(Environment $twig, $value) : string
	{
		try
		{
			return $twig->render('@Template/TireWidthField/template.html.twig', ['value' => $value]);
		}
		catch(LoaderError $loaderError)
		{
			return $twig->render('@TireWidthField/template.html.twig', ['value' => $value]);
		}
	}
	
}
