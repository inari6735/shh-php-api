<?php

declare(strict_types=1);

use App\Component\Validator\PasswordValidator\PasswordValidator;
use App\Config\Database\Database;
use App\Http\Service\PasswordValidatorService\PasswordRequirements as RQ;
use Doctrine\ORM\EntityManagerInterface;

return [
    EntityManagerInterface::class => function (Database $database) {
        return $database->createEntityManager();
    },
    PasswordValidator::class => function () {
        $passwordValidator = new PasswordValidator();

        $passwordValidator->validators = [
            new \App\Component\Validator\PasswordValidator\PasswordRequirements\LowercaseRequirement(),
            new \App\Component\Validator\PasswordValidator\PasswordRequirements\NumberRequirement(),
            new \App\Component\Validator\PasswordValidator\PasswordRequirements\SpecialCharsRequirement(),
            new \App\Component\Validator\PasswordValidator\PasswordRequirements\UppercaseRequirement(),
            new \App\Component\Validator\PasswordValidator\PasswordRequirements\LengthRequirement()
        ];

        return $passwordValidator;
    }
];