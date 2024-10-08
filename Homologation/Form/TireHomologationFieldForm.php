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

namespace BaksDev\Field\Tire\Homologation\Form;

use BaksDev\Field\Tire\Homologation\Type\TireHomologationField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

final class TireHomologationFieldForm extends AbstractType
{
    public function __construct(
        private readonly TireHomologationFieldTransformer $transformer,
        private readonly TranslatorInterface $translator
    ) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer($this->transformer);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $cases = TireHomologationField::cases();

        $resolver->setDefaults([
            'choices' => $cases,
            'choice_value' => function (?TireHomologationField $homologation) {
                return $homologation?->getTireHomologationValue();
            },
            'choice_label' => function (TireHomologationField $homologation) {

                $value = $homologation->getTireHomologationValue();

                return match ($value)
                {
                    'false', => $this->translator->trans($homologation?->getTireHomologationValue(), domain: 'field.tire.homologation'),
                    default => $value
                };
            },
            'choice_attr' => function (?TireHomologationField $homologation) {

                $value = $homologation?->getTireHomologationValue();

                return match ($value)
                {
                    'false', => [],
                    default => ['data-filter' => $this->translator->trans($homologation?->getTireHomologationValue(), domain: 'field.tire.homologation')]
                };
            },

            //'translation_domain' => 'field.tire.homologation',
            'placeholder' => $this->translator->trans('placeholder', domain: 'field.tire.homologation'),
            'attr' => ['data-select' => 'select2'],
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

}
