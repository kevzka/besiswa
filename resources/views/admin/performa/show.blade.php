<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border="1">
         <tr>
                <th>id Lomba</th>
                <th>nis Siswa</th>
                <th>nama Lomba</th>
                <th>file Dokumentasi</th>
                <th>deskripsi Lomba</th>
                <th>tanggal Lomba</th>
                <th>tingkat Lomba</th>
                <th>tingkat Juara</th>
                <th>poinLomba</th>
                <th>Aksi</th>
            </tr>
             <tr>
                <td>{{$data["idLomba"]}}</td>
                <td>{{implode(', ', $data["nisSiswa"])}}</td>
                <td>{{$data["namaLomba"]}}</td>
                <td>{{$data["fileDokumentasi"]}}</td>
                <td>{{$data["deskripsiLomba"]}}</td>
                <td>{{$data["tanggalLomba"]}}</td>
                <td>{{$data["tingkatLomba"]}}</td>
                <td>{{$data["tingkatJuara"]}}</td>
                <td>{{$data["poinLomba"]}}</td>
                <td>
                    <a href="{{route('tes.edit', $data['idLomba'])}}">Edit</a>
                    <form action="{{route('tes.destroy', $data['idLomba'])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
    </table>
</body>
</html>