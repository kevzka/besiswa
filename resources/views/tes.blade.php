<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css" />
    <title>Document</title>
    {{-- @stack('PaginationStyles') --}}
</head>
    <table id="DataTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- <td>1</td>
            <td>Adi</td>
            <td>2024-06-01</td>
            <td>Edit | Hapus</td> --}}
        </tbody>
    </table>
<body>
    {{-- <x-pagination /> --}}
    {{-- @stack('PaginationScripts') --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" ></script>
    <script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
    <script>
        let DataTable1 = new DataTable('#DataTable',{
            columnDefs: [
                { className: 'dt-center', targets: [0,1,2,3] },
                {
                    width: '60px',
                    targets: 0
                },{
                    width: '120px',
                    orderable: false,
                    targets: 3
                }
            ],
            fixedHeader: true,
            autoWidth: false,
            layout: {
                topStart: false,
                topEnd: {
                    search: {
                        placeholder: 'Search'
                    }
                }
            }
        });
    </script>
</body>

</html>
