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

namespace BaksDev\Field\Tire\Radius\Twig;

use BaksDev\Field\Tire\Radius\Type\TireRadiusEnum;
use BaksDev\Field\Tire\Radius\Type\TireRadiusField;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

final class TireRadiusExtension extends AbstractExtension
{
	public function getFunctions() : array
	{
		return [
			new TwigFunction(TireRadiusField::TYPE, [$this, 'content'], ['needs_environment' => true, 'is_safe' => ['html']]),
			new TwigFunction(TireRadiusField::TYPE.'_render', [$this, 'render'], ['needs_environment' => true, 'is_safe' => ['html']]),
			new TwigFunction(TireRadiusField::TYPE.'_template', [$this, 'template'], ['needs_environment' => true, 'is_safe' => ['html']]),
		];
	}
	
	public function content(Environment $twig, ?string $value): ?string
	{
        if(!$value) { return null; }

		try
		{
			return $twig->render('@Template/TireRadiusField/content.html.twig', ['value' => $value]);
		}
		catch(LoaderError $loaderError)
		{
			return $twig->render('@TireRadiusField/content.html.twig', ['value' => $value]);
		}
	}
	
	public function render(Environment $twig, ?string $value): ?string
	{
        if(!$value) { return null; }

		try
		{
			return $twig->render('@Template/TireRadiusField/render.html.twig', ['value' => $value]);
		}
		catch(LoaderError $loaderError)
		{
			return $twig->render('@TireRadiusField/render.html.twig', ['value' => $value]);
		}
	}
	
	public function template(Environment $twig, ?string $value): ?string
	{
        if(!$value) { return null; }

		try
		{
			return $twig->render('@Template/TireRadiusField/template.html.twig', ['value' => $value]);
		}
		catch(LoaderError $loaderError)
		{
			return $twig->render('@TireRadiusField/template.html.twig', ['value' => $value]);
		}
	}
	
}
