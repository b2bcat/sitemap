<?php

namespace B2bcat\SiteMap\Validation;

use B2bcat\SiteMap\Exceptions\InvalidDataException;
use B2bcat\SiteMap\SiteMap;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class DataValidator extends Validator
{
    /**
     * @throws InvalidDataException
     */
    public function validate (): void
    {
        $constraint = new Assert\All([
            'constraints' => [
                new Assert\Collection([
                    'fields'             => [
                        'loc'        => new Assert\Required(
                            new Assert\Url([])
                        ),
                        'lastmod'    => new Assert\DateTime([]),
                        'priority'   => new Assert\Type([
                            'type' => 'float',
                        ]),
                        'changefreq' => new Assert\Choice([
                            'choices' => SiteMap::ATTR_CHANGE_FREC_VALUES,
                        ]),
                    ],
                    'allowMissingFields' => true
                ]),
            ],

        ]);
        $validator = Validation::createValidator();
        $violationList = $validator->validate($this->getData(), $constraint);

        if ($violationList->count()) {
            throw new InvalidDataException('Validation: ' . $violationList->get(0)->getMessage());
        }
    }
}
