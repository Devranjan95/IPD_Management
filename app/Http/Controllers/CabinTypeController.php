<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\CabinType;

class CabinTypeController extends Controller
{
    //
    public function index(){
        $cabintypes = CabinType::where('status','!=','Deleted')->get();
        return view("backend.cabintypeMaster",['cabintypes'=>$cabintypes]);
    }
    public function saveCabinType(Request $request)
    {
        try {
            $request->validate([
                'cabintype' => 'required|string|max:50',
                'status' => 'required',
            ]);

            if ($request->mode == "add") {
                $cabintypeexist = CabinType::where('cabin_type', $request->cabintype)->first();
                if ($cabintypeexist) {
                    if ($cabintypeexist->status == "Deleted") {
                        $updatecabintype = CabinType::where('id', $cabintypeexist->id)
                            ->update([
                                "updated_by" => 1,
                                "updated_at" => now(),
                                "status" => $request->status
                            ]);
                        if ($updatecabintype) {
                            return response()->json(["message" => "Error!! Sorry cabintype already exists"], 400);
                        }
                    } else {
                        return response()->json(["message" => "Error!! Sorry cabintype already exists"], 400);
                    }
                }

                $saveCabinType = CabinType::create([
                    "cabin_type" => $request->cabintype,
                    "status" => $request->status,
                    "narration" => $request->narration,
                    "created_by" => 1,
                    "updated_by" => 1
                ]);

                if ($saveCabinType) {
                    return response()->json(['status' => true, 'message' => 'Cabintype saved successfully']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Cabintype could not be saved'], 500);
                }
            }

            if ($request->mode == "edit") {
                $cabintypeexists = CabinType::where('status', '!=', 'Deleted')
                    ->where('cabin_type', $request->cabintype)
                    ->get();

                if ($cabintypeexists) {
                    foreach ($cabintypeexists as $ex) {
                        if ($request->recordid != $ex->id) {
                            return response()->json(['status' => false, 'message' => "Error!! Sorry cabintype already exists"], 400);
                        }
                    }
                }

                $updatecabintype = CabinType::where('id', $request->recordid)
                    ->update([
                        "cabin_type" => $request->cabintype,
                        "status" => $request->status,
                        "narration" => $request->narration,
                        "updated_by" => 1,
                        "updated_at" => now()
                    ]);

                if ($updatecabintype) {
                    return response()->json(['status' => true, 'message' => 'Cabintype updated successfully']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Cabintype could not be updated'], 500);
                }
            }
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function getData(string $id)
    {   
        //dd($id);
        $cabintype = CabinType::where('id', $id)->first();
        return response()->json(['cabintype'=>$cabintype]);
    }
    public function deleteData(string $id)
    {
        $cabintype = CabinType::find($id);

        // Check if the floor record exists
        if (!$cabintype) {
            return response()->json(['message' => 'Cabintype not found'], 404);
        }

        // Attempt to delete the floor record
        if ($cabintype->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Cabintype Deleted',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Cabintype could not be deleted.',
            ]);
        }
        //dd($id);
        // $floor = CabinType::find($id);
        // if(!$floor){
        //     return response()->json(['message'=>'Cabintype Not Found']);
        // }

        // $update = CabinType::where('id',$id)
        //     ->update([
        //         'updated_at'  => date('Y-m-d H:i:s'),
        //         'updated_by'  => "1",
        //         'status'      => 'Deleted'
        //     ]);

        //     if($update){
        //         return response()->json([
        //             'status' => true,
        //             'message' => 'Cabintype deleted',
        //         ]);
        //     }else{
        //         return response()->json([
        //             'status' => false,
        //             'message' => "CabinType could not be deleted.",
        //         ]);
        // }
    }
}
