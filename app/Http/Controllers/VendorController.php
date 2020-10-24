<?php

namespace App\Http\Controllers;

use App\Http\Traits\HashidsTrait;
use App\Vendor;
use Hashids\Hashids;
use Illuminate\Http\Request;

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
        $request->users_id = $request->users_id ? $this->getDecode('User', $request->users_id) : null;
        $vendors  = Vendor::when($request->users_id, function($query) use($request){
                                $query->where('users_id', $request->users_id);
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
        $id         = $id ? $this->getDecode('Vendor', $id) : null;
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
