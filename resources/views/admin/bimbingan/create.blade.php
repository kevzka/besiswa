<!DOCTYPE html>
<html>
<head>
    <title>Bimbingan - Create</title>
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
    <h1>Add New Bimbingan</h1>
    
    <form method="POST" action="{{ route('admin.bimbingan.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" required>
        </div>
        
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="4" required></textarea>
        </div>
        
        <div class="form-group">
            <label>File</label>
            <input type="file" name="file" required>
        </div>
        
        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" required>
        </div>
        
        <button type="submit" class="btn">Save</button>
        <a href="#" class="btn" style="background: #6c757d; text-decoration: none;">Cancel</a>
    </form>
</body>
</html>