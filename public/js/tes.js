fetch('/api/crud/create', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({ type: 1})
}).then(response => response.json())
.then(data => loadDataToTable(data))
.catch(error => console.error(error));

const roles = {
        1 : 'bimbingan',
        2 : 'prestasi',
        3 : 'ekskul',
        4 : 'utama'
};

if(prompt("Masukkan id admin:")) {
    //refresh page
        // location.reload();
}

// function loadDataToTable(data) {

//     const tableBody = document.getElementById('table-body');
//     let iteration = 1;
//     for(let item of data['data']) {
//         console.log(item);
//         tableBody.innerHTML +=
//             `<tr>
//                 <td>${iteration++}</td>
//                 <td>${item['title']}</td>
//                 <td>${item['date']}</td>
//                 <td></td>
//                 <td class="table-actions">
//                     <form action="{{ route('admin.${roles[item['type']]}.edit', ['kegiatan' => $item['id_evidence']]) }}"
//                         method="GET" style="display: inline;">
//                         @csrf
//                         <a href="javascript:void(0)" onclick="this.parentElement.submit()">
//                             <i title="Edit" class="fa-solid fa-pencil"></i>
//                         </a>
//                     </form>
//                     <i>||</i>
//                     <form action="{{ route('admin.${roles[item['type']]}.destroy', ['kegiatan' => $item['id_evidence']]) }}"
//                         method="POST" style="display: inline;">
//                         @csrf
//                         @method('DELETE')

//                         <a href="javascript:void(0)" onclick="alertDelete(this, event)">
//                             <i title="Delete" class="fa-solid fa-trash"></i>
//                         </a>
//                     </form>
//                 </td>
//             </tr>`;
//     }
//     console.log(tableBody.innerHTML)

// }

//   .then(data => console.log(data))
//   .catch(error => console.error(error));