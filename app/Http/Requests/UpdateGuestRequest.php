<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateGuestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $guestId = $this->route('guest');

        return [
            'name' => ['string', 'max:255'],
            'surname' => ['string', 'max:255'],
            'phone' => ['string', 'max:255', 'unique:guests,phone,' . $guestId],
            'email' => ['email', 'max:255', 'unique:guests,email,' . $guestId],
            'country' => ['string', 'max:255'],
        ];
    }
}
