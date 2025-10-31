<!DOCTYPE html>
<html>
<head>
    <title>Bimbingan - List</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; margin: 2px; text-decoration: none; border-radius: 3px; }
        .btn-primary { background: #007bff; color: white; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-success { background: #28a745; color: white; }
    </style>
</head>
<body>
    <h1>Data Bimbingan</h1>
    <a href="{{ route('admin.bimbingan.create') }}" class="btn btn-primary">+ Add New</a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($activities as $item)
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['title'] }}</td>
                <td>{{ Str::limit($item['description'], 50) }}</td>
                <td>{{ $item['date'] }}</td>
                <td><a href="{{ asset('storage/' . $item['file']) }}" target="_blank">View File</a></td>
                <td>
                    <form action="{{ route('admin.bimbingan.edit', $item['id']) }}" method="GET" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                    <form action="{{ route('admin.bimbingan.destroy', $item['id']) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this item?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">No data available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>