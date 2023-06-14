<?php

namespace App\Enums;

enum ProductStatus: string
{
    case D = "draft";
    case T = "trash";
    case P = "published";

    public static function fromValue(string $name): string
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name) {
                return $status->value;
            }
        }

        throw new \ValueError("$status is not a valid");
    }
}