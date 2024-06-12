<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Models\Floor;
use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    //
    public function index(){
        $floors = Floor::where('status','=','Active')->pluck('floor_no','count');
        $blocks = Block::where('status','!=','Deleted')->get();
        $floorno = [];
        foreach($blocks as $block){
            $floor = Floor::where('count',$block->floor_count)->value('floor_no');
            //dd($floor);
            $floorno[]=$floor;
        }
        //dd($floorno);
        return view("backend.blockMaster",['floors'=>$floors,'blocks'=>$blocks,'floorno'=>$floorno]);
    }
    public function saveBlock(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                'blockname'=> 'required|string|max:60',
                'floorNo' => 'required|integer',
                'status' => 'required',
            ]);
            //dd(1);
            $blockcode = ucwords($request->blockname)."-".$request->floorNo;
            if($request->mode == "add"){
                $blockexist = Block::where('block_code',$blockcode)->first();
                if($blockexist){
                    //dd(1);
                    return response()->json(["message"=>"Error!! Sorry block already exists"]);
                    
                }
                //dd($request->floorNo);
                $saveBlock = Block::create([
                    "block_name"=>ucwords($request->blockname),
                    "block_code"=>$blockcode,
                    "floor_count"=>$request->floorNo,
                    "status"=>$request->status,
                    "narration"=>$request->narration,
                    "created_by"=>1,
                    "updated_by"=>1
                ]);
                if($saveBlock){
                    //dd(1);
                    return response()->json(['status'=>true,'message'=>'Block saved successfully']);
                }else{
                    return response()->json(['status'=>true,'message'=>'Block could not be saved']);
                }
            }
            if($request->mode == "edit"){
                //dd($request->recordid);
                $blockexists = Block::where('block_code', $blockcode)->where('id', '!=', $request->recordid)->first();
            if ($blockexists) {
                return response()->json(['status' => false, 'message' => "Error!! Sorry block already exists"]);
            }
                // $blockexists = Block::where('block_code',$request->blockcode)->get();
                // if($blockexists){
                //     foreach($blockexists as $ex){
                //         if($request->recordid != $ex->id){
                //             return response()->json(['status' => false, 'message' => "Error!! Sorry block already exists"]);
                //         }
    
                //     }
                // }
                $updateblock = Block::where('id',$request->recordid)
                                    ->update(["block_name"=>ucwords($request->blockname),
                                              "block_code"=>$blockcode,
                                              "floor_count"=>$request->floorNo,
                                              "status"=>$request->status,
                                              "narration"=>$request->narration,
                                              "updated_by"=>1,
                                              "updated_at"=>date('Y-m-d H:i:s')]);
                if($updateblock){
                    return response()->json(['status'=>true,'message'=>'Block updated successfully']);
                }else{
                    return response()->json(['status'=>false,'message'=>'Block could not be updated']);
                }
                
            }
        }catch (ValidationException $e){
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        }
     
    }
    public function getData(string $id)
    {   
        //dd($id);
        $block = Block::where('id', $id)->first();
        return response()->json(['block'=>$block]);
    }
    public function deleteData(string $id)
    {
        $block = Block::find($id);

        // Check if the floor record exists
        if (!$block) {
            return response()->json(['message' => 'Block not found'], 404);
        }

        // Attempt to delete the floor record
        if ($block->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Block Deleted',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Block could not be deleted.',
            ]);
        }
        // //dd($id);
        // $floor = Block::find($id);
        // if(!$floor){
        //     return response()->json(['message'=>'Floor Not Found']);
        // }

        // $update = Block::where('id',$id)
        //     ->update([
        //         'updated_at'  => date('Y-m-d H:i:s'),
        //         'updated_by'  => "1",
        //         'status'      => 'Deleted'
        //     ]);

        //     if($update){
        //         return response()->json([
        //             'status' => true,
        //             'message' => 'Block deleted',
        //         ]);
        //     }else{
        //         return response()->json([
        //             'status' => false,
        //             'message' => "Block could not be deleted.",
        //         ]);
        // }
    }
}
