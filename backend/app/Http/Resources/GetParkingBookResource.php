<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetParkingBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $checkin = Carbon::parse($this->checkin_at);
        $checkout = '-';
        $duration = '';
        if($this->checkout_at) {
            $checkout = Carbon::parse($this->checkout_at);
            $duration = formatDuration($checkin->diffInSeconds($checkout));
        } else {
            $duration = formatDuration($checkin->diffInSeconds(Carbon::now())) . ' (ongoing)';
        }
        return [
            'id' => $this->id,
            'parking_lot_name' => $this->parkingSpot->parkingLot->name,
            'spot_code' => $this->parkingSpot->spot_number,
            'date' => $checkin->toDateString(),
            'start_time' => $checkin->format("H:i:s"),
            'exit_time' => $checkout === '-' ? $checkout : $checkout->format("H:i:s"),
            'duration' => $duration,
            'status' => $this->status
        ];
    }

    
}
