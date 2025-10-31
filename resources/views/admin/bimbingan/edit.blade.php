<!DOCTYPE html>
<html>
<head>
    <title>Bimbingan - Edit</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .btn { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h1>Edit Bimbingan</h1>
    <form method="POST" action="{{ route('admin.bimbingan.update', $activityData['id']) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ $activityData['title'] ?? '' }}" required>
        </div>
        
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="4" required>{{ $activityData['description'] ?? '' }}</textarea>
        </div>
        
        <div class="form-group">
            <label>File (optional)</label>
            <input type="file" name="file">
            @if(isset($activityData['file']) && $activityData['file'])
            <small>Current file: {{ basename($activityData['file']) }}</small>
            @endif
        </div>
        
        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" value="{{ $activityData['date'] ?? '' }}" required>
        </div>
        
        <button type="submit" class="btn">Update</button>
        <a href="#" class="btn" style="background: #6c757d; text-decoration: none;">Cancel</a>
    </form>
</body>
</html>