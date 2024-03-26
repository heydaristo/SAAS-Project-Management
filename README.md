
# POLA (Project Management For Freelance)

This project is one of the internship / pkl assignments at Techarea


## Authors

- [@attaf-riski](https://github.com/attaf-riski/)
- [@heydaristo](https://github.com/heydaristo/)

## .env File

You can use the basic .env from Laravel and don't forget to add mailtrap and mitrans

## Installation

Clone the project to u pc or laptop

```bash
git clone https://github.com/heydaristo/SAAS-Project-Management
cd SAAS-Project-Management/
```

Make your .env file in text editor
```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:5DuG5IHNaUea8nc44q9E4h7TBD1ztWfvhu8HPDnKtQA=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=SAASFreelanceProjectManagement
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

MIDTRANS_SERVER_KEY=""
MIDTRANS_CLIENT_KEY=""
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANDBOX=true
MIDTRANS_IS_3DS=true

DEFAULT_TERM="
<p>Pekerjaan terbaik berasal dari hubungan yang baik. Kejujuran, rasa hormat, dan rasa syukur adalah kunci dari hubungan yang baik dan oleh karena itu kita tertarik untuk saling memperlakukan satu sama lain dengan nilai-nilai ini setiap saat. Sebanyak dokumen-dokumen hukum penting, yang benar-benar mengikat kita adalah dorongan kita untuk melakukan pekerjaan hebat dengan orang-orang hebat dan untuk mengembangkan hubungan saling menghormati dan saling percaya.</p>

<h3>Acceptances </h3>

<p>Perwakilan yang ditandatangani dari Klien memiliki wewenang untuk memasuki Perjanjian ini atas nama Klien. Klien setuju untuk bekerja sama dan memberikan Kontraktor dengan segala yang diperlukan untuk menyelesaikan Layanan sesuai dengan permintaan Kontraktor.

Kontraktor memiliki pengalaman dan kemampuan untuk melakukan semua yang disepakati Kontraktor untuk Klien dan akan melakukannya dengan profesional dan tepat waktu. Kontraktor akan berusaha memenuhi setiap batas waktu yang ditetapkan dan memenuhi harapan untuk Layanan sebaik mungkin.</p>

<h3>Warranty </h3>

<p>Kontraktor menjamin bahwa: (i) Layanan akan dilaksanakan dengan cara yang profesional dan cermat dan bahwa tidak satupun dari Layanan tersebut atau bagian dari Perjanjian ini adalah atau akan tidak konsisten dengan setiap kewajiban yang mungkin dimiliki Kontraktor terhadap pihak lain; (ii) tidak satupun dari Layanan atau Penemuan atau pengembangan apapun, penggunaan, produksi, distribusi atau eksploitasi dari itu akan melanggar, menyelewengkan atau melanggar hak kekayaan intelektual atau hak lainnya dari setiap orang atau entitas (termasuk, tanpa batasan, Kontraktor); (iii) Kontraktor memiliki hak penuh untuk memberikan Klien dengan tugas dan hak yang disediakan di sini; (iv) Kontraktor akan mematuhi semua hukum yang berlaku dalam melakukan Layanan dan (v) jika pekerjaan Kontraktor memerlukan lisensi, Kontraktor telah memperoleh lisensi tersebut dan lisensi tersebut berlaku sepenuhnya dan berlaku.

KECUALI YANG DITETAPKAN DALAM LAMPIRAN B INI, KONTRAKTOR MENYATAKAN TIDAK ADA DAN SEMUA JAMINAN, APA PUN YANG DITETAPKAN ATAU DIIMPLIKASIKAN, TERMASUK TETAPI TIDAK TERBATAS PADA JAMINAN DAGANG, KELAYAKAN UNTUK TUJUAN TERTENTU, KESESUAIAN, KELENGKAPAN, ATAU HASIL YANG AKAN DIHASILKAN DARI PEKERJAAN.

KECUALI YANG DITETAPKAN DI SINI, SEMUA PENGIRIMAN DIKIRIM DALAM KEADAAN 'SEBAGAIMANA ADANYA'.</p>

<h3>Confidentiality & Non-Disclosure</h3>

<p>Masing-masing pihak harus menjaga, dengan kerahasiaan yang ketat, semua Informasi Rahasia (seperti didefinisikan dalam kalimat berikut) dari pihak lain. 'Informasi Rahasia' berarti semua (i) informasi nonpublik (pada saat pengungkapan) yang diungkapkan oleh satu pihak kepada pihak lain dalam Perjanjian ini, asalkan informasi tersebut ditandai atau diindikasikan oleh pihak yang mengungkapkannya sebagai rahasia; (ii) dan setiap informasi yang seharusnya dianggap sebagai rahasia dengan memperhatikan keadaan sekitar pengungkapan, baik informasi tersebut ditandai 'Rahasia' atau tidak.

Dalam hal suatu pihak diwajibkan untuk mengungkapkan Informasi Rahasia sesuai dengan perintah pengadilan atau pemerintah lainnya, pihak tersebut harus, sejauh yang diizinkan oleh hukum atau pendapat penasehat hukum, memberi pihak lain pemberitahuan yang cepat sebelum setiap pengungkapan sehingga pihak atau klien tersebut dapat mencari cara hukum lain untuk mempertahankan kerahasiaan Informasi Rahasia tersebut.

Setiap pihak yang menerima Informasi Rahasia bertanggung jawab atas setiap pelanggaran ketentuan ini yang disebabkan oleh karyawan, afiliasi, perwakilan atau agennya dan pihak tersebut setuju untuk mengganti rugi dan membebaskan dari segala tanggung jawab pihak lain dari dan terhadap segala kewajiban, klaim, kerugian, kerusakan, biaya dan pengeluaran yang timbul, secara langsung atau tidak langsung, dari setiap pelanggaran oleh suatu pihak, atau karyawan atau kontraktor independennya, dari ketentuan apapun dalam Perjanjian ini. Kewajiban dari Bagian ini akan bertahan setelah berakhirnya Perjanjian ini selama 3 tahun.</p>

<h3>Ownership and Licenses</h3>

<p>Kontraktor menyetujui bahwa pengiriman dan material yang dikembangkan sesuai dengan Perjanjian ini (termasuk, tanpa batasan, semua presentasi, tulisan, ide, konsep, desain, teks, rencana, dan materi lain yang Kontraktor pikirkan dan kembangkan sesuai dengan Perjanjian ini, termasuk semua material yang dimasukkan di dalamnya apakah material tersebut dipikirkan atau dibuat oleh Kontraktor secara individu atau bersama-sama, di dalam atau di luar tempat Klien, atau selama atau setelah jam kerja) akan diperlakukan seolah-olah pengembangan pengiriman tersebut merupakan 'karya sesuai dengan pesanan' dan akan dimiliki oleh Klien setelah pembayaran semua biaya yang jatuh tempo kepada Kontraktor sesuai dengan Perjanjian ini.

Jika suatu material dianggap bukan merupakan 'karya yang dibuat sesuai dengan pesanan,' Kontraktor dengan ini menyerahkan semua kepemilikan (baik diwakili atau tidak oleh paten yang terdaftar, hak cipta, rahasia dagang) dan hak milik atau hak lainnya, judul dan kepent

<h3>Kepemilikan dan Lisensi</h3>

<p>Kontraktor menyetujui bahwa pengiriman dan material yang dikembangkan sesuai dengan Perjanjian ini (termasuk, tanpa batasan, semua presentasi, tulisan, ide, konsep, desain, teks, rencana, dan materi lain yang Kontraktor pikirkan dan kembangkan sesuai dengan Perjanjian ini, termasuk semua materi yang dimasukkan di dalamnya apakah materi tersebut dipikirkan atau dibuat oleh Kontraktor secara individu atau bersama-sama, di dalam atau di luar tempat Klien, atau selama atau setelah jam kerja) akan diperlakukan seolah-olah pengembangan pengiriman tersebut merupakan 'pekerjaan atas pesanan' dan akan dimiliki oleh Klien setelah pembayaran semua biaya yang jatuh tempo kepada Kontraktor sesuai dengan Perjanjian ini.</p>

<p>Dalam hal materi tersebut dianggap bukan merupakan 'pekerjaan atas pesanan,' Kontraktor dengan ini menyerahkan semua kepemilikan (apakah diwakili atau tidak oleh paten terdaftar, hak cipta, rahasia dagang) dan hak milik atau hak lainnya, judul dan kepentingan dalam pengiriman dan material tersebut kepada Klien, dan menyetujui untuk menandatangani dokumen-dokumen yang diminta Klien secara wajar, untuk membantu Klien dalam memperoleh dan melindungi hak-hak tersebut.</p>

<p>Kontraktor setuju bahwa Kontraktor tidak memiliki kepentingan dalam materi apa pun yang diserahkan oleh Kontraktor kepada Klien, termasuk, tanpa batasan, setiap kepentingan keamanan di dalamnya, dan dengan ini melepaskan kepada Klien setiap kepentingan di dalamnya (jika ada) yang mungkin diciptakan oleh operasi hukum. Kecuali sebagaimana disetujui secara tertulis dan sebagaimana diperlukan dalam pelaksanaan Perjanjian ini, Kontraktor tidak akan memiliki hak untuk memberikan lisensi, menjual atau menggunakan pengiriman atau material yang dikembangkan dalam Perjanjian ini, atau bagian apa pun dari itu.</p>

<h3>Non-Solicit</h3>

<p>Kontraktor menyetujui bahwa selama periode di mana ia memberikan Layanan dan satu tahun setelahnya, Kontraktor tidak akan mendorong atau mengajak karyawan, vendor, klien, atau kontraktor Klien untuk meninggalkan Klien atas alasan apa pun.</p>

<h3>Hubungan Pihak</h3>

<p>Tidak ada yang terdapat dalam Perjanjian ini yang akan dianggap menciptakan kemitraan, gabungan atau usaha bersama, agen, atau hubungan kerja antara Kontraktor dan Klien. Kedua Pihak setuju bahwa Kontraktor adalah, dan sepanjang Perjanjian ini akan tetap, kontraktor independen.</p>

<h3>Waktu & Pemutusan</h3>

<p>Salah satu Pihak dapat mengakhiri Perjanjian ini kapan saja, dengan atau tanpa alasan, dengan pemberitahuan tertulis selama 7 hari.</p>

<p>Salah satu Pihak juga dapat mengakhiri Perjanjian kapan saja dengan segera jika: (i) pihak lain melakukan pelanggaran terhadap Perjanjian ini dan pihak tersebut tidak memperbaiki pelanggaran dalam waktu 5 hari setelah pemberitahuan tertulis dari pihak yang tidak melanggar mengenai pelanggaran tersebut.</p>

<p>Jika Perjanjian ini diakhiri lebih awal oleh Klien tanpa alasan, Klien setuju untuk membayar Kontraktor semua jumlah yang jatuh tempo dan harus dibayar untuk: (i) layanan yang diberikan pada tanggal pemutusan; dan (ii) biaya yang sudah dikeluarkan, termasuk dari komitmen non-batal yang terdokumentasi. Kontraktor setuju untuk menggunakan upaya terbaik untuk meminimalkan biaya dan pengeluaran tersebut.</p>

<p>Pemutusan atas alasan apa pun tidak akan memengaruhi hak-hak yang diberikan kepada Klien oleh Kontraktor di bawah ini. Setelah pemutusan, Klien harus membayar kepada Kontraktor semua jumlah yang jatuh tempo dan harus dibayar. Jika setelah pemutusan Klien tidak membayar biaya yang tidak disengketakan yang terutang untuk materi, pengiriman, atau Layanan yang disediakan oleh Kontraktor pada tanggal pemutusan, Klien setuju untuk tidak menggunakan materi tersebut atau produk Layanan tersebut, sampai Klien membayar Kontraktor sepenuhnya. Setiap ketentuan atau klausul dalam Kontrak ini yang, menurut bahasanya atau konteksnya, menyiratkan kelangsungan... </p>

<h3>Pembayaran</h3>

<p>Klien memahami pentingnya membayar kontraktor independen secara tepat waktu dan ingin mempertahankan hubungan kerja yang positif dengan Kontraktor untuk menjaga kelancaran proyek.</p>

<p>Pembayaran untuk setiap faktur yang disampaikan oleh Kontraktor kepada Klien jatuh tempo dalam waktu 15 hari setelah diterima. Dalam hal pembayaran terlambat, Kontraktor berhak menghentikan pekerjaan sampai pembayaran diterima.</p>

<h3>Keterlambatan Pembayaran</h3>

<p>Dalam hal suatu faktur tidak dibayar tepat waktu, sejauh yang diizinkan oleh hukum, Kontraktor akan menagih biaya keterlambatan sebesar 1,50% per bulan atas saldo yang jatuh tempo dan belum dibayarkan yang tidak dalam sengketa.</p>

<p>Penerimaan Kontraktor terhadap biaya layanan tersebut tidak mengabaikan hak-haknya terhadap pelanggaran Klien terhadap Perjanjian ini. Semua kewajiban pembayaran tidak dapat dibatalkan dan biaya yang dibayarkan tidak dapat dikembalikan.</p>

<h3>Penggantian Biaya</h3>

<p>Klien akan mengganti semua biaya yang wajar dan yang telah disetujui secara tertulis oleh Klien sebelumnya; harus dibayar dalam waktu 15 hari setelah penerimaan faktur terperinci.</p>
<h3>Penggantian Biaya</h3>

<p>Klien akan mengganti semua biaya yang wajar dan telah disetujui secara tertulis oleh Klien sebelumnya; dibayar dalam waktu 15 hari setelah penerimaan faktur terperinci.</p>

<h3>Perubahan</h3>

<p>Setiap perubahan materi terhadap Layanan, termasuk pekerjaan yang akan dilakukan dan biaya terkait, harus disetujui dengan persetujuan tertulis sebelumnya dari kedua belah pihak.</p>

<h3>Indemnifikasi dan Pembatasan Tanggung Jawab</h3>

<p>Kontraktor setuju untuk mengganti, membela, dan membebaskan Klien dari semua klaim, tindakan, kerusakan, dan kewajiban (tidak termasuk, tanpa batasan, biaya pengacara, biaya dan pengeluaran) yang timbul (i) melalui kelalaian kasar Kontraktor; (ii) dari klaim bahwa materi atau pengiriman, atau bagian dari itu, pada kenyataannya melanggar atau melanggar hak-hak milik pihak ketiga, termasuk namun tidak terbatas pada hak paten, hak cipta, dan rahasia dagang; atau (iii) dari pelanggaran atau dugaan pelanggaran dari perwakilan, jaminan, atau perjanjian Kontraktor di sini.

Klien setuju untuk mengganti, membela, dan membebaskan Kontraktor dari semua klaim, tindakan, kerusakan, kewajiban, biaya, dan pengeluaran (termasuk, tanpa batasan, biaya pengacara yang wajar) yang timbul dengan cara apa pun oleh kelalaian kasar Klien; (ii) dari klaim bahwa Klien menyediakan konten, atau bagian dari itu pada kenyataannya melanggar atau melanggar hak milik pihak ketiga, termasuk namun tidak terbatas pada hak paten, hak cipta, dan rahasia dagang; atau (iii) dari pelanggaran atau dugaan pelanggaran dari perwakilan, jaminan, atau perjanjian Klien di sini.

DALAM HAL YANG PALING DIPERBOLEHKAN OLEH HUKUM, KONTRAKTOR TIDAK AKAN BERTANGGUNG JAWAB KEPADA KLIEN UNTUK SETIAP KERUGIAN, KERUGIAN SELISIH, TIDAK LANGSUNG, KHUSUS, PIDANA ATAU KERUGIAN LAIN (TERMASUK KERUGIAN UNTUK LABA RUGI, KEGAGALAN USAHA ATAU YANG SEJENIS) YANG TIMBUL ATAU BERKAITAN DENGAN LAMPIRAN B INI ATAU PERJANJIAN INI, KINERJA KONTRAKTOR DI BAWAH INI ATAU GANGGUAN DARI APA YANG DITERIMA, MESKIPUN KLIEN TELAH DIBERITAHU TENTANG KEMUNGKINAN KERUGIAN TERSEBUT DAN TIDAK PEDULI PENYEBAB TINDAKAN, APAKAH BERASAL DARI KONTRAK, PERSELISIHAN, PELANGGARAN JAMINAN ATAU LAINNYA. SEJAUH YANG PALING DIPERBOLEHKAN OLEH HUKUM, TANGGUNG JAWAB KUMULATIF KONTRAKTOR DI BAWAH LAMPIRAN B INI DAN PERJANJIAN INI TIDAK AKAN MELEBIHI KOMPENSASI KUMULATIF YANG DIBAYAR OLEH KLIEN KE KONTRAKTOR DI BAWAH PERJANJIAN INI.</p>

<h3>Hak atas Kredit Penulis</h3>

<p>Kedua Pihak setuju bahwa ketika diminta, Klien harus dengan benar mengidentifikasi Kontraktor sebagai pencipta pengiriman. Klien tidak memiliki kewajiban proaktif untuk menampilkan nama Kontraktor bersama dengan pengiriman, tetapi Klien tidak boleh berupaya menyesatkan orang lain bahwa pengiriman tersebut dibuat oleh siapa pun selain Kontraktor.

Dengan ini Klien setuju Kontraktor dapat menggunakan produk kerja sebagai bagian dari portofolio dan situs web, galeri, dan media lainnya Kontraktor semata-mata untuk tujuan memamerkan karya Kontraktor tetapi tidak untuk tujuan lain.

Kontraktor tidak akan memublikasikan karya rahasia atau non-publik tanpa persetujuan tertulis sebelumnya dari Klien.</p>

<h3>Hukum yang Mengatur dan Penyelesaian Sengketa</h3>

<p>Perjanjian ini dan setiap sengketa yang timbul di bawahnya akan diatur oleh hukum yurisdiksi lokasi bisnis utama Kontraktor ('Yurisdiksi Kontraktor'), tanpa memperhatikan ketentuan konflik hukum tersebut. Untuk semua tujuan dari Perjanjian ini, Para Pihak menyetujui yurisdiksi eksklusif dan tempat di pengadilan yang berlokasi di yurisdiksi Kontraktor.

Kegagalan salah satu pihak untuk menegakkan hak-haknya di bawah Perjanjian ini kapan saja untuk jangka waktu apa pun tidak akan dianggap sebagai pengabaian terhadap hak-hak tersebut.</p>

<h3>Force Majeure</h3>

<p>Tidak ada kegagalan atau kelalaian oleh salah satu pihak dalam memenuhi kewajiban di bawah Perjanjian ini akan dianggap sebagai pelanggaran terhadap Perjanjian ini atau menciptakan kewajiban apa pun jika kegagalan atau kelalaian tersebut timbul dari satu atau beberapa alasan di luar kendali wajar dari pihak tersebut yang tidak dapat diatasi melalui upaya wajar pihak tersebut, misalnya, mogok, kerusuhan, perang, tindakan teroris, tindakan Tuhan, penyakit parah, invasi, kebakaran, ledakan, banjir, dan tindakan pemerintah atau lembaga atau instrumen pemerintah.</p>

<h3>Pemberitahuan</h3>

<p>Setiap pemberitahuan kepada salah satu Pihak yang dibuat sesuai dengan Perjanjian ini harus dibuat dan dikirim (i) melalui pos Amerika Serikat atau penyedia jasa pengiriman terkenal ke alamat lain Pihak yang tercatat; (ii) atau melalui surel ke wakil yang ditunjuk oleh Pihak lainnya. Setiap Pihak memiliki kewajiban independen untuk menyediakan dan memperbarui, sesuai kebutuhan, alamat pos dan surel yang tercatat untuk pemberitahuan tersebut. Pemberitahuan yang dikirim melalui surel akan dianggap efektif setelah dikirim jika tidak ada kesalahan atau 'pantulan balik' yang diterima dalam waktu dua puluh empat (24) jam dari pengiriman.</p>

<h3>Perilaku yang Tepat</h3>

<p>Klien dan Kontraktor akan berupaya mempertahankan hubungan profesional yang bebas dari pelecehan jenis apa pun dan dari perilaku lain yang tidak pantas atau tidak hormat. Jika kapan pun selama masa berlakunya Perjanjian ini Kontraktor percaya bahwa ia telah menjadi korban perilaku pelecehan dari pihak Klien atau staf Klien, Kontraktor akan segera memberitahukan Klien dan menuntut bahwa tindakan yang sesuai akan diambil untuk memperbaiki masalah tersebut. Jika perilaku yang dilaporkan terus berlanjut setelah pemberitahuan kedua Kontraktor, perilaku tersebut akan dianggap sebagai pelanggaran terhadap Perjanjian ini dan memberi hak kepada Kontraktor untuk mengakhiri Perjanjian ini sesuai dengan Klausul Jangka Waktu dan Pemutusan Perjanjian, dan dibayar penuh untuk proyek yang dipesan atau untuk jam layanan bulanan yang direncanakan, sesuai yang berlaku, tanpa membatasi hak atau penyelesaian lain yang tersedia bagi Kontraktor oleh hukum.</p>

<h3>Lainnya</h3>

<p>Bagian dan subbagian judul yang digunakan dalam Perjanjian ini hanya untuk kenyamanan dan tidak akan digunakan dalam menafsirkan Perjanjian ini. Kedua belah pihak telah memiliki kesempatan untuk meninjau Perjanjian ini dan tidak ada pihak yang akan dianggap sebagai pembuat Perjanjian ini untuk tujuan menafsirkan setiap kerancuan dalam Perjanjian ini. Para pihak menyetujui bahwa Perjanjian ini dapat ditandatangani dengan tanda tangan manual atau faksimili dan dalam beberapa salinan, masing-masing akan dianggap asli dan semua bersama-sama akan membentuk satu instrumen yang sama. Jika suatu ketentuan dalam Perjanjian ini ditentukan ilegal atau tidak dapat dilaksanakan, ketentuan tersebut akan direvisi terlebih dahulu untuk memberikan efek yang diizinkan maksimal pada tujuan aslinya atau, jika revisi tersebut tidak diizinkan, ketentuan khusus tersebut akan dihapus sehingga Perjanjian ini akan tetap berlaku dan dapat dilaksanakan sepenuhnya.</p>

<h3>Keseluruhan Kontrak</h3>

<p>Perjanjian ini, bersama dengan Lampiran B ini, dan setiap pameran, jadwal atau lampiran, antara Para Pihak menggantikan segala perjanjian sebelumnya, lisan atau tertulis, dan tidak dapat diubah dalam hal apa pun kecuali oleh perjanjian tertulis di masa depan yang ditandatangani oleh kedua belah pihak.</p>
"


```

Next, do a composer update using this method

```bash
composer update
```
If you have done the composer update, the next step is to prepare the database

note: don't forget to turn on apache and mysql services

```bash
php artisan migrate
```

Next, run the seeder to add the required data
```bash
php artisan db:seed Role
php artisan db:seed AllSeeder
```

When everything is done, then run this application as follows
```bash
php artisan serve
```
the application is running successfully, enjoy it!
