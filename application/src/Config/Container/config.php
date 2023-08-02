<?php

declare(strict_types=1);

use App\Config\Database\Database;
use App\Http\Service\PasswordValidatorService\PasswordRequirements as RQ;
use App\Http\Service\PasswordValidatorService\PasswordValidator;
use Doctrine\ORM\EntityManagerInterface;

return [
    EntityManagerInterface::class => function (Database $database) {
        return $database->createEntityManager();
    },
    PasswordValidator::class => function () {
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