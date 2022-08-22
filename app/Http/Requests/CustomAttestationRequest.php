<?php

namespace App\Http\Requests;

use App\Models\User;
use Laragear\WebAuthn\Contracts\WebAuthnAuthenticatable;
use Laragear\WebAuthn\Http\Requests\AttestationRequest;

class CustomAttestationRequest extends AttestationRequest
{
    /**
     * We override the parent method to force authorization.
     */
    public function authorize(?WebAuthnAuthenticatable $user): bool
    {
        return true;
    }

    /**
     * We must overwrite this if we want to enabled validation
     * rules, since the package removes the default logic.
     */
    public function validateResolved(): void
    {
        $this->prepareForValidation();

        if (! $this->passesAuthorization()) {
            $this->failedAuthorization();
        }

        $instance = $this->getValidatorInstance();

        if ($instance->fails()) {
            $this->failedValidation($instance);
        }

        $this->passedValidation();

        parent::validateResolved(); // <- Do business as usual
    }

    /**
     * Now we can add the rules
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|unique:users,email',
        ];
    }

    /**
     * Create a user to be used for the attestation.
     */
    public function user($guard = null)
    {
        return User::create([
            'email' => $this->validated('email')
        ]);
    }
}
