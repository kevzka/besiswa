<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Item</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.ekskul.update', $activityData['id']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $activityData['title']) }}" 
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">Date <span class="text-danger">*</span></label>
                                    <input type="date" 
                                           class="form-control @error('date') is-invalid @enderror" 
                                           id="date" 
                                           name="date" 
                                           value="{{ old('date', $activityData['date']) }}" 
                                           required>
                                    @error('date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="5" 
                                      placeholder="Enter description...">{{ old('description', $activityData['description']) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" 
                                   class="form-control-file @error('file') is-invalid @enderror" 
                                   id="file" 
                                   name="file" 
                                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif">
                            
                            @if($activityData['file'])
                                <div class="mt-2">
                                    <small class="text-muted">Current file: </small>
                                    <a href="{{ asset('storage/' . $activityData['file']) }}" 
                                       target="_blank" 
                                       class="text-primary">
                                        {{ basename($activityData['file']) }}
                                    </a>
                                </div>
                            @endif
                            
                            @error('file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">
                                Allowed file types: PDF, DOC, DOCX, JPG, JPEG, PNG, GIF (Max: 2MB)
                            </small>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update
                                    </button>
                                    <a href="{{ route('admin.ekskul.index') }}" class="btn btn-secondary ml-2">
                                        <i class="fas fa-arrow-left"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // File size validation
    document.getElementById('file').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const maxSize = 2 * 1024 * 1024; // 2MB in bytes
            if (file.size > maxSize) {
                alert('File size must be less than 2MB');
                e.target.value = '';
            }
        }
    });
</script>
@endpush
</body>
</html>