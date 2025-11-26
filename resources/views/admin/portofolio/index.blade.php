<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{route('admin.portofolio.create')}}">+ new performa</a>
    <table border="1">
        <tr>
            <th>id Lomba</th>
            <th>nama Lomba</th>
            <th>file Dokumentasi</th>
            <th>deskripsi Lomba</th>
            <th>tanggal Lomba</th>
            <th>aksi</th>
        </tr>
        @foreach ($datas as $data)
            <tr>
                <td>{{$data["idLomba"]}}</td>
                <td>{{$data["namaLomba"]}}</td>
                <td>{{$data["fileDokumentasi"]}}</td>
                <td>{{$data["deskripsiLomba"]}}</td>
                <td>{{$data["tanggalLomba"]}}</td>
                <td>
                    <a href="{{route('admin.portofolio.show', $data['idLomba'])}}">View</a>
                    <a href="{{route('admin.portofolio.edit', $data['idLomba'])}}">Edit</a>
                    <form action="{{route('admin.portofolio.destroy', $data['idLomba'])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
