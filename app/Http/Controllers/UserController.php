<?php

namespace app\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    /**
     * Construct Respository
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * User list with vehicles
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(
            ['data' => $this->userRepository->getAllUsers()],
            200
        );
    }

    /**
     * Save new User
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->validatePostRequest($request);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->password)
        ]);

        return response()->json(['data' => "The user with with id {$user->id} has been created"], 201);
    }

    /**
     * Show user Details/info
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $userId = $request->route('id');

        return response()->json(
            ['data' => $this->userRepository->getUserById($userId)],
            200
        );
    }

    /**
     * Update User details
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $this->validatePutRequest($request);

        $userId = $request->route('id');

        $userDetails = $request->only([
            'email', 'password'
        ]);

        return response()->json(
            ['data' =>  $this->userRepository->updateUser($userId, $userDetails)],
            200
        );
    }

    /**
     * Delete user and remove vehicle association
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $userId = $request->route('id');

        return response()->json(
            ['data' => $this->userRepository->deleteUser($userId)],
            410
        );
    }

    /**
     * Request validation for POST method
     *
     * @param Request $request
     * @return void
     */
    public function validatePostRequest(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ];

        $this->validate($request, $rules);
    }

    /**
     * Request validation for PUT/PATCH method
     *
     * @param Request $request
     * @return void
     */
    public function validatePutRequest(Request $request)
    {
        $rules = [
            'email' => 'email',
            'password' => 'min:6'
        ];

        $this->validate($request, $rules);
    }
}
