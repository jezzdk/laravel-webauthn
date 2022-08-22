<?php

namespace App\Http\Controllers\WebAuthn;

use App\Http\Requests\CustomAttestationRequest;
use App\Http\Requests\CustomAttestedRequest;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use function response;

class WebAuthnRegisterController
{
    /**
     * Returns a challenge to be verified by the user device.
     *
     * @param  \Laragear\WebAuthn\Http\Requests\AttestationRequest  $request
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function options(CustomAttestationRequest $request): Responsable
    {
        return $request
            ->fastRegistration()
//            ->userless()
//            ->allowDuplicates()
            ->toCreate();
    }

    /**
     * Registers a device for further WebAuthn authentication.
     *
     * @param  \Laragear\WebAuthn\Http\Requests\AttestedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(CustomAttestedRequest $request): Response
    {
        $request->save();

        return response()->noContent();
    }
}
