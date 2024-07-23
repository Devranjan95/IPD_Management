<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Action;

class ActionController extends Controller
{
    //
    public function index(){
        $actions = Action::all();
        return view("backend.Masters.RolePermission.action",["actions"=>$actions]);
    }

    public function saveAction(Request $request){
        //dd($request);
        try {
            $request->validate([
                'actionname' => 'required',
            ]);
    
            if ($request->mode == "add") {
                $actionExist = Action::where('action_name', $request->actionname)->first();
                if ($actionExist) {
                    return response()->json(["status" => false, "message" => "Sorry, action already exists"]);
                }
    
                $saveaction = Action::create([
                    "action_name" => $request->actionname
                ]);
    
                if ($saveaction) {
                    return response()->json(["status" => true, "message" => "Action saved successfully"]);
                } else {
                    return response()->json(["status" => false, "message" => "Failed to save action"]);
                }
            }
            if($request->mode == "edit"){
                //dd($request);
                $actionExists = Action::where('action_name', $request->actionname)
                                  ->where('id', '!=', $request->recordid)
                                  ->exists();
                if ($actionExists) {
                    return response()->json(['status' => false, 'message' => "Error!! action already exists"]);
                }
                $updateaction = Action::where('id',$request->recordid)->update([
                    "action_name"=>$request->actionname
                ]);
                if($updateaction){
                    return response()->json(["status"=>true,"message"=>"Action updated successfully"]);
                }else{
                    return response()->json(["status"=>false,"message"=>"action cannot be updated"]);
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
        $action = Action::where('id', $id)->first();
    
        // Check if the floor data was found
        if ($action) {
            return response()->json(['action' => $action]);
        } else {
            return response()->json(['message' => 'action not found'], 404);
        }
    }
    
    public function deleteData(string $id)
    {
        
            $action = Action::find($id);

            // Check if the floor record exists
            if (!$action ) {
                return response()->json(['message' => 'action not found'], 404);
            }

            // Attempt to delete the floor record
            if ($action ->delete()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Action Deleted',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'action could not be deleted.',
                ]);
            }

        
    }
}
