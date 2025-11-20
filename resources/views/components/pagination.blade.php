<div class="pagination-component">
    @once
        <style>
            /* Kontainer Utama */
            .pagination-container {
                width: calc(100% - 30px*2);
                position: absolute;
                bottom: 0px;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 40px 0;
                font-family: Arial, sans-serif;
            }

            /* Tombol Sebelumnya/Berikutnya */
            .pagination-btn {
                background-color: #f1f1f1;
                border: 1px solid #ddd;
                color: #333;
                padding: 10px 15px;
                margin: 0 5px;
                cursor: pointer;
                border-radius: 4px;
                font-weight: bold;
                transition: background-color 0.3s, color 0.3s;
            }

            .pagination-btn:hover:not(:disabled) {
                background-color: #ff4d4d;
                color: white;
            }

            .pagination-btn:disabled {
                cursor: not-allowed;
                opacity: 0.5;
            }

            /* Bagian Angka Halaman */
            .pagination-pages {
                display: flex;
                margin: 0 10px;
            }

            .page-link,
            .ellipsis {
                color: #333;
                text-decoration: none;
                padding: 10px 15px;
                margin: 0 3px;
                border: 1px solid #ddd;
                border-radius: 4px;
                transition: background-color 0.3s, color 0.3s, transform 0.2s;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Style Halaman Aktif (Merah) */
            .page-link.active {
                background-color: #d9534f;
                color: white;
                border-color: #d9534f;
                font-weight: bold;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            }

            /* Hover effect */
            .page-link:hover:not(.active) {
                background-color: #eee;
                transform: translateY(-2px);
            }

            /* Style Elipsis */
            .ellipsis {
                border: none;
                cursor: default;
                padding: 10px 5px;
            }

            /* --- Simulasi Animasi Konten Halaman --- */
            .news-content-area {
                animation: fadeIn 0.5s ease-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    @endonce

    {{-- news list container (ubah id jadi class agar bisa multiple instance) --}}
    <section class="news-wrap">
        <h2 class="news-label">NEWS</h2>
        <div class="news-list-container"></div>

        <div class="pagination-container">
            <button class="pagination-btn prev-btn" disabled>
                &lt; Sebelumnya
            </button>
    
            <div class="pagination-pages">
                <a href="#" class="page-link active" data-page="1">1</a>
                <span class="ellipsis" style="display: none;">...</span>
                <a href="#" class="page-link" data-page="2">2</a>
                <a href="#" class="page-link" data-page="3">3</a>
            </div>
    
            <button class="pagination-btn next-btn">
                Berikutnya &gt;
            </button>
        </div>
    </section>


    @once
        <script>
            // Blade variables for URLs
            const ASSET_STORAGE_URL = "{{ asset('storage') }}";
            const BASE_URL = "{{ url('/') }}";
            const API_BASE_URL = "{{ config('app.API') }}";
            const apiUrl = 'http://' + API_BASE_URL + '/api/user';

            document.addEventListener('DOMContentLoaded', initPaginationComponents);

            function initPaginationComponents() {
                document.querySelectorAll('.pagination-component').forEach(root => {
                    initComponent(root);
                });
            }

            function initComponent(root) {
                const itemsPerPage = 5;
                let allData = [];
                let currentPage = 1;
                let totalPages = 1;

                const pagesContainer = root.querySelector('.pagination-pages');
                const prevBtn = root.querySelector('.prev-btn');
                const nextBtn = root.querySelector('.next-btn');
                const newsContainer = root.querySelector('.news-list-container');

                // bind buttons
                if (prevBtn) prevBtn.addEventListener('click', () => { if (currentPage > 1) goToPage(currentPage - 1); });
                if (nextBtn) nextBtn.addEventListener('click', () => { if (currentPage < totalPages) goToPage(currentPage + 1); });

                // fetch data then init pagination
                fetchData(apiUrl, { function: 'dataIndex', type: {{ $type }} })
                    .then(response => {
                        if (response && response.allData && Array.isArray(response.allData)) {
                            allData = response.allData;
                            totalPages = Math.max(1, Math.ceil(allData.length / itemsPerPage));
                            renderPage();
                        } else {
                            // fallback: show empty state
                            newsContainer.innerHTML = '<div class="news-content-area" style="padding:20px">Tidak ada data.</div>';
                            renderPage(); // still render pagination defaults
                        }
                    })
                    .catch(err => {
                        console.error('Fetch error:', err);
                        newsContainer.innerHTML = '<div class="news-content-area" style="padding:20px">Terjadi kesalahan saat mengambil data.</div>';
                        renderPage();
                    });

                // ----- helper functions for this component -----
                function renderPage() {
                    renderPagination();
                    loadContent(currentPage);
                }

                function loadContent(page) {
                    // slice data for current page and render
                    const start = (page - 1) * itemsPerPage;
                    const slice = allData.slice(start, start + itemsPerPage);
                    renderNewsList(newsContainer, slice);
                }

                function renderNewsList(container, items) {
                    if (!items || items.length === 0) {
                        container.innerHTML = '<div class="news-content-area" style="padding:20px">Tidak ada berita untuk halaman ini.</div>';
                        return;
                    }

                    const html = items.map(item => {
                        return `
                            <div class="news-card" ">
                                <img src="${ASSET_STORAGE_URL}/${item.file}" alt="${escapeHtml(item.title)}" ">
                                <div class="news-content">
                                    <h3>${escapeHtml(item.title)}</h3>
                                    <p>${escapeHtml(item.description)}</p>
                                    <small>${formatDate(item.date)}</small><br>
                                    <a href="${BASE_URL}/user/berita/beritabimbingan/SPMB" class="read-more">Lihat Selengkapnya....</a>
                                </div>
                            </div>
                        `;
                    }).join('');

                    container.innerHTML = `${html}`;
                }

                function renderPagination() {
                    pagesContainer.innerHTML = '';
                    const pages = [];
                    const maxVisiblePages = 3;

                    pages.push(1);

                    let start = Math.max(2, currentPage - Math.floor(maxVisiblePages / 2));
                    let end = Math.min(totalPages - 1, currentPage + Math.floor(maxVisiblePages / 2));

                    if (currentPage <= Math.ceil(maxVisiblePages / 2)) {
                        end = maxVisiblePages + 1;
                    } else if (currentPage > totalPages - Math.ceil(maxVisiblePages / 2)) {
                        start = totalPages - maxVisiblePages;
                    }

                    start = Math.max(2, start);
                    end = Math.min(totalPages - 1, end);

                    if (start > 2) pages.push('...');
                    for (let i = start; i <= end; i++) pages.push(i);
                    if (end < totalPages - 1) pages.push('...');
                    if (totalPages > 1 && !pages.includes(totalPages)) pages.push(totalPages);

                    pages.forEach(page => {
                        if (page === '...') {
                            const ellipsis = document.createElement('span');
                            ellipsis.className = 'ellipsis';
                            ellipsis.textContent = '...';
                            pagesContainer.appendChild(ellipsis);
                        } else {
                            const link = document.createElement('a');
                            link.href = `#page-${page}`;
                            link.className = 'page-link';
                            link.textContent = page;
                            link.dataset.page = page;

                            if (page === currentPage) link.classList.add('active');

                            link.addEventListener('click', (e) => {
                                e.preventDefault();
                                const p = parseInt(e.currentTarget.dataset.page, 10);
                                if (!isNaN(p) && p !== currentPage) {
                                    goToPage(p);
                                }
                            });

                            pagesContainer.appendChild(link);
                        }
                    });

                    if (prevBtn) prevBtn.disabled = currentPage === 1;
                    if (nextBtn) nextBtn.disabled = currentPage === totalPages;
                }

                function goToPage(page) {
                    currentPage = Math.max(1, Math.min(totalPages, page));
                    loadContent(currentPage);
                    renderPagination();
                }
            }

            // ----- utility functions (shared) -----
            function fetchData(url, body = {}) {
                return fetch(url, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(body)
                })
                .then(response => {
                    if (!response.ok) throw new Error('Request failed: ' + response.status);
                    return response.json();
                });
            }

            function formatDate(dateString) {
                if (!dateString) return '';
                try {
                    const date = new Date(dateString);
                    const options = { weekday: 'short', day: '2-digit', month: '2-digit', year: 'numeric' };
                    return date.toLocaleDateString('id-ID', options).replace(/\//g, '-').replace('.', ',');
                } catch (e) {
                    return dateString;
                }
            }

            function escapeHtml(str) {
                if (!str) return '';
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;');
            }
        </script>
    @endonce
</div>
