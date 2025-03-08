# Laravel User API

## 📌 Deskripsi Singkat
API CRUD untuk entitas User menggunakan Laravel dan MySQL. API ini mencakup validasi input, logging, dan pengujian dengan PHPUnit.

## 🚀 Instalasi

### **1. Clone Repository**
```sh
git clone <repository-url>
cd <project-folder>
```

### **2. Instal Dependensi**
```sh
composer install
```

### **3. Konfigurasi Lingkungan**
Salin file `.env.example` menjadi `.env` dan sesuaikan dengan konfigurasi database:
```sh
cp .env.example .env
```
Lalu, edit file `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=password
```

### **4. Generate Key & Migrasi Database**
```sh
php artisan key:generate
php artisan migrate --seed
```

### **5. Jalankan Server**
```sh
php artisan serve
```
API akan berjalan di: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 📌 Endpoint API
| Method | Endpoint        | Deskripsi |
|--------|----------------|-----------|
| GET    | `/api/users`   | Mendapatkan semua pengguna |
| GET    | `/api/users/{id}` | Mendapatkan pengguna berdasarkan ID |
| POST   | `/api/users`   | Menambahkan pengguna baru |
| PUT    | `/api/users/{id}` | Memperbarui data pengguna |
| DELETE | `/api/users/{id}` | Menghapus pengguna |


## 🛠 Pengujian dengan PHPUnit

### **1. Jalankan Pengujian**
Jalankan perintah berikut untuk menjalankan semua unit test:
```sh
php artisan test
```
Atau bisa juga menggunakan PHPUnit secara langsung:
```sh
vendor/bin/phpunit
```

### **2. Menjalankan Pengujian Tertentu**
Untuk menjalankan test pada satu file tertentu:
Misalnya:
```sh
vendor/bin/phpunit --filter UserTest
```

### **3. Menjalankan Pengujian dengan Coverage**
Untuk melihat cakupan kode yang diuji:
```sh
XDEBUG_MODE=coverage vendor/bin/phpunit --coverage-text
```

## 📌 Dokumentasi API dengan Swagger
1. Jalankan perintah berikut untuk membuat dokumentasi:
   ```sh
   php artisan l5-swagger:generate
   ```
2. Buka dokumentasi Swagger di:
   ```sh
   http://127.0.0.1:8000/api/documentation
   ```