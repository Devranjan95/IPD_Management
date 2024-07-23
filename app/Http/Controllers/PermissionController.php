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
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('backend.Masters.RolePermission.permission',["permissions"=>$permissions]);
    }

    // public function savePermission(Request $request){
    //     //dd($request);
    //     try{
    //         $request->validate([
    //             'permissionname' => 'required',
    //         ]);
    //         if($request->mode == "add"){
    //             // $permissionexist = Permission::where('name',$request->permissionname)->first();
    //             // if($permissionexist){
    //             //     return request()->json(["status"=>false,"message"=>"Sorry permission already exists"]);
    //             // }
    //            $savepermission =  Permission::create([
    //                 "name"=>$request->permissionname
    //             ]);
    //             if($savepermission){
    //                 return request()->json(["status"=>true,"message"=>"Permission saved successfully"]);
    //             }
    //         }
    //     } catch (ValidationException $e){

    //     }
    // }
    public function savePermission(Request $request){
        try {
            $request->validate([
                'permissionname' => 'required',
            ]);
    
            if ($request->mode == "add") {
                $permissionExist = Permission::where('name', $request->permissionname)->first();
                if ($permissionExist) {
                    return response()->json(["status" => false, "message" => "Sorry, Screen already exists"]);
                }
    
                $savePermission = Permission::create([
                    "name" => $request->permissionname
                ]);
    
                if ($savePermission) {
                    return response()->json(["status" => true, "message" => "Screen saved successfully"]);
                } else {
                    return response()->json(["status" => false, "message" => "Failed to save permission"]);
                }
            }
            if($request->mode == "edit"){
                //dd($request);
                $permissionExists = Permission::where('name', $request->permissionname)
                                  ->where('id', '!=', $request->recordid)
                                  ->exists();
                if ($permissionExists) {
                    return response()->json(['status' => false, 'message' => "Error!! Screen already exists"]);
                }
                $updatepermission = Permission::where('id',$request->recordid)->update([
                    "name"=>$request->permissionname
                ]);
                if($updatepermission){
                    return response()->json(["status"=>true,"message"=>"Screen updated successfully"]);
                }else{
                    return response()->json(["status"=>false,"message"=>"Screen cannot be updated"]);
                }
            }
        } catch (ValidationException $e) {
            return response()->json(["status" => false, "message" => $e->errors()]);
        } catch (\Exception $e) {
            return response()->json(["status" => false,"message" => $e->errors()]);
        }
    }

    public function getData(string $id)
    {   
        // Ensure the 'count' column is the correct one for fetching the floor data.
        $permission = Permission::where('id', $id)->first();
    
        // Check if the floor data was found
        if ($permission) {
            return response()->json(['permission' => $permission]);
        } else {
            return response()->json(['message' => 'Permission not found'], 404);
        }
    }
    
    public function deleteData(string $id)
    {
        
            $permission = Permission::find($id);

            // Check if the floor record exists
            if (!$permission ) {
                return response()->json(['message' => 'Screen not found'], 404);
            }

            // Attempt to delete the floor record
            if ($permission ->delete()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Screen Deleted',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Screen could not be deleted.',
                ]);
            }

        
    }
}
