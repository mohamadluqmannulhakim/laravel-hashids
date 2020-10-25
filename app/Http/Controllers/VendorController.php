<?php

namespace App\Http\Controllers;

use App\Http\Traits\HashidsTrait;
use App\Vendor;
use Illuminate\Http\Request;
use Validator;

class VendorController extends Controller
{
    use HashidsTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hashedIdAttrArr    = array('users_id_1', 'users_id_2');
        $request            = ($request->users_id_1 || $request->users_id_2) ? $this->getDecode($request, $hashedIdAttrArr) : null;
        $vendors            = Vendor::when($request->users_id_1, function($query) use($request){
                                $query->where('users_id', $request->users_id_1);
                            })
                            ->orderBy('name')
                            ->paginate(10);
        return response()->json($vendors, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => ['required', 'string'],
            'email'     => ['required', 'string'],
            'users_id'  => ['required', 'exists_hashed:users,id'],
        ]);
        
        if($validator->fails()){
            return response()->json($validator->messages(), 200);
        }

        $vendor = new \App\Vendor ([
            'name'      => $request->name,
            'email'     => $request->email,
            'users_id'  => $request->users_id
        ]);

        $saveVendor = $vendor->save();
        if ($saveVendor) {
            return response()->json(['message' => 'Successfully created vendor information!'], 200);
        }
        else {
            return response()->json(['message' => 'Failed to save!'], 202);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id         = $id ? $this->getDecode($id) : null;
        $vendors    = Vendor::findOrFail($id);
        return response()->json($vendors, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
