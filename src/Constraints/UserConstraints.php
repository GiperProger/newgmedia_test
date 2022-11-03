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
     * Length of the `password_hash` column in the database.
     */
    public const COLUMN_LENGTH_PASSWORD_HASH = 120;

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

    /**
     * Minimum length of the password field.
     */
    public const FIELD_LENGTH_MIN_PASSWORD = 8;

    /**
     * Regex the value of the `username` field must match.
     */
    public const REGEX_USERNAME = '/^[a-zA-Z][a-zA-Z0-9_]+$/';
}
