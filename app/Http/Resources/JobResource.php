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
        // return parent::toArray($request);

        return [
        'id' => $this->id,
        'title' => $this->title,
        'type' => $this->type,
        'location' => $this->location,
        'description' => $this->description,
        'salary' => $this->salary,
        'company_name' => $this->company_name,
        'company_description' => $this->company_description,
        'company_email' => $this->company_email,
        'company_phone' => $this->company_phone,
    ];
    }
}
