@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Tasks</h1>
        <div>
            <a href="{{ route('tasks.export') }}" class="btn btn-success me-2">Export Excel</a>
            <a href="{{ route('tasks.export.csv') }}" class="btn btn-secondary me-2">Export CSV (Queue)</a>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('tasks.index') }}" method="GET" class="row g-3" id="filterForm">
                <div class="col-md-3">
                    <select name="project_id" class="form-select">
                        <option value="">All Projects</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="assigned_to" class="form-select">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('assigned_to') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    @if($exports->count() > 0)
    <div class="card mb-3">
        <div class="card-header">Recent Background Exports</div>
        <div class="card-body p-0" style="max-height: 250px; overflow-y: auto;">
            <ul class="list-group list-group-flush">
                @foreach($exports as $export)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        Export #{{ $export->id }} - {{ $export->created_at->diffForHumans() }}
                        <span class="badge bg-{{ $export->status == 'completed' ? 'success' : ($export->status == 'failed' ? 'danger' : 'warning') }}">
                            {{ ucfirst($export->status) }}
                        </span>
                    </span>
                    @if($export->status == 'completed')
                        <a href="{{ route('tasks.export.download', $export) }}" class="btn btn-sm btn-outline-primary">Download</a>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="card position-relative">
        <div id="loader" class="position-absolute top-50 start-50 translate-middle" style="display: none; z-index: 10;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="card-body" id="tasks-table-container">
            @include('tasks.partials.table')
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        function fetchTasks(page = 1) {
            var project_id = $('select[name="project_id"]').val();
            var status = $('select[name="status"]').val();
            var assigned_to = $('select[name="assigned_to"]').val();

            $('#loader').show();
            $('#tasks-table-container').css('opacity', '0.5');

            $.ajax({
                url: "{{ route('tasks.index') }}?page=" + page,
                data: {
                    project_id: project_id,
                    status: status,
                    assigned_to: assigned_to
                },
                success: function(data) {
                    $('#tasks-table-container').html(data);
                    $('#tasks-table-container').css('opacity', '1');
                    $('#loader').hide();
                }
            });
        }

        // Filter Change Event
        $('select[name="project_id"], select[name="status"], select[name="assigned_to"]').on('change', function() {
            fetchTasks();
        });

        // Pagination Click Event
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetchTasks(page);
        });
        
        // Prevent default form submit for filters
        $('#filterForm').on('submit', function(e) {
            e.preventDefault();
            fetchTasks();
        });
    });
</script>
@endpush
