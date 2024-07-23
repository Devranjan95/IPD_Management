<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Cabin;
use App\Models\Ward;
use App\Models\Icu;
use App\Models\Action;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // public function index(){
    //     $permissions = Permission::all();
    //     $actions = Action::all();
    //     $roles = Role::all();
    //     $pernames = [];
    //     $actionnames = [];
    //     foreach($roles as $role){
    //         $permissions = $role->permission;
    //         $actions = $role->action;
    //         $permissions = explode(",",$permissions);
    //         $actions = explode(",",$actions);
    //         //dd( $permissions );
    //         foreach($permissions as $key=>$value){
    //             $pername = Permission::where('id',$value)->value('name');
    //             $pernames[] = $pername;
    //         }
    //         foreach($actions as $key=>$value){
    //             $actionname = Action::where('id',$value)->value('action_name');
    //             $actionnames [] = $actionname;
    //         }
    //     }
    //     //dd($pernames);
    //     //dd($actionnames);
    //     return view('backend.Masters.RolePermission.role',['permissions'=> $permissions,"actions"=>$actions,
    //                                                         "roles"=>$roles,"pernames"=>$pernames,"actionnames"=>$actionnames]);
    // }
    public function index() {
        $permissions = Permission::all();
        $actions = Action::all();
        $roles = Role::all();
    
        $roleData = [];
    
        foreach ($roles as $role) {
            $rolePermissions = explode(",", $role->permission);
            $roleActions = explode(",", $role->action);
    
            $pernames = [];
            $actionnames = [];
    
            foreach ($rolePermissions as $value) {
                $pername = Permission::where('id', $value)->value('name');
                $pernames[] = $pername;
            }
    
            foreach ($roleActions as $value) {
                $actionname = Action::where('id', $value)->value('action_name');
                $actionnames[] = $actionname;
            }
    
            $roleData[] = [
                'role' => $role,
                'pernames' => $pernames,
                'actionnames' => $actionnames
            ];
        }
    
        return view('backend.Masters.RolePermission.role', [
            'permissions' => $permissions,
            'actions' => $actions,
            'roles' => $roles,
            'roleData' => $roleData
        ]);
    }
    
    

    public function saveRole(Request $request){
       //dd($request);
       try{
            $request->validate([
                'rolename' => 'required',
            ]);

            if($request->mode == "add"){
                $permissions = $request->permissions;
                $actions = $request->actions;
                $permissionsString = implode(",", $permissions);
                $actionString = implode(",", $actions);
    
                $roleexist = Role::where('name',$request->rolename)->first();
    
                if($roleexist){
                    return response()->json(["status"=>false,"message"=>"Error!! Sorry Role already exists"]);
                }
    
                $saverole = Role::create(["name"=>$request->rolename,"action"=>$actionString,
                                            "permission"=>$permissionsString,
                                            "status"=>$request->status,
                                            "narration"=>$request->narration]);
                if($saverole){
                    return response()->json(["status"=>true,"message"=>"Role saved successfully"]);
                }else{
                    return response()->json(["status"=>false,"message"=>"Error!! Role could not be saved"]);
                }
    
            }
            if($request->mode == "edit"){
                $permissions = $request->permissions;
                $actions = $request->actions;
                $permissionsString = implode(",", $permissions);
                $actionString = implode(",", $actions);

                $roleExists = Role::where('name', $request->rolename)
                ->where('id', '!=', $request->recordid)
                ->exists();
                if ($roleExists) {
                    return response()->json(['status' => false, 'message' => "Error!! Role already exists"]);
                }
                $updaterole = Role::where('id',$request->recordid)->update([
                    "name"=>$request->rolename,"action"=>$actionString,"permission"=>$permissionsString,
                    "status"=>$request->status, "narration"=>$request->narration
                ]);
                if($updaterole){
                    return response()->json(["status"=>true,"message"=>"Role updated successfully"]);
                }else{
                    return response()->json(["status"=>false,"message"=>"Role cannot be updated"]);
                }
            }
            
        }catch (ValidationException $e) {
            return response()->json(["status" => false, "message" => $e->errors()]);
        }catch (\Exception $e) {
            return response()->json(["status" => false,"message" => $e->errors()]);
        }
    }

    public function getData(string $id)
    {   
        // Ensure the 'count' column is the correct one for fetching the floor data.
        $role = Role::where('id', $id)->first();
    
        // Check if the floor data was found
        if ($role) {
            return response()->json(['role' => $role]);
        } else {
            return response()->json(['message' => 'Role not found'], 404);
        }
    }

    public function deleteData(string $id)
    {
        
            $role = Role::find($id);

            // Check if the floor record exists
            if (!$role ) {
                return response()->json(['message' => 'Role not found'], 404);
            }

            // Attempt to delete the floor record
            if ($role -> delete()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Role Deleted',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Role could not be deleted.',
                ]);
            }

        
    }
}
