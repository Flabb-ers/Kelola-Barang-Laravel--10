<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;


class UniqueKodeAcrossKeluarAndBarang implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $existsInKeluars = DB::table('keluars')->where('kode', $value)->exists();
        $existsInBarangs = DB::table('barangs')->where('kode', $value)->exists();
        return !$existsInKeluars && !$existsInBarangs;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Kode sudah digunakan';
    }
}
