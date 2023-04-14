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
use BaksDev\Field\Tire\Euro\Type\TireEuroField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

final class TireEuroFieldForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $required = $options['required'];

        $builder->addModelTransformer(new TireEuroFieldTransformer($required));

        $builder
            ->add('economy', ChoiceType::class, [
                'choices' => ChoiceEconomyEnum::cases(),
                'choice_value' => function (?ChoiceEconomyEnum $economy) {
                    return $economy?->value;
                },
                'choice_label' => function (ChoiceEconomyEnum $economy) {
                    return $economy?->name;
                },
                'choice_attr' => function ($choice) use ($required) {

                    if ($required && $choice === ChoiceEconomyEnum::A) {
                        return ['checked' => 'checked', 'class' => 'change-economy'];
                    }
                    return ['class' => 'change-economy'];
                },

                'label' => 'economy',
                'expanded' => true,
                'multiple' => !$required,
                'required' => $required,
            ]);

        $builder
            ->add('grip', ChoiceType::class, [
                'choices' => ChoiceGripEnum::cases(),
                'choice_value' => function (?ChoiceGripEnum $grip) {
                    return $grip?->value;
                },
                'choice_label' => function (ChoiceGripEnum $grip) {
                    return $grip?->name;
                },
                'choice_attr' => function ($choice) use ($required) {

                    if ($required && $choice === ChoiceGripEnum::A) {
                        return ['checked' => 'checked', 'class' => 'change-grip'];
                    }

                    return ['class' => 'change-grip'];
                },

                'label' => 'grip',
                'expanded' => true,
                'multiple' => !$required,
                'required' => $required,
            ]);


        $builder
            ->add('sound', IntegerType::class, [
                'label' => 'sound',
                'required' => $required,
                'attr' => ['class' => 'euro-sound']
            ]);


    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TireEuroFieldDTO::class,
            'translation_domain' => 'field.tire.euro'
        ]);
    }


    public function getBlockPrefix(): string
    {
        return TireEuroField::TYPE;
    }

    public function validate(ExecutionContextInterface $context, $payload)
    {
        dd('ajhvf');
    }

}