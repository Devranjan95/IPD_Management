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
        $floors = Floor::where('status','=','Active')->select('floor_no')->get();
        $blocks = Block::where('status','!=','Deleted')->get();
        return view("backend.blockMaster",['floors'=>$floors,'blocks'=>$blocks]);
    }
    public function saveBlock(Request $request){
        //dd($request->all());
        try{
            $request->validate([
                'blockname'=> 'required|string|max:5',
                'floorNo' => 'required|integer|max:3',
                'status' => 'required',
            ]);
            if($request->mode == "add"){
                $blockcode = $request->blockname."-".$request->floorNo;
                $blockexist = Block::where('block_code',$blockcode)->where('floor_no',$request->floorNo)->first();
                //dd($blockexist);
                if($blockexist){
                    if($blockexist->status == "Deleted"){
                        $updateblock = Block::where('id',$blockexist->id)
                                            ->update([
                                                "updated_by"=>1,
                                                "updated_at"=>date("Y-m-d H:i:s"),
                                                "status"=>$request->status
                                            ]);
                        if($updateblock){
                            return response()->json(["message"=>"Block Saved Successfully"]);
                        }
                    }else{
                        return response()->json(["message"=>"Error!! Sorry Block already exists"]);
                    }
                }
                $saveBlock = Block::create([
                    "block_name"=>$request->blockname,
                    "block_code"=>$blockcode,
                    "floor_no"=>$request->floorNo,
                    "status"=>$request->status,
                    "created_by"=>1,
                    "updated_by"=>1
                ]);
                if($saveBlock){
                    return response()->json(['status'=>true,'message'=>'Block Saved Successfully']);
                }else{
                    return response()->json(['status'=>true,'message'=>'Block could not be saved']);
                }
            }
            if($request->mode == "edit"){
                //dd($request->recordid);
                $blockexists = Block::where('status','!=','Deleted')->where('block_code',$request->blockcode)->where('floor_no',$request->floorNo)->get();
                if($blockexists){
                    foreach($blockexists as $ex){
                        if($request->recordid != $ex->id){
                            return response()->json(['status' => false, 'message' => "Error!! Sorry Block already exists"]);
                        }
    
                    }
                }
                $updateblock = Block::where('id',$request->recordid)
                                    ->update(["block_name"=>$request->blockname,
                                            //   "block_code"=>$request->blockcode,
                                              "floor_no"=>$request->floorNo,
                                              "status"=>$request->status,
                                              "updated_by"=>1,
                                              "updated_at"=>date('Y-m-d H:i:s')]);
                if($updateblock){
                    return response()->json(['status'=>true,'message'=>'Block Updated Successfully']);
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
        //dd($id);
        $floor = Block::find($id);
        if(!$floor){
            return response()->json(['message'=>'Floor Not Found']);
        }

        $update = Block::where('id',$id)
            ->update([
                'updated_at'  => date('Y-m-d H:i:s'),
                'updated_by'  => "1",
                'status'      => 'Deleted'
            ]);

            if($update){
                return response()->json([
                    'status' => true,
                    'message' => 'Block deleted',
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => "Block could not be deleted.",
                ]);
            }
    }
}
