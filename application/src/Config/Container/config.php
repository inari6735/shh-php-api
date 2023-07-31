<?php

declare(strict_types=1);

use App\Config\Database\Database;
use App\Http\Service\PasswordValidatorService\PasswordValidator;
use App\Http\Service\PasswordValidatorService\PasswordValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Http\Service\PasswordValidatorService\PasswordRequirements as RQ;

return [
    EntityManagerInterface::class => function (Database $database) {
        return $database->createEntityManager();
    },
    PasswordValidatorInterface::class => function () {
        $passwordValidator = new PasswordValidator();

        $passwordValidator->validators = [
            new RQ\LowercaseRequirement(),
            new RQ\NumberRequirement(),
            new RQ\SpecialCharsRequirement(),
            new RQ\UppercaseRequirement(),
            new RQ\LengthRequirement()
        ];

        return $passwordValidator;
    }
];