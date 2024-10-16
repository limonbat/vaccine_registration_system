<?php

namespace App\Http\Controllers;

use App\Exceptions\RegistrationException;
use App\Http\Requests\RegistrationRequest;
use App\Services\RegistrationService;
use App\VaccineCenter;
use \Illuminate\Http\RedirectResponse;

class RegistrationController extends Controller
{
    private $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function create()
    {
        $centers = VaccineCenter::all();
        return view('registration.create', compact('centers'));
    }

    /**
     * @throws RegistrationException
     */
    public function store(RegistrationRequest $request): RedirectResponse
    {
        $responseMessage = $this->registrationService->registerUser($request->validated());
        return redirect('/')->with('message',$responseMessage);
    }

}
