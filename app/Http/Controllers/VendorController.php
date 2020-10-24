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
        $request->users_id = $this->getDecode('User', $request->users_id);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendors  = Vendor::findOrFail($id);
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
