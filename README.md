# 📱💻 Sistem Pemesanan & Servis Elektronik (Laravel)

Aplikasi berbasis **Laravel** untuk mengelola **pemesanan produk elektronik** dan **layanan servis elektronik** secara terintegrasi. Sistem ini dirancang untuk memudahkan pelanggan melakukan pemesanan/servis serta membantu admin, karyawan, dan owner dalam mengelola data, transaksi, dan laporan secara profesional.

---

## 📸 Output

IMG SRC

---

## ✨ Fitur Utama

### 🔐 Autentikasi & Role

* Login multi-role (Admin, Karyawan, Owner)
* Password terenkripsi menggunakan **bcrypt (Laravel Hash)**
* Middleware keamanan berbasis role

### 🛒 Sistem Pemesanan

* Pemesanan produk elektronik
* Detail transaksi & riwayat pesanan
* Status pesanan (pending, diproses, selesai)

### 🛠️ Sistem Servis Elektronik

* Input data servis elektronik
* Tracking status servis
* Riwayat servis pelanggan

### 📦 Manajemen Produk & Stok

* CRUD produk
* Update stok barang
* Riwayat barang masuk & keluar (transparansi untuk owner)

### 📊 Dashboard

* Dashboard Admin (full access)
* Dashboard Karyawan (update data & stok)
* Dashboard Owner (read-only & laporan)

### 🧾 Laporan

* Cetak laporan transaksi
* Cetak laporan servis
* Export PDF

### 🌐 Landing Page

* Landing page informatif
* Hero section dengan background image
* Section layanan, produk, dan kontak
* Responsive (Bootstrap)

---

## 🧑‍💼 Role Pengguna

| Role         | Hak Akses                                                 |
| ------------ | --------------------------------------------------------- |
| **Admin**    | Kelola user, produk, stok, transaksi, servis, dan laporan |
| **Karyawan** | Update stok & data servis                                 |
| **Owner**    | Melihat laporan & riwayat stok (read-only)                |

---

## 🛠️ Teknologi yang Digunakan

* **Laravel**
* **PHP**
* **MySQL**
* **Bootstrap**
* **JavaScript / jQuery**
* **AOS, Swiper, Slick Slider**

---

## 📂 Struktur Folder (Ringkas)

```
project-root/
├── app/
├── database/
├── public/
│   └── lp/assets/   # asset landing page
├── resources/
│   └── views/
│       ├── auth/
│       ├── dashboard/
│       └── landing_page.php
├── routes/
│   └── web.php
└── README.md
```

---

## ⚙️ Instalasi & Menjalankan Project

### 1️⃣ Clone Repository

```bash
git clone https://github.com/username/nama-repository.git
cd nama-repository
```

### 2️⃣ Install Dependency

```bash
composer install
```

### 3️⃣ Copy File Environment

```bash
cp .env.example .env
```

### 4️⃣ Generate App Key

```bash
php artisan key:generate
```

### 5️⃣ Konfigurasi Database

Edit file `.env`

```env
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 6️⃣ Migrasi & Seeder

```bash
php artisan migrate --seed
```

### 7️⃣ Jalankan Server

```bash
php artisan serve
```

Akses di browser:

```
http://localhost:8000
```

---

## 🔐 Hash Password via Terminal

```bash
php artisan tinker
```

```php
Hash::make('password123');
```



---

## 📌 Catatan

* Pastikan folder `storage` dan `bootstrap/cache` memiliki permission write
* Gunakan database MySQL atau MariaDB

---

## 👨‍💻 Developer

Mohammad Fijar

**Email**: [fijarsepta123@gmail.com](mailto:fijarsepta123@gmail.com)

---

## 📄 Lisensi

Project ini dibuat untuk **pembelajaran & pengembangan sistem**.


