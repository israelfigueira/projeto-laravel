<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TokenRequest;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
    * @OA\Post(path="/auth/login", tags={"Auth"},
    *   summary="Post your email and password and we will return a token. Use the token in the 'Authorization' header like so 'Bearer YOUR_TOKEN'",
    *   operationId="",
    *   description="",
    *   @OA\RequestBody(
    *       required=true,
    *       description="The Token Request",
    *       @OA\JsonContent(
    *        @OA\Property(property="email",type="string",example="your@email.com"),
    *        @OA\Property(property="password",type="string",example="YOUR_PASSWORD"),
    *       )
    *   ),
    *   @OA\Response(
    *     response=200,
    *     description="OK",
    *     @OA\JsonContent(
    *        @OA\Property(property="email",type="string",example="your@email.com"),
    *        @OA\Property(property="password",type="string",example="YOUR_PASSWORD"),
    *       )
    *   ),
    *   @OA\Response(response=422, description="The provided credentials are incorrect.")
    * )
    * Login The User
    * @param Request $request
    * @return \Illuminate\Http\JsonResponse
    */
    public function login(TokenRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
    * @OA\Post(
    *   path="/auth/me",
    *   tags={"Auth"},
    *   security={ {"bearerAuth": {} }},
    *   summary="Informações do usuário proprietário do token",
    *   operationId="me",
    *   description="Informações do usuário proprietário do token",
    *   @OA\Response(
    *     response=200,
    *     description="OK",
    *     @OA\JsonContent(
    *        @OA\Property(property="email",type="string",example="your@email.com"),
    *        @OA\Property(property="password",type="string",example="YOUR_PASSWORD"),
    *       )
    *   ),
    *   @OA\Response(response=422, description="The provided credentials are incorrect.")
    * )
    * Get the authenticated User.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
