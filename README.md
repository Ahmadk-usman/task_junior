# Laravel Task Management API

## 📌 Pendahuluan

API ini dibuat menggunakan **Laravel 11** dengan **Sanctum** untuk autentikasi. API ini memungkinkan pengguna untuk **membuat, membaca, memperbarui, dan menghapus (CRUD) task** dengan autentikasi berbasis token.

---

## 🚀 Instalasi

### 1. Clone Repository

```sh
git clone https://github.com/username/repo.git
cd repo
```

### 2. Install Dependency

```sh
composer install
```

### 3. Konfigurasi Environment

Buat file `.env` dan atur konfigurasi database:

```sh
cp .env.example .env
```

Edit file `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Key & Jalankan Migrasi

```sh
php artisan migrate
```

### 5. Db seeder
```sh
php artisan db:seed

```


### 6. Jalankan Server

```sh
php artisan serve
```

---

## 🔑 Autentikasi API

API ini menggunakan **Laravel Sanctum** untuk autentikasi berbasis token.



### **1 Login User**

**Endpoint:** `POST /api/login`

```json
{
    "email": "user@example.com",
    "password": "password123"
}
```

**Response:**

```json
{
    "token": "YOUR_AUTH_TOKEN"
}
```

Gunakan **Bearer Token** untuk API yang membutuhkan autentikasi.

### **3 Logout User**

**Endpoint:** `POST /api/logout`

---

## 📌 Task Management API

### **1️⃣ Get All Tasks**

**Endpoint:** `GET /api/tasks`

### **2️⃣ Create Task**

**Endpoint:** `POST /api/tasks`

```json
{
    "title": "Belajar Laravel",
    "description": "Mengerjakan tugas Laravel",
    "status": "pending"
}
```

### **3️⃣ Get Task By ID**

**Endpoint:** `GET /api/tasks/{id}`

### **4️⃣ Update Task**

**Endpoint:** `PUT /api/tasks/{id}`

```json
{
    "title": "Update Judul",
    "description": "Update Deskripsi",
    "status": "in-progress"
}
```

### **5️⃣ Delete Task**

**Endpoint:** `DELETE /api/tasks/{id}`

---

## 🛠 Tools & Teknologi

-   **Laravel 11**
-   **MySQL**
-   **Laravel Sanctum** (Autentikasi Token)
-   **Postman** (Testing API)

---
