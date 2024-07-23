<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\IdProof;


class IDproofController extends Controller
{
    public function index(){
        $iddatas = IdProof::all();
        return view("backend.Masters.IDproof.idproofMaster",['iddatas'=>$iddatas]);
    }


    public function saveIDproof(Request $request){
        //dd($request);
        try {
            $request->validate([
                'idname' => 'required',
                'idcode' => 'required|max:5',
                'vallength' => 'required|numeric',
                'status' => 'required',
            ]);
    
            if ($request->mode == "add") {
                $idproofexist = IdProof::where('id_name', $request->idname)
                    ->orWhere('id_code', $request->idcode)
                    ->first();
                //dd($idproofexist);
                if ($idproofexist) {
                    return response()->json(["message" => "Error!! Sorry Id-proof already exists"]);
                }
    
                $saveIdproof = IdProof::create([
                    "id_name" => ucwords($request->idname),
                    "id_code" => strtoupper($request->idcode),
                    "id_val_length" => $request->vallength,
                    "status" => $request->status,
                    "narration" => $request->narration,
                    "created_by" => 1,
                    "updated_by" => 1
                ]);
    
                if ($saveIdproof) {
                    return response()->json(["status" => true, "message" => "Id-proof saved successfully"]);
                } else {
                    return response()->json(["status" => false, "message" => "Id-proof cannot be saved"]);
                }
            }
    
            if ($request->mode == "edit") {
                $idproofexists = IdProof::where(function ($query) use ($request) {
                    $query->where('id_name', $request->idname)
                        ->orWhere('id_code', $request->idcode);
                })->get();
    
                if ($idproofexists) {
                    foreach ($idproofexists as $ex) {
                        if ($request->recordid != $ex->id) {
                            return response()->json(['status' => false, 'message' => "Error!! Sorry Id-proof already exists"]);
                        }
                    }
                }
    
                $updateidproof = IdProof::where('id', $request->recordid)->update([
                    "id_name" => ucwords($request->idname),
                    "id_code" => strtoupper($request->idcode),
                    "id_val_length" => $request->vallength,
                    "status" => $request->status,
                    "narration" => $request->narration,
                    "updated_by" => 1,
                    "updated_at" => now()
                ]);
    
                if ($updateidproof) {
                    return response()->json(["status" => true, "message" => "Id-proof updated successfully"]);
                } else {
                    return response()->json(["status" => false, "message" => "Id-proof cannot be updated"]);
                }
            }
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }
    

    public function getIdproof($id){
        //dd($id);
        $iddata = IdProof::where('id',$id)->first();
        if($iddata){
            return response()->json(["iddata"=>$iddata]);
        }else{
            return response()->json(["message"=>"Something went wrong!!"]);
        }
    }

    public function deleteData(string $id)
    {
        
        if($id){
            $idproof = IdProof::find($id);

            // Check if the floor record exists
            if (!$idproof) {
                return response()->json(['message' => 'Id-proof not found'], 404);
            }

            // Attempt to delete the floor record
            if ($idproof->delete()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Id-proof Deleted',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Id-proof could not be deleted.',
                ]);
            }

        }else {
            // Associated records found, cannot delete floor
            return response()->json([
                'status' => false,
                'message' => 'Cannot delete block. Associated records exist in cabin, ward, or icu.',
            ]);
        } 
    }

}
