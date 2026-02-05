@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Projects</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">Create New Project</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($projects as $project)
        <div class="col">
            <div class="card h-100 shadow-sm border border-secondary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title mb-0">
                            <a href="{{ route('tasks.index', ['project_id' => $project->id]) }}" class="text-decoration-none text-primary fw-bold">
                                {{ $project->name }}
                            </a>
                        </h5>
                        <span class="badge bg-info rounded-pill">{{ $project->tasks_count }} Tasks</span>
                    </div>
                    
                    <p class="card-text text-muted small mb-3">
                        {{ Str::limit($project->description, 100) }}
                    </p>

                    <div class="mb-3 small">
                        <div class="text-secondary">
                            <i class="bi bi-calendar-event"></i> <strong>Start:</strong> {{ $project->start_date }}
                        </div>
                        @if($project->end_date)
                        <div class="text-secondary">
                            <i class="bi bi-calendar-check"></i> <strong>End:</strong> {{ $project->end_date }}
                        </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-auto">
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-outline-warning">
                            Edit
                        </a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">No projects found.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $projects->links() }}
    </div>
</div>
@endsection
