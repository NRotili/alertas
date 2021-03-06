<?php

namespace App\Http\Controllers\API\Monitoreo;

use App\Http\Controllers\Controller;
use App\Models\Camera;
use App\Models\Flaw;
use App\Models\Intervention;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
        if ($status != null) {
            $cameras = Camera::where('status', $status)
                            ->where(function ($q) {
                                $q->where('type', '0')
                                    ->orWhere('type', '1');
                            })
                            ->orderBy('lat')
                            ->orderBy('lng')
                            ->get();
        } else {
            $cameras = Camera::where('published', 1)
                            ->where(function ($q) {
                                $q->where('type', '0')
                                    ->orWhere('type', '1');
                            })
                            ->get();
        }
        return $cameras;
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
        //
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
