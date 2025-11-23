<?php

namespace Database\Seeders;

use App\Models\TbEvidences;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TbEvidencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TbEvidences::insert([
            // --- TYPE 1: BIMBINGAN / KONSULTASI (5 Data) ---
            [
                'id_admin' => 1,
                'type' => 1,
                'title' => 'Sesi Konsultasi Proyek Akhir TIK dengan Mentor Utama',
                'file' => 'kegiatan/dummy/dummyBimbingan1.png',
                'description' => 'Sesi konsultasi ini berfokus pada tahapan kritis pengembangan proyek akhir TIK, khususnya "Aplikasi Smart School". Diskusi mencakup validasi model data, penentuan *framework* yang paling efisien, dan penerapan standar *clean code*. Konsultasi ini sangat penting untuk memastikan bahwa hasil proyek tidak hanya berfungsi tetapi juga *scalable* dan mudah di-*maintain*. Tujuan utama sesi ini adalah meminimalisir risiko kegagalan teknis di tahap implementasi.

                                    Dalam sesi ini, mentor menekankan pentingnya **keamanan data** dan *user experience* (UX) yang intuitif. Setiap anggota tim mempresentasikan bagian kodenya, yang kemudian ditinjau bersama untuk mencari potensi *bug* atau celah keamanan. Pendekatan ini memastikan bahwa siswa tidak hanya menyelesaikan tugas, tetapi juga memahami praktik terbaik di dunia industri profesional.

                                    Hasil dari sesi ini adalah *blueprint* arsitektur yang disempurnakan dan daftar *milestone* yang lebih realistis. Tim diminta untuk memprioritaskan uji coba end-to-end sebelum *deployment* beta.
                                    Kutipan 1: "Perlu fokus pada keamanan data, sesuai standar industri terkini, karena integritas informasi adalah prioritas utama."
                                    Kutipan 2: "Proyek yang hebat lahir dari fondasi yang kuat; **kedisiplinan dalam coding** adalah investasi jangka panjang terbaik kalian."',
                'date' => '2025-01-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 1,
                'title' => 'Evaluasi Mingguan Kemajuan Studi Siswa Kelas XII',
                'file' => 'kegiatan/dummy/dummyBimbingan2.png',
                'description' => 'Pertemuan rutin ini diadakan untuk memonitor perkembangan akademis siswa kelas XII, yang kini memasuki fase krusial menjelang Ujian Nasional dan seleksi masuk perguruan tinggi. Fokus utama evaluasi adalah pada mata pelajaran eksakta (Matematika, Fisika, Kimia) di mana banyak siswa menghadapi tantangan. Guru BK dan guru mata pelajaran berkolaborasi memberikan bimbingan belajar yang terpersonalisasi.

                                    Strategi yang dibahas meliputi metode *self-testing*, pembentukan kelompok belajar efektif, dan teknik manajemen waktu. Sesi ini juga berfungsi sebagai *early warning system* untuk siswa yang menunjukkan penurunan motivasi atau nilai. Tujuannya adalah memastikan setiap siswa memiliki rencana belajar yang optimal dan realistis sesuai dengan target akademik mereka.

                                    Sesi ditutup dengan motivasi dan penekanan pada pentingnya **konsistensi** dalam belajar. Siswa didorong untuk memanfaatkan semua sumber daya yang disediakan sekolah, termasuk laboratorium dan perpustakaan.
                                    Kutipan 1: "Disiplin adalah kunci; lakukan pengabdian belajar di jam yang sama setiap hari untuk membangun ritme keberhasilan."
                                    Kutipan 2: "Ingatlah, **kemampuan adalah apa yang kalian capai**, tetapi motivasi menentukan seberapa jauh kalian bersedia untuk belajar."',
                'date' => '2025-01-11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 1,
                'title' => 'Bimbingan Karir: Pilihan Lanjut Kuliah atau Dunia Kerja',
                'file' => 'kegiatan/dummy/dummyBimbingan3.png',
                'description' => 'Bimbingan karir ini dirancang untuk membantu siswa kelas akhir menentukan jalur mereka pasca-lulus: melanjutkan ke jenjang pendidikan tinggi atau langsung terjun ke dunia kerja. Sesi ini diawali dengan tes minat dan bakat lanjutan, diikuti dengan sesi diskusi individual dengan konselor karir. Siswa diberikan gambaran realistis tentang tren pasar kerja saat ini dan peluang di berbagai sektor.

                                    Materi yang dibahas mencakup cara membuat CV profesional, strategi wawancara, serta peluang beasiswa dan program magang. Sekolah juga memfasilitasi informasi mengenai jalur *fast-track* ke perusahaan-perusahaan mitra, khususnya di sektor teknologi dan industri. Tujuannya adalah memberikan pemahaman komprehensif agar siswa dapat mengambil keputusan yang tepat.

                                    Sesi ditutup dengan *pledge* komitmen dari siswa untuk mulai menyusun rencana aksi karir mereka. Siswa diingatkan bahwa karir adalah maraton, bukan lari cepat, dan persiapan yang matang adalah segalanya.
                                    Kutipan 1: "Setiap pilihan adalah prestasi, fokus pada pengembangan diri, baik sebagai akademisi maupun profesional, karena itu yang membedakan kalian."
                                    Kutipan 2: "**Pekerjaan terbaik adalah yang sesuai dengan *passion* dan kemampuan kalian**, jangan pernah berhenti mengeksplorasi potensi diri."',
                'date' => '2025-01-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 1,
                'title' => 'Workshop Pembuatan Proposal Riset Ilmiah Remaja',
                'file' => 'kegiatan/dummy/dummyBimbingan4.png',
                'description' => 'Workshop ini diselenggarakan khusus untuk anggota Kelompok Ilmiah Remaja (KIR) yang sedang mempersiapkan proposal untuk kompetisi riset nasional. Materi fokus pada tiga aspek: perumusan masalah yang inovatif, penyusunan hipotesis yang teruji, dan penentuan metodologi penelitian yang valid. Mentor adalah seorang dosen dari universitas mitra yang berpengalaman di bidang riset.

                                    Para siswa diajarkan cara mengakses jurnal ilmiah, melakukan tinjauan literatur yang sistematis, dan menghindari plagiarisme. Sesi praktik langsung dilakukan di mana setiap tim mempresentasikan draf awal proposal mereka untuk mendapat *feedback* konstruktif. Hal ini bertujuan meningkatkan kualitas ilmiah karya siswa.

                                    Diharapkan, dengan bimbingan intensif ini, proposal riset siswa dapat lolos seleksi awal dan menghasilkan karya yang berdampak nyata. Penekanan diberikan pada etika penelitian dan **keakuratan data**.
                                    Kutipan 1: "Ketelitian dalam data adalah fondasi karya ilmiah yang jujur; jangan pernah berkompromi dengan kualitas informasi."
                                    Kutipan 2: "**Riset yang baik selalu berawal dari pertanyaan yang kuat**, temukan masalah yang otentik dan berdampak untuk diselesaikan."',
                'date' => '2025-01-13',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 1,
                'title' => 'Bimbingan Psikologis: Manajemen Stres Ujian',
                'file' => 'kegiatan/dummy/dummyBimbingan5.png',
                'description' => 'Sesi bimbingan psikologis ini merupakan respons proaktif sekolah untuk mengatasi tingkat stres yang meningkat menjelang periode ujian semester dan Ujian Nasional. Kegiatan ini dipimpin oleh konselor sekolah berlisensi yang memberikan teknik praktis dalam mengelola kecemasan dan tekanan akademis. Topik yang dibahas mencakup *mindfulness*, teknik pernapasan untuk relaksasi, dan strategi tidur yang sehat.

                                    Siswa diajarkan cara membedakan antara stres yang produktif dan stres yang destruktif, serta cara menggunakan stres sebagai pendorong, bukan penghambat. Ditekankan pula pentingnya **keseimbangan** antara belajar, istirahat, dan kegiatan sosial. Siswa dibagi menjadi kelompok-kelompok kecil untuk berbagi pengalaman dan dukungan emosional.

                                    Tujuan akhir dari sesi ini adalah agar siswa dapat menghadapi ujian dengan pikiran yang tenang, percaya diri, dan fokus. Kesejahteraan mental dipandang sebagai prasyarat utama keberhasilan akademik.
                                    Kutipan 1: "Jaga kesehatan mentalmu; keberhasilan datang dari pikiran yang tenang dan fokus, bukan hanya dari hafalan."
                                    Kutipan 2: "**Tekanan itu nyata**, tetapi **kekuatan ada di dalam diri**; pelajari cara mengendalikan reaksi kalian terhadapnya."',
                'date' => '2025-01-14',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // --- TYPE 2: PRESTASI / LOMBA (5 Data) ---
            [
                'id_admin' => 1,
                'type' => 2,
                'title' => 'Juara 1 Lomba Web Design Tingkat Provinsi Kaltim',
                'file' => 'kegiatan/dummy/dummyPrestasi1.png',
                'description' => 'Tim Desain Grafis dan Multimedia SMK Telkom Banjarbaru berhasil mengukir prestasi gemilang dengan meraih gelar Juara 1 pada Lomba Web Design tingkat Provinsi Kalimantan Timur. Kompetisi ini menantang peserta untuk membuat sebuah portal interaktif dalam waktu 48 jam. Proyek pemenang yang diusung bertema *Eco-Tourism* dengan fokus pada eksplorasi digital destinasi wisata ramah lingkungan di Kalimantan.

                                    Keunggulan tim terletak pada desain yang *user-friendly*, implementasi teknologi *front-end* yang mutakhir, dan konten visual yang menarik. Kemenangan ini membuktikan bahwa siswa/i sekolah mampu bersaing dan unggul di tingkat regional, khususnya dalam bidang TIK. Prestasi ini merupakan hasil dari latihan intensif dan dedikasi tinggi di bawah bimbingan guru.

                                    Sekolah berkomitmen untuk terus mendukung tim ini ke jenjang kompetisi nasional. Kemenangan ini diharapkan menginspirasi siswa lain untuk berani menciptakan karya inovatif dan meraih prestasi tertinggi.
                                    Kutipan 1: "Kreativitas bukan berarti berhenti berjuang, tetapi **melanjutkan perjuangan dalam bentuk pengabdian, karya, dan prestasi**."
                                    Kutipan 2: "Kemenangan ini adalah bukti bahwa **kolaborasi dan penguasaan teknologi** adalah kunci meraih Juara 1 di era digital."',
                'date' => '2025-01-17',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 2,
                'title' => 'Perwakilan Sekolah dalam Olimpiade Sains Nasional (OSN) Bidang Fisika',
                'file' => 'kegiatan/dummy/dummyPrestasi2.png',
                'description' => 'Siswa kebanggaan sekolah, Ahmad Fathir, berhasil lolos ke tahap nasional Olimpiade Sains Nasional (OSN) untuk bidang Fisika, setelah melalui seleksi ketat di tingkat kota dan provinsi. Pencapaian ini menempatkannya sebagai salah satu talenta muda terbaik di bidang sains. Kelolosannya adalah hasil dari program akselerasi akademik dan bimbingan khusus selama enam bulan terakhir.

                                    Saat ini, Ahmad Fathir sedang menjalani persiapan intensif yang mencakup pemecahan soal-soal tingkat lanjut, simulasi ujian, dan konsultasi dengan profesor dari perguruan tinggi. Sekolah memberikan dukungan penuh berupa fasilitas dan akses ke sumber belajar premium. Target utama adalah meraih medali dan mengharumkan nama sekolah serta daerah di kancah nasional.

                                    Dedikasi Ahmad Fathir dalam mendalami ilmu fisika menjadi inspirasi bagi seluruh siswa. Sekolah meyakini bahwa dengan persiapan yang matang dan semangat juang tinggi, ia mampu memberikan yang terbaik.
                                    Kutipan 1: "Dedikasi Fathir membuktikan bahwa **kerja keras dan ketekunan** adalah pintu gerbang menuju prestasi tertinggi."
                                    Kutipan 2: "Semangat ‘Indonesia Emas 2045’ kami kobarkan, yaitu **terus belajar dan berkontribusi** melalui penguasaan ilmu pengetahuan."',
                'date' => '2025-01-18',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 2,
                'title' => 'Medali Perak Kejuaraan Bulutangkis Antar-Sekolah se-Kalimantan',
                'file' => 'kegiatan/dummy/dummyPrestasi3.png',
                'description' => 'Tim olahraga bulutangkis SMK Telkom Banjarbaru berhasil menyumbangkan medali perak dalam Kejuaraan Bulutangkis Antar-Sekolah Regional Kalimantan. Pertandingan yang berlangsung selama tiga hari ini menunjukkan performa yang luar biasa dari tim sekolah, melewati puluhan lawan tangguh dari berbagai daerah. Semangat juang dan sportivitas tim patut diacungi jempol.

                                    Meskipun harus puas di posisi kedua, pencapaian ini merupakan peningkatan signifikan dari tahun sebelumnya. Pelatih menyoroti peningkatan teknik dan mental bertanding para atlet. Keberhasilan ini tidak lepas dari jadwal latihan yang disiplin dan dukungan penuh dari manajemen sekolah dan guru pendamping.

                                    Prestasi ini membuktikan bahwa sekolah tidak hanya unggul di bidang akademik dan TIK, tetapi juga di bidang non-akademik, khususnya olahraga. Semangat tim adalah representasi dari persatuan dan kerjasama yang solid.
                                    Kutipan 1: "Semangat ‘Indonesia Emas 2045’ harus kita kobarkan, yaitu **menjaga sportivitas dan terus berprestasi** di setiap ajang kompetisi."
                                    Kutipan 2: "**Kekalahan hari ini adalah pupuk untuk kemenangan esok**; yang terpenting adalah semangat juang yang tidak pernah padam."',
                'date' => '2025-01-19',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 2,
                'title' => 'Penghargaan "Sekolah Berbudaya Lingkungan" dari Dinas Pendidikan',
                'file' => 'kegiatan/dummy/dummyPrestasi4.png',
                'description' => 'SMK Telkom Banjarbaru dianugerahi penghargaan prestisius sebagai "Sekolah Berbudaya Lingkungan" oleh Dinas Pendidikan dan Lingkungan Hidup. Penghargaan ini diberikan atas komitmen sekolah dalam mengintegrasikan nilai-nilai konservasi dan praktik ramah lingkungan ke dalam kurikulum dan kehidupan sehari-hari sekolah. Program unggulan yang menjadi sorotan adalah program bank sampah, *zero plastic campaign*, dan pemanfaatan kompos dari limbah organik.

                                    Seluruh elemen sekolah, mulai dari siswa, guru, hingga staf kebersihan, berpartisipasi aktif dalam upaya ini. Penghargaan ini menjadi pengakuan atas keseriusan sekolah dalam membentuk generasi yang **sadar lingkungan** dan bertanggung jawab terhadap keberlanjutan bumi. Sekolah berencana untuk memperluas program ini dengan memasang panel surya.

                                    Pencapaian ini diharapkan menjadi inspirasi bagi sekolah-sekolah lain di wilayah tersebut untuk turut mengutamakan pendidikan lingkungan.
                                    Kutipan 1: "Wujudkan Indonesia yang lebih maju, adil, dan sejahtera melalui **kepedulian dan kontribusi nyata pada lingkungan**."
                                    Kutipan 2: "**Menjaga bumi adalah bagian dari pengabdian kita**; setiap sampah yang kita kelola adalah investasi bagi masa depan generasi."',
                'date' => '2025-01-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 2,
                'title' => 'Lolos Seleksi Duta Budaya dan Pariwisata Kota',
                'file' => 'kegiatan/dummy/dummyPrestasi5.png',
                'description' => 'Dua siswa terbaik SMK Telkom Banjarbaru, Aisyah dan Bima, berhasil lolos seleksi ketat untuk menjadi Duta Budaya dan Pariwisata Kota. Mereka akan mewakili generasi muda dalam mempromosikan destinasi wisata lokal, adat istiadat, dan warisan budaya daerah ke kancah yang lebih luas. Seleksi meliputi tes pengetahuan umum, keterampilan komunikasi, dan pemahaman mendalam tentang sejarah kota.

                                    Pencapaian ini membuktikan bahwa siswa/i sekolah memiliki talenta yang holistik, tidak hanya di bidang sains dan teknologi, tetapi juga dalam pelestarian budaya. Sebagai Duta, mereka akan terlibat dalam berbagai acara publik dan kampanye promosi pariwisata. Sekolah memberikan dukungan penuh dalam hal *mentoring* dan peningkatan keterampilan publik *speaking*.

                                    Sekolah bangga melihat siswa/i menjadi representasi positif dan *role model* bagi pemuda lainnya. Mereka adalah agen perubahan yang siap menyebarkan semangat cinta tanah air.
                                    Kutipan 1: "**Dirgahayu Indonesiaku! Jayalah selalu bangsaku, tanah airku tercinta**, dan jadilah duta bagi keindahan negerimu."
                                    Kutipan 2: "**Budaya adalah jati diri bangsa**; melestarikannya adalah tugas mulia dari setiap generasi muda."',
                'date' => '2025-01-21',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // --- TYPE 3: EKSTRAKURIKULER (5 Data) ---
            [
                'id_admin' => 1,
                'type' => 3,
                'title' => 'Latihan Gabungan Paskibra untuk Upacara HUT RI ke-80',
                'file' => 'kegiatan/dummy/dummyEkskul1.png',
                'description' => 'Tim Pasukan Pengibar Bendera Pusaka (Paskibra) sekolah sedang menjalani latihan gabungan intensif sebagai persiapan untuk Upacara Peringatan HUT RI ke-80 yang akan datang. Latihan ini berfokus pada kesempurnaan formasi baris-berbaris, teknik pengibaran bendera, dan **kekompakan tim**. Sesi latihan fisik yang ketat bertujuan membangun daya tahan dan kedisiplinan mental anggota.

                                    Pelatih menekankan bahwa tugas Paskibra adalah simbol kehormatan negara. Setiap gerakan harus presisi dan mencerminkan semangat persatuan bangsa. Anggota Paskibra menunjukkan dedikasi luar biasa, berlatih di bawah terik matahari demi kesuksesan upacara.

                                    Kegiatan ini merupakan pengingat bahwa **kedisiplinan** adalah pondasi dari setiap keberhasilan, baik di sekolah maupun dalam kehidupan berbangsa. Tim Paskibra siap menjalankan tugas mulia ini dengan penuh tanggung jawab.
                                    Kutipan 1: "Upacara ini bukan sekadar seremonial, tetapi **pengingat bahwa kemerdekaan lahir dari perjuangan dan persatuan** yang tak kenal lelah."
                                    Kutipan 2: "**Bendera adalah kehormatan kita**; setiap langkah harus mencerminkan rasa bangga dan cinta tanah air yang tak terhingga."',
                'date' => '2025-01-22',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 3,
                'title' => 'Kegiatan Bakti Sosial Pramuka di Panti Asuhan',
                'file' => 'kegiatan/dummy/dummyEkskul2.png',
                'description' => 'Anggota Pramuka Ambalan Sekolah melaksanakan kegiatan bakti sosial di salah satu panti asuhan lokal. Kegiatan ini merupakan bagian dari program kerja tahunan Pramuka yang menekankan nilai-nilai kepedulian sosial, kemanusiaan, dan berbagi. Selain memberikan donasi berupa sembako dan perlengkapan sekolah, anggota Pramuka juga mengadakan kegiatan *edutainment* interaktif dengan anak-anak panti.

                                    Kegiatan ini mengajarkan siswa tentang pentingnya empati dan *soft skill* berkomunikasi dengan berbagai lapisan masyarakat. Seluruh dana yang digunakan berasal dari iuran anggota dan sumbangan sukarela. Tujuannya adalah menanamkan semangat **Dharma Pramuka** dan pengabdian masyarakat sejak dini.

                                    Sesi ditutup dengan permainan bersama dan janji untuk terus menjalin silaturahmi. Kegiatan ini memberikan pengalaman berharga yang lebih dari sekadar teori di kelas.
                                    Kutipan 1: "**Bakti pada masyarakat adalah bentuk pengabdian yang paling mulia**, karena kemerdekaan berarti saling menolong sesama."
                                    Kutipan 2: "**Tali persaudaraan adalah kekayaan sejati**, dan Pramuka selalu siap sedia untuk berbagi kasih dan perhatian."',
                'date' => '2025-01-23',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 3,
                'title' => 'Pementasan Drama Musikal oleh Teater Bintang Sekolah',
                'file' => 'kegiatan/dummy/dummyEkskul3.png',
                'description' => 'Ekskul Teater Bintang Sekolah sedang dalam tahap latihan final untuk pementasan drama musikal adaptasi dari novel populer "Laskar Pelangi". Pementasan ini akan menjadi acara puncak Pekan Seni Budaya Sekolah. Latihan difokuskan pada sinkronisasi akting, vokal, dan koreografi, yang melibatkan lebih dari 30 siswa dari berbagai kelas.

                                    Kegiatan ini bertujuan mengasah kreativitas, kepercayaan diri, dan kemampuan **kerja tim** siswa di balik layar maupun di atas panggung. Proyek ini juga merupakan upaya melestarikan dan mengapresiasi karya sastra nasional melalui media seni pertunjukan modern. Siswa belajar tentang manajemen produksi, mulai dari *lighting*, *sound*, hingga *set design*.

                                    Semua anggota teater bekerja keras untuk memberikan penampilan terbaik yang menghibur dan menginspirasi penonton tentang semangat pendidikan dan persahabatan.
                                    Kutipan 1: "**Kolaborasi seni adalah cara kita bersama-sama membangun bangsa**, di mana setiap peran, besar maupun kecil, memiliki makna."
                                    Kutipan 2: "**Panggung adalah tempat keajaiban terjadi**, dan kita harus mengisi setiap momen dengan dedikasi total pada seni."',
                'date' => '2025-01-24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 3,
                'title' => 'Latihan Rutin Tim Robotika: Kalibrasi Sensor',
                'file' => 'kegiatan/dummy/dummyEkskul4.png',
                'description' => 'Tim Robotika sekolah mengadakan latihan rutin untuk menguji coba dan mengkalibrasi prototipe robot *line follower* yang akan diikutsertakan dalam kompetisi regional. Fokus utama sesi ini adalah mengoptimasi algoritma pergerakan robot dan memastikan **akurasi sensor** dalam mendeteksi garis. Siswa secara mandiri melakukan *troubleshooting* pada perangkat keras (hardware) dan kode program (software).

                                    Kegiatan ekskul ini secara langsung menerapkan ilmu fisika, matematika, dan pemrograman yang dipelajari di kelas. Ini adalah wadah praktik terbaik untuk mengembangkan *problem-solving skills* dan logika berpikir komputasional. Tim bekerja di bawah tekanan waktu untuk menemukan konfigurasi terbaik sebelum batas akhir pendaftaran lomba.

                                    Latihan ini membuktikan semangat **inovasi** dan ketekunan siswa dalam bidang teknologi, menyiapkan mereka untuk karir masa depan di industri 4.0.
                                    Kutipan 1: "**Inovasi adalah kontribusi nyata bagi negeri**; setiap baris kode yang kalian tulis adalah langkah maju untuk bangsa."
                                    Kutipan 2: "**Kegagalan adalah *input* terbaik**; teruslah uji coba, karena robot yang sempurna lahir dari ribuan kali kalibrasi."',
                'date' => '2025-01-25',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 3,
                'title' => 'Diskusi dan Bedah Film Dokumenter oleh Ekskul Sinematografi',
                'file' => 'kegiatan/dummy/dummyEkskul5.png',
                'description' => 'Ekskul Sinematografi mengadakan sesi diskusi dan bedah film dokumenter mingguan. Pada sesi kali ini, film yang dibahas adalah karya sineas lokal yang mengangkat tema sejarah perjuangan kemerdekaan. Tujuan kegiatan ini adalah untuk menganalisis teknik pengambilan gambar (*cinematography*), gaya *storytelling*, dan pesan moral yang disampaikan oleh pembuat film.

                                    Siswa diajak untuk berpikir kritis mengenai cara media visual dapat membentuk narasi dan mempengaruhi publik. Diskusi ini juga berfungsi sebagai *benchmarking* untuk meningkatkan kualitas produksi film pendek yang sedang dikerjakan oleh anggota ekskul. Aspek yang ditekankan adalah **otentisitas** dan kekuatan narasi.

                                    Kegiatan ini memperkaya pengetahuan siswa tentang sejarah sekaligus mengasah kemampuan teknis mereka dalam membuat konten visual yang berkualitas dan mendalam.
                                    Kutipan 1: "**Karya bukan berarti berhenti berjuang**, tetapi **melanjutkan perjuangan dalam bentuk karya** seni yang mengedukasi dan menginspirasi."
                                    Kutipan 2: "**Sebuah bingkai film mampu bercerita ribuan kata**; pastikan setiap bingkai yang kalian ambil memiliki makna dan kekuatan yang mendalam."',
                'date' => '2025-01-26',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // --- TYPE 4: INOVASI / KARYA ILMIAH (5 Data) ---
            [
                'id_admin' => 1,
                'type' => 2,
                'title' => 'Peluncuran Prototipe Aplikasi Monitoring Bencana Berbasis IoT',
                'file' => 'kegiatan/dummy/dummyPrestasiLomba1.png',
                'description' => 'Siswa jurusan Rekayasa Perangkat Lunak (RPL) dengan bangga meluncurkan prototipe Aplikasi Monitoring Bencana yang terintegrasi dengan teknologi Internet of Things (IoT). Sistem ini dirancang untuk mendeteksi potensi bahaya, seperti peningkatan level air di sungai dan getaran tanah, secara *real-time* menggunakan sensor yang ditempatkan di lokasi rawan. Data dikirimkan ke server sekolah dan dapat diakses melalui aplikasi mobile.

                                    Inovasi ini bertujuan memberikan **peringatan dini** yang lebih cepat dan akurat kepada pihak berwenang dan masyarakat sekitar. Proyek ini menunjukkan aplikasi praktis dari ilmu TIK dalam konteks mitigasi bencana. Pengembangan prototipe ini memakan waktu enam bulan dan melibatkan kolaborasi erat antara siswa, guru RPL, dan mentor dari komunitas *developer* lokal.

                                    Langkah selanjutnya adalah pengujian di lapangan dan mencari pendanaan untuk produksi massal. Aplikasi ini adalah bukti nyata tanggung jawab sosial siswa.
                                    Kutipan 1: "**Inovasi ini adalah bentuk tanggung jawab sosial anak bangsa**, menggunakan teknologi untuk melindungi sesama."
                                    Kutipan 2: "**Teknologi adalah alat, tetapi empati adalah *driver*-nya**; pastikan karya kalian selalu bermanfaat bagi kemanusiaan."',
                'date' => '2025-01-27',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 2,
                'title' => 'Uji Coba Sistem Irigasi Otomatis Tenaga Surya di Kebun Sekolah',
                'file' => 'kegiatan/dummy/dummyPrestasiLomba2.png',
                'description' => 'Tim siswa dari jurusan Teknik Elektro berhasil menyelesaikan dan menguji coba sistem irigasi otomatis yang ditenagai sepenuhnya oleh energi surya. Sistem ini dipasang di kebun praktik sekolah dan mampu mengatur jadwal penyiraman berdasarkan kelembaban tanah, sehingga meminimalkan pemborosan air. Penggunaan panel surya menjadikan sistem ini 100% **mandiri energi** dan ramah lingkungan.

                                    Inovasi ini tidak hanya menjadi alat belajar praktis bagi siswa elektro, tetapi juga menyumbang pada upaya konservasi energi dan air sekolah. Proyek ini membuktikan bahwa solusi teknologi dapat diimplementasikan secara sederhana dan biaya rendah. Hasil uji coba menunjukkan efisiensi air mencapai 30% dibandingkan metode manual.

                                    Langkah selanjutnya adalah pengembangan antarmuka monitoring berbasis web agar pihak sekolah dapat mengontrol sistem dari jarak jauh.
                                    Kutipan 1: "**Pemanfaatan energi terbarukan adalah langkah menuju Indonesia yang lebih sejahtera** dan mandiri secara energi."
                                    Kutipan 2: "**Setetes air yang dihemat adalah investasi**; inovasi harus selalu berlandaskan pada keberlanjutan sumber daya."',
                'date' => '2025-01-28',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 2,
                'title' => 'Pameran Karya Seni Digital NFT oleh Siswa DKV',
                'file' => 'kegiatan/dummy/dummyPrestasiLomba3.png',
                'description' => 'Siswa Desain Komunikasi Visual (DKV) mengadakan pameran khusus untuk memamerkan koleksi karya seni digital mereka yang telah dicetak dan dipasarkan sebagai Non-Fungible Tokens (NFT). Pameran ini bertujuan memperkenalkan siswa pada **ekonomi digital** dan teknologi *blockchain* sebagai platform baru untuk menjual karya seni. Karya yang dipamerkan meliputi ilustrasi, animasi pendek, dan desain grafis.

                                    Kegiatan ini menunjukkan adaptasi kurikulum DKV terhadap tren teknologi terkini dan mendorong siswa menjadi kreator konten yang *melek* pasar global. Beberapa karya bahkan berhasil terjual di marketplace NFT, memberikan pengalaman nyata kepada siswa tentang monetisasi aset digital. Ini adalah lompatan besar dalam pendidikan seni.

                                    Pameran ini mendapat sambutan positif dari komunitas seni lokal. Siswa didorong untuk terus bereksplorasi antara seni tradisional dan digital.
                                    Kutipan 1: "**Ini adalah masa depan digital**; jangan berhenti berkarya dan berinovasi dengan menguasai platform teknologi terbaru."
                                    Kutipan 2: "**Seni adalah abadi**, dan NFT adalah cara baru untuk memastikan nilai dan otentisitas karya digital kalian."',
                'date' => '2025-01-29',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 2,
                'title' => 'Pengembangan Modul Pelatihan Bahasa Pemrograman Python untuk Pemula',
                'file' => 'kegiatan/dummy/dummyPrestasiLomba4.png',
                'description' => 'Siswa-siswi dari *Coding Club* sekolah mengambil inisiatif untuk mengembangkan Modul Pelatihan Bahasa Pemrograman Python yang mudah dipahami dan aplikatif, dikhususkan untuk pemula, khususnya siswa SMP mitra. Modul ini mencakup dasar-dasar sintaks, struktur data, hingga proyek sederhana seperti kalkulator. Inisiatif ini lahir dari semangat untuk berbagi pengetahuan dan meningkatkan **literasi digital** di kalangan pelajar.

                                    Pengembangan modul ini melatih kemampuan pedagogis dan kepemimpinan siswa. Mereka juga bertanggung jawab untuk menggelar *workshop* dan *mentoring* menggunakan modul tersebut. Proyek ini adalah bentuk nyata pengabdian siswa kepada masyarakat melalui keahlian teknologi.

                                    Modul ini akan diserahkan secara gratis kepada sekolah-sekolah mitra. Program ini adalah kontribusi langsung sekolah dalam menyiapkan sumber daya manusia yang unggul di bidang TIK.
                                    Kutipan 1: "**Menguatkan rasa nasionalisme melalui literasi digital**; kita tidak hanya belajar, tetapi juga mengajar dan berbagi ilmu."
                                    Kutipan 2: "**Pengetahuan adalah kekuatan**, dan membagikannya adalah cara terbaik untuk melipatgandakan dampak positif kalian."',
                'date' => '2025-01-29',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_admin' => 1,
                'type' => 2,
                'title' => 'Presentasi Inovasi Aplikasi *E-Counseling* untuk BK Sekolah',
                'file' => 'kegiatan/dummy/dummyPrestasiLomba5.png',
                'description' => 'Inovasi terakhir yang dipresentasikan adalah Aplikasi *E-Counseling* yang dirancang untuk memudahkan siswa dalam mengakses layanan Bimbingan dan Konseling (BK) sekolah. Aplikasi ini memungkinkan siswa membuat janji temu secara daring, mengakses materi kesehatan mental, dan mengirimkan keluhan atau masukan secara **anonim**. Fitur anonimitas ini bertujuan menekan stigma dan mendorong siswa lebih terbuka.

                                    Proyek ini merupakan kolaborasi antara siswa RPL dan Guru BK, yang menyediakan perspektif psikologis dan kebutuhan pengguna. Aplikasi ini diharapkan menjadi alat pendukung yang efektif dalam menjaga **kesehatan mental** siswa di tengah tekanan akademis. Uji coba beta menunjukkan peningkatan signifikan dalam partisipasi siswa terhadap layanan BK.

                                    Aplikasi ini direncanakan akan diimplementasikan penuh di seluruh sekolah pada semester berikutnya. Ini menunjukkan komitmen sekolah untuk menciptakan lingkungan belajar yang mendukung secara akademik maupun mental.
                                    Kutipan 1: "**Wujudkan Indonesia yang lebih adil dan sejahtera** dengan mendukung setiap individu mencapai potensi penuhnya, termasuk kesehatan mental."
                                    Kutipan 2: "**Kesejahteraan mental adalah fondasi prestasi**, dan teknologi harus menjadi jembatan menuju layanan yang lebih inklusif dan mudah diakses."',
                'date' => '2025-01-29',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
