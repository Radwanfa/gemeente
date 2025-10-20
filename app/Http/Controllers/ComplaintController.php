<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Reporter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->post('name')) {
            if (!$request->post('email')) {
                return response()->json(['error' => 'Email is required'], Response::HTTP_BAD_REQUEST);
            } else if (!$request->post('description')) {
                return response()->json(['error' => 'Description is required'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['error' => 'Name is required'], Response::HTTP_BAD_REQUEST);
        }


        $complaint = new Complaint();
        $RController = new ReporterController();
        if  (!$RController->index("name", $request->post("name"))) {
            $Rid = $RController->store($request->post('name'), $request->post('email'));
        } else {
            $Rid = $RController->index("name", $request->post("name"))["id"];
        }

        $complaint->description = $request->post('description');
        $complaint->status = $request->post('priority');
        $complaint->latitude = $request->post('latitude');
        $complaint->longitude = $request->post('longitude');
        $complaint->reporter_id = $Rid;
        $complaint->save();

        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $PController = new PhotoController();
            $id = $PController->store($complaint->id, $image);
        }
        return response()->json(['status', 'success'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
