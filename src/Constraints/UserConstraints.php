<?php declare(strict_types=1);

namespace App\Constraints;


/**
 * Constraints for the {@see User} entity.
 *
 * @author  Sergey Prydkin <GiperProger@gmail.com>
 * @since   1.0
 */
abstract class UserConstraints
{
    /**
     * Length of the `username` column in the database.
     */
    public const COLUMN_LENGTH_USERNAME = 120;

    /**
     * Length of the `email` column in the database.
     */
    public const COLUMN_LENGTH_EMAIL = 50;

    /**
     * Minimum length of the username field.
     */
    public const FIELD_LENGTH_MIN_USERNAME = 5;

    /**
     * Maximum length of the username field.
     */
    public const FIELD_LENGTH_MAX_USERNAME = 24;


    /**
     * Minimum length of the username field.
     */
    public const FIELD_LENGTH_MIN_EMAIL = 7;

    /**
     * Maximum length of the username field.
     */
    public const FIELD_LENGTH_MAX_EMAIL = 20;
}
