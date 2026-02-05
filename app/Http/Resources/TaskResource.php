<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'project_id' => $this->project_id,
            'project_name' => $this->project ? $this->project->name : null,
            'assigned_to' => $this->assignee ? $this->assignee->name : null,
            'status' => $this->status,
            'due_date' => $this->due_date,
        ];
    }
}
