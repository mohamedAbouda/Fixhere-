<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\UserRegisteration;
use App\Http\Requests\Apis\UserAuthentication;
use App\Http\Requests\Apis\UserSocialRegisteration;
use App\Http\Requests\Apis\UserSocialAuthentication;
use App\Transformers\UserTransformer;
use App\Transformers\ClientTransformer;
use App\Mail\ForgetPasswordMail;
use App\Mail\UserRegisterationMail;
use App\Mail\UserVerificationCodeMail;
use App\User;
use App\Role;
use Carbon\Carbon;
use JWTAuth;
use Auth;
use Mail;

class AuthController extends Controller
{
    /**
    * 404: entity not found
    * 405: invalid token or token not provided
    * 403: deactivated by admin
    * 406: not confirmed
    */

    public function register(UserRegisteration $request)
    {
        $input = $request->all();

        $user = User::create($input);

        $token = JWTAuth::fromUser($user,[
            'exp' => Carbon::now()->addMonth()->timestamp,
        ]);

        $role = Role::where('name', 'client')->first();
        $user->attachRole($role);

        $email = $user->email;

        //send email with verification code
        try {
            Mail::to($email)->send(new UserRegisterationMail($user));
        } catch (\Exception $e) {
        }

        return response()->json([
            'status' => 'true',
            'message'=>'Thanks for signing up!',
            'data'=>fractal()
            ->item($user)
            ->addMeta(['token' => $token])
            ->transformWith(new ClientTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray(),
        ],200);
    }

    public function login(UserAuthentication $request)
    {
        try{
            $token = JWTAuth::attempt($request->only('email','password'),[
                'exp' => Carbon::now()->addweek()->timestamp
            ]);
        }catch(JWTException $e){
            return response()->json([
                'status' => 'false',
                'message' => 'error',
                'errors' => [
                    'Wrong credentials.'
                ],
            ],422);
        }

        if(!$token){
            return response()->json([
                'status' => 'false',
                'message' => 'error',
                'errors' => [
                    'Wrong credentials.'
                ],
            ],422);
        }

        return response()->json([
            'status' => 'true',
            'message'=>'Logged in.',
            'data' => fractal()
            ->item($request->user())
            ->addMeta(['token' => $token])
            ->transformWith(new ClientTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray(),
        ],200);
    }

    public function socialRegister(UserSocialRegisteration $request)
    {
        $input = $request->all();
        $input['confirmed'] = 1;
        $user = User::create($input);

        $token = JWTAuth::fromUser($user,[
            'exp' => Carbon::now()->addMonth()->timestamp,
        ]);

        return response()->json([
            'status' => 'true',
            'message'=>'Thanks for signing up.',
            'data'=>fractal()
            ->item($user)
            ->addMeta(['token' => $token])
            ->transformWith(new UserTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray(),
        ],200);
    }

    public function socialLogin(UserSocialAuthentication $request)
    {
        $input = $request->all();
        $user = User::where('social_id',$input['social_id'])->where('social_type',$input['social_type'])->first();
        if(!$user){
            return response()->json([
                'status' => 'false',
                'message' => 'error',
                'errors' => [
                    'Wrong credentials.'
                ],
            ],422);
        }
        $token = JWTAuth::fromUser($user,[
            'exp' => Carbon::now()->addweek()->timestamp,
        ]);

        return response()->json([
            'status' => 'true',
            'message'=>'Logged in.',
            'data' => fractal()
            ->item($user)
            ->addMeta(['token' => $token])
            ->transformWith(new UserTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray(),
        ],200);
    }

    public function forgetPassword(Request $request)
    {
        $email = $request->get('email');
        if (!$email) {
            return response()->json([
                'status' => 'false',
                'message' => 'error',
                'errors' => [
                    'Email required.'
                ],
            ],422);
        }
        $user = User::where('email',$email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'false',
                'message' => 'error',
                'errors' => [
                    'Not found.'
                ],
            ],404);
        }
        $new_password = str_random(10);
        $user->password = bcrypt($new_password);
        $user->save();
        try {
            Mail::to($email)->send(new ForgetPasswordMail($user,$new_password));
        } catch (\Exception $e) {
        }
        return response()->json([
            'status' => 'true',
            'message' => 'Please check your email.',
        ],200);
    }

    public function confirm(Request $request)
    {
        $verification_code = $request->get('verification_code');
        if (!$verification_code) {
            return response()->json([
                'status' => 'false',
                'message' => 'error',
                'errors' => [
                    'Verification code required.'
                ],
            ],422);
        }
        $user = User::where('verification_code',$verification_code)->first();
        if (!$user) {
            return response()->json([
                'status' => 'false',
                'message' => 'error',
                'errors' => [
                    'Not found.'
                ],
            ],404);
        }
        $user->confirmed = 1;
        $user->save();
        return response()->json([
            'status' => 'true',
            'message'=>'User confirmed.',
            'data' => fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray(),
        ],200);
    }

    public function resendCode(Request $request)
    {
        $user = $request->user();

        $user->verification_code = str_random(5);
        $user->save();

        $email = $user->email;

        try {
            Mail::to($email)->send(new UserVerificationCodeMail($user));
        } catch (\Exception $e) {
        }

        return response()->json([
            'status' => 'true',
            'message'=>'Check your email.'
        ],200);
    }

    public function deviceToken(Request $request)
    {
        if(!$request->input('device_token')){
            return response()->json([
                'error' => 'Please provide the device token.',
            ],422);
        }

        $updateToken = User::where('id',$request->user()->id)->update([
            'device_token'=>$request->input('device_token'),
        ]);

        return response()->json([
                'message' => 'token updated.',
            ],200);
    }
}
