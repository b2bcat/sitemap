<?php

namespace B2bcat\SiteMap\Validation;

use B2bcat\SiteMap\Exceptions\InvalidFileTypeException;
use B2bcat\SiteMap\SiteMap;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class FileTypeValidator extends Validator
{
    /**
     * @throws InvalidFileTypeException
     */
    public function validate (): void
    {
        $constraint = new Assert\Choice([
            'choices' => SiteMap::FILE_TYPES,
            'message' => 'Incorrect file type: {{ value }}.',
        ]);

        $validator = Validation::createValidator();
        $violationList = $validator->validate($this->getData(), $constraint);

        if ($violationList->count()) {
            throw new InvalidFileTypeException($violationList->get(0)->getMessage());
        }
    }
}
