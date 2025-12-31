@extends('layouts.admin')

@section('title', 'Technical Expertise')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Technical Expertise</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSkillModal">
            <i class="fas fa-plus"></i> Add Skill
        </button>
    </div>

    <!-- Skills Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Skill Name</th>
                        <th>Category</th>
                        <th>Proficiency</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($skills ?? [] as $skill)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $skill->name }}</td>
                            <td>
                                <span class="badge bg-{{ $skill->category == 'Network' ? 'primary' : ($skill->category == 'Systems' ? 'success' : 'warning') }}">
                                    {{ $skill->category }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                        <div class="progress-bar 
                                            @if($skill->proficiency >= 80) bg-success
                                            @elseif($skill->proficiency >= 50) bg-warning
                                            @else bg-danger
                                            @endif"
                                            role="progressbar" 
                                            style="width: {{ $skill->proficiency }}%"
                                            aria-valuenow="{{ $skill->proficiency }}" 
                                            aria-valuemin="0" 
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                    <span>{{ $skill->proficiency }}%</span>
                                </div>
                            </td>
                            <td>{{ $skill->created_at->format('d M, Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editSkillModal{{ $skill->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this skill?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Skill Modal -->
                        <div class="modal fade" id="editSkillModal{{ $skill->id }}" tabindex="-1" aria-labelledby="editSkillModalLabel{{ $skill->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('skills.update', $skill->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editSkillModalLabel{{ $skill->id }}">Edit Skill</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name{{ $skill->id }}" class="form-label">Skill Name</label>
                                                <input type="text" class="form-control" id="name{{ $skill->id }}" name="name" value="{{ $skill->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="category{{ $skill->id }}" class="form-label">Category</label>
                                                <select class="form-select" id="category{{ $skill->id }}" name="category" required>
                                                    <option value="Network" {{ $skill->category == 'Network' ? 'selected' : '' }}>Network</option>
                                                    <option value="Systems" {{ $skill->category == 'Systems' ? 'selected' : '' }}>Systems</option>
                                                    <option value="Development" {{ $skill->category == 'Development' ? 'selected' : '' }}>Development</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="proficiency{{ $skill->id }}" class="form-label">Proficiency (0-100)</label>
                                                <input type="range" class="form-range" id="proficiency{{ $skill->id }}" name="proficiency" min="0" max="100" step="5" value="{{ $skill->proficiency }}">
                                                <div class="d-flex justify-content-between">
                                                    <small>0%</small>
                                                    <span class="fw-bold">{{ $skill->proficiency }}%</span>
                                                    <small>100%</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update Skill</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No skills found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer">
            {{ $skills->links() }}
        </div>
    </div>

</div>

<!-- Create Skill Modal -->
<div class="modal fade" id="createSkillModal" tabindex="-1" aria-labelledby="createSkillModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('skills.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createSkillModalLabel">Add New Skill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Skill Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter skill name (e.g., Laravel, Networking)" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Select category</option>
                            <option value="Network">Network</option>
                            <option value="Systems">Systems</option>
                            <option value="Development">Development</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="proficiency" class="form-label">Proficiency Level (0-100%)</label>
                        <input type="range" class="form-range" id="proficiency" name="proficiency" min="0" max="100" step="5" value="50">
                        <div class="d-flex justify-content-between">
                            <small>Beginner (0%)</small>
                            <span class="fw-bold" id="proficiencyValue">50%</span>
                            <small>Expert (100%)</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Skill</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Update proficiency value display
    const proficiencyInput = document.getElementById('proficiency');
    const proficiencyValue = document.getElementById('proficiencyValue');
    
    if (proficiencyInput && proficiencyValue) {
        proficiencyInput.addEventListener('input', function() {
            proficiencyValue.textContent = this.value + '%';
        });
    }

    // For edit modals
    document.querySelectorAll('input[type="range"]').forEach(input => {
        input.addEventListener('input', function() {
            const span = this.parentNode.querySelector('span');
            if (span) {
                span.textContent = this.value + '%';
            }
        });
    });
</script>
@endsection