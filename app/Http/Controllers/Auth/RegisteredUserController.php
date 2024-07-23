<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $roles = Role::where('status','Active')->pluck("name","id");
        $users = User::all();
        return view('auth.userregister',["roles"=>$roles,"users"=>$users]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // RedirectResponse
    public function store(Request $request)
    {
        try {
            // Validate the request data
            
            if ($request->mode == "add") {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                $superadminexists = User::where('role_id',1)->first();
                if($superadminexists){
                    if($request->role == 1){
                        return response()->json(["status"=>false,"message"=>"Sorry Superadmin Already exists"]);
                    }else{
                        // Create the user
                        $user = User::create([
                            'name' => $request->name,
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                            'role_id' => $request->role,
                            'status' => $request->status,
                            'narration' => $request->narration
                        ]);
    
                        // Trigger the Registered event
                        event(new Registered($user));
    
                        // Log in the user
                        // Auth::login($user);
    
                        if($user){
                            return response()->json(["status"=>true,"message"=>"User registered successfully"]);
                        }else{
                            return response()->json(["status"=>false,"message"=>"User could not be registered"]);
                        }
                        // Redirect to home
                        //return redirect(RouteServiceProvider::HOME);
                    }
                }else{
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'role_id' => $request->role,
                        'status' => $request->status,
                        'narration' => $request->narration
                    ]);

                    // Trigger the Registered event
                    event(new Registered($user));

                    // Log in the user
                    // Auth::login($user);

                    if($user){
                        return response()->json(["status"=>true,"message"=>"User registered successfully"]);
                    }else{
                        return response()->json(["status"=>false,"message"=>"User could not be registered"]);
                    }
                    // Redirect to home
                    //return redirect(RouteServiceProvider::HOME);
                }
                    
            }
            if($request->mode == "edit"){

                $usertypeexists = User::where('status', '!=', 'Deleted')
                ->where('email', $request->email)
                ->get();

                if ($usertypeexists) {
                    foreach ($usertypeexists as $ex) {
                        if ($request->recordid != $ex->id) {
                            return response()->json(['status' => false, 'message' => "Error!! Sorry user already exists"], 400);
                        }else{
                            $superadminexists = User::where('role_id',1)->first();
                            if($superadminexists){
                                if($request->role == 1){
                                    return response()->json(["status"=>false,"message"=>"Sorry Superadmin Already exists"]);
                                }else{
                                    $user = User::where('id',$request->recordid)->update([
                                        'role_id' => $request->role,
                                        'status' => $request->status,
                                        'narration' => $request->narration
                                    ]);
                                    if($user){
                                        return response()->json(["status"=>true,"message"=>"User updated successfully"]);
                                    }else{
                                        return response()->json(["status"=>false,"message"=>"User could not be updated"]);
                                    }
                                }
                            }else{
                                $user = User::where('id',$request->recordid)->update([
                                    'role_id' => $request->role,
                                    'status' => $request->status,
                                    'narration' => $request->narration
                                ]);
                                if($user){
                                    return response()->json(["status"=>true,"message"=>"User updated successfully"]);
                                }else{
                                    return response()->json(["status"=>false,"message"=>"User could not be updated"]);
                                }
                            }
                        }
                    }
                }

                
            }

            // Handle other modes if necessary

        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500); // Added error message for better debugging
        }
    }

    public function getData(string $id)
    {   
        // Ensure the 'count' column is the correct one for fetching the floor data.
        $user = User::where('id', $id)->first();
    
        // Check if the floor data was found
        if ($user) {
            return response()->json(['user' => $user]);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function deleteData(string $id)
    {
        
            $user = User::find($id);

            // Check if the floor record exists
            if (!$user ) {
                return response()->json(['message' => 'User not found'], 404);
            }

            // Attempt to delete the floor record
            if ($user -> delete()) {
                return response()->json([
                    'status' => true,
                    'message' => 'User Deleted',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'User could not be deleted.',
                ]);
            }

        
    }
    // public function store(Request $request): RedirectResponse
    // {
    //     //dd($request);
    //     try{
    //         $request->validate([
    //             'name' => ['required', 'string', 'max:255'],
    //             'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //             'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //         ]);

    //         if($request->mode == "add"){

    //         }
    
    //         $user = User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //             'role_id' => $request->role,
    //             'status' => $request->status,
    //             'narration' => $request->narration
    //         ]);
    
    //         event(new Registered($user));
    
    //         Auth::login($user);
    
    //         return redirect(RouteServiceProvider::HOME);

    //     }catch (ValidationException $e) {
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $e->errors()
    //         ], 422);
    //     }
    // }
}
