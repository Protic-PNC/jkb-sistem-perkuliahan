<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ExcelFile implements Rule
{
    public function passes($attribute, $value)
    {
        // Periksa apakah file memiliki ekstensi yang valid
        $allowedExtensions = ['xls', 'xlsx'];
        return in_array($value->getClientOriginalExtension(), $allowedExtensions);
    }

    public function message()
    {
        return 'The :attribute must be a valid Excel file.';
    }
}
