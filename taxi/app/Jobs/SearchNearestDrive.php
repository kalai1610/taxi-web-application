<?php

namespace App\Jobs;

use App\Models\Driver;
use App\Models\Ride;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SearchNearestDrive implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Ride $ride;

    public function __construct(Ride $ride)
    {
        $this->ride = $ride;
    }

    public function handle(): void
    {
        try {
            Log::channel('customlog')->info("Searching for nearest driver for ride {$this->ride->id}");

            $pickup_lat = $this->ride->pickup_latitude;
            $pickup_long = $this->ride->pickup_longitude;
            $drivers = Driver::with('rides')->whereNotIn('id', function ($query) {
                $query->select('driver_id')
                    ->from('rides')
                    ->where('status', 'In Ride');
            })->get();
            $min_distance = 9999999;
            $driver_id = 0;
            foreach ($drivers as $driver) {
                $distance = distance($pickup_lat, $pickup_long, $driver->drivers_latitude, $driver->drivers_longitude);
                if ($distance <= $min_distance) {
                    $driver_id = $driver->id;
                    $min_distance = $distance;
                }
            }
            if ($driver_id != 0) {
                $this->ride->driver_id = $driver_id;
                $this->ride->save();
                Log::channel('customlog')->info("Assigned driver with ID {$driver_id} to ride ID {$this->ride->id}.");
            } else {
                $this->ride->status = 'no cab available - change pickup location';
                $this->ride->save();
                Log::channel('customlog')->warning("No cab available for ride ID {$this->ride->id}.");
            }
        } catch (\Exception $e) {
            Log::channel('customlog')->error("An error occurred while searching for a driver: {$e->getMessage()}");
        }

    }
}
