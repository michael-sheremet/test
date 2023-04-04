<?php

namespace App\Http\Controllers;


use App\Http\Rules\Company\CreateRules;
use App\Repositories\CompaniesRepositories\CompaniesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    public function index(Request $request, CompaniesRepository $companiesRepository)
    {
        return $companiesRepository->getByUserId(Auth::id());
    }

    public function create(Request $request, CreateRules $createRules, CompaniesRepository $companiesRepository)
    {
        $validData = $this->validate($request, $createRules->rules());
        try {
            $companyId = $companiesRepository->createAndAssign(Auth::id(), $validData);

            return response()->json(array_merge($validData, ['id' => $companyId]));
        } catch (\Exception $exception) {
            return $this->getErrorResponse();
        }

    }
}
