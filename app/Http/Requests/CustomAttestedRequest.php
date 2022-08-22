<?php

namespace App\Http\Requests;

use App\Models\User;
use Laragear\WebAuthn\Contracts\WebAuthnAuthenticatable;
use Laragear\WebAuthn\Http\Requests\AttestedRequest;

class CustomAttestedRequest extends AttestedRequest
{
    /**
     * We override the parent method to force authorization.
     */
    public function authorize(?WebAuthnAuthenticatable $user): bool
    {
        return true;
    }

    /**
     * We add a rule for the email address that we send in the request.
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'email' => 'required|string|email|exists:users,email',
        ]);
    }

    /**
     * Create a user to be used for the attestation.
     */
    public function user($guard = null)
    {
        return User::firstWhere('email', $this->post('email'));
    }
}
