<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DriverLocation extends Controller
{
    public function setLocation(string $id, Request $request)
    {
        $driver = Driver::findOrFail($id);
        $driver->drivers_longitude = $request->longitude;
        $driver->drivers_latitude = $request->latitude;
        $driver->save();
        return response()->json(['msg' => 'updated successfully']);
    }

    public function getLocation(string $id)
    {
        try {
            $driver = Driver::findOrFail($id);
            return response()->json(['driver' => $driver]);
        } catch (\Exception $e) {
            Log::channel('customlog')->error($e);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
