<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'job_type' => $this->job_type,
            'salary_range_from' => $this->salary_range_from,
            'salary_range_to' => $this->salary_range_to,
            'city' => $this->city,
            'country' => $this->country,
            'created_at' => $this->created_at->diffForHumans(),
            'user' => new UserResource($this->user)
        ];
    }
}
