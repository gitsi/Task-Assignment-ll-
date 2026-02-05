<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Resources\ProjectResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $projects = Project::select(['id', 'name', 'description', 'start_date', 'end_date'])
            ->withCount('tasks')
            ->get();
        return $this->successResponse(ProjectResource::collection($projects));
    }
}
