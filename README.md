# SmartPark – Parking Management Application

## Overview

SmartPark adalah aplikasi manajemen parkir berbasis web yang mendukung **walk-in parking** dan **booking parking** secara real-time. Aplikasi ini dirancang dengan fokus pada skalabilitas, kejelasan API, dan kemudahan integrasi frontend–backend.

Dokumen ini menjelaskan **alur kerja (workflow)** dan **alasan teknis (why)** di balik setiap keputusan arsitektur, teknologi, dan desain API yang digunakan.

---

## 1. Architecture & Database Design

### 1.1 Application Architecture

SmartPark menggunakan arsitektur **Client–Server (SPA + REST API)**:

```
[ React Frontend ]
        |
        |  HTTP (JSON, REST API)
        v
[ Laravel Backend API ]
        |
        v
[ MySQL Database ]
```

**Penjelasan:**

* **Frontend (React)** bertugas menangani UI, state user, dan interaksi pengguna.
* **Backend (Laravel)** berperan sebagai REST API, menangani business logic, validasi, autentikasi, dan transaksi database.
* **Database (MySQL)** menyimpan data secara terstruktur dan relasional.

Pendekatan ini dipilih agar:

* Frontend dan backend dapat dikembangkan secara independen.
* Mudah dikembangkan menjadi mobile app di masa depan.
* Lebih aman karena business logic terpusat di backend.

---

### 1.2 Database Schema

#### Database Diagram (Simplified)

```
users
-----
id (PK)
name
email
password
role
created_at
updated_at

parking_lots
-------------
id (PK)
name
location
capacity
available_spots
created_at
updated_at

parking_spots
---------------
id (PK)
parking_lot_id (FK)
spot_number
status (available | reserved | occupied)
created_at
updated_at

parking_books
--------------
id (PK)
user_id (FK)
parking_spot_id (FK)
status (booked | active | finished | cancelled)
start_at
expired_at
created_at
updated_at
```

#### Relationship Explanation

* **users → parking_books**: One-to-Many
  Satu user dapat memiliki banyak booking parkir.

* **parking_lots → parking_spots**: One-to-Many
  Satu area parkir memiliki banyak spot parkir.

* **parking_spots → parking_books**: One-to-Many
  Satu spot parkir dapat memiliki riwayat booking.

Desain ini memungkinkan:

* Pemisahan jelas antara area parkir dan spot.
* Fleksibilitas untuk booking maupun walk-in.
* Perhitungan ketersediaan parkir secara efisien.

---

## 2. Technology Choices

### 2.1 Tech Stack

* **Backend**: Laravel 11 (PHP)
* **Frontend**: React JS
* **Database**: MySQL
* **API Style**: RESTful API
* **Authentication**: Token-based (Sanctum / JWT-style)
* **State Management (Frontend)**: React Context / Hooks

---

### 2.2 Justification

#### Backend – Laravel

Dipilih karena:

* Struktur MVC yang jelas dan rapi.
* Eloquent ORM mempermudah query kompleks.
* Built-in fitur seperti validation, pagination, dan API Resource.
* Sangat cocok untuk API skala menengah–besar.

#### Database – MySQL

* Relational database yang stabil dan cepat.
* Cocok untuk data parkir yang saling berelasi.
* Mudah di-maintain dan di-host.

#### Frontend – React

* SPA (Single Page Application) → UX lebih cepat.
* Komponen reusable.
* Mudah diintegrasikan dengan REST API.

#### State Management

* Menggunakan Context & Hooks karena:

  * Kompleksitas aplikasi masih manageable.
  * Lebih ringan dibanding Redux.

---

## 3. API Design

### 3.1 API Style

API menggunakan pendekatan **RESTful**:

* Resource-based URL
* HTTP Method sesuai fungsi
* Response JSON konsisten

---

### 3.2 Main API Endpoints

#### Parking Lots

**GET /api/parking-lots**
Get list parking lots (pagination, search, filter)

Query Params:

```json
{
  "perPage": 10,
  "search": "mall",
  "status": "available"
}
```

Response:

```json
{
  "data": [
    {
      "id": 1,
      "name": "Mall Parking",
      "capacity": 100,
      "available_spots": 25
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 5
  }
}
```

---

#### Parking Spots

**GET /api/parking-lots/{id}/spots**
Get parking spots by parking lot

Response:

```json
{
  "parkingSpot": {
    "data": [
      {
        "id": 1,
        "spot_number": "A-01",
        "status": "available"
      }
    ]
  },
  "summary": {
    "total": 100,
    "available": 25,
    "occupied": 60,
    "reserved": 15
  }
}
```

---

#### Parking Book

**POST /api/parking-books**
Create parking booking

Payload:

```json
{
  "parking_spot_id": 5,
  "start_at": "2026-01-30 10:00:00",
  "expired_at": "2026-01-30 12:00:00"
}
```

---

## 4. Results & Error Handling Analysis

### 4.1 Error Handling

* **401 Unauthorized** → user belum login
* **403 Forbidden** → role tidak memiliki akses
* **422 Validation Error** → payload tidak valid
* **404 Not Found** → data tidak ditemukan

Laravel validation dan exception handler digunakan agar response konsisten.

---

### 4.2 Tantangan Teknis Terbesar

Tantangan teknis terbesar adalah merancang dan mengimplementasikan logika pemesanan yang robust.

Pemesanan parkir bukanlah proses CRUD sederhana. Sistem ini melibatkan berbagai kendala dan aturan dunia nyata, seperti:

- Pengguna tidak dapat memesan atau memarkir kendaraan lebih dari sekali dalam satu hari yang sama  
- Parkir langsung (*walk-in*) memiliki perilaku berbeda dibanding pemesanan terjadwal  
- Status slot parkir harus tercermin secara *real-time* (tersedia, dipesan, terisi)  
- Masa berlaku pemesanan harus ditangani secara akurat  
- Konsistensi ketersediaan lahan parkir harus terjaga dalam segala kondisi  

**Solusi yang Diterapkan:**  
Logika bisnis dipusatkan dalam kelas layanan (*service classes*) dengan struktur yang terencana, mencakup:
- Alur kondisional yang komprehensif  
- Validasi menyeluruh ke basis data  
- Pembaruan transaksional untuk menjaga integritas data  
Pendekatan ini menjamin konsistensi data dan mencegah terjadinya status tidak valid dalam sistem.

---

### 4.3 Rencana Pengembangan (Jika Diberikan Waktu Tambahan Satu Minggu)

Berikut peningkatan yang direncanakan untuk iterasi berikutnya:

#### Fitur Pemesanan yang Diperluas
- Durasi pemesanan yang fleksibel  
- Multiple slot pemesanan per pengguna (dengan aturan khusus)  

#### Manajemen Kedaluwarsa Otomatis
- Sistem penjadwal (*scheduler*) untuk membatalkan otomatis pemesanan yang belum dibayar atau tidak digunakan  

#### Peningkatan UI/UX
- Status pemuatan (*loading states*) yang informatif  
- Alur pemesanan yang intuitif dan jelas  
- Responsivitas antarmuka yang dioptimalkan untuk semua perangkat  

#### Integrasi Sistem Pembayaran
- Pembayaran digital untuk pemesanan  
- Perhitungan biaya parkir dinamis berdasarkan durasi  

#### Manajemen Slot Parkir Lanjutan
- Slot VIP dengan fasilitas khusus  
- Zona khusus (difabel, muatan besar, dll.)  
- Skema harga berbeda berdasarkan jenis slot dan lokasi  

---

## 5. Reproducibility (Mandatory)

### 5.1 Dependencies

#### Backend (Laravel)

```json
{
  "require": {
    "laravel/framework": "^11.0"
  }
}
```

#### Frontend (React)

```json
{
  "dependencies": {
    "react": "^18.x",
    "react-router-dom": "^6.x",
    "axios": "^1.x"
  }
}
```

---

### 5.2 How to Run

#### 1. Clone Repository

```bash
git clone https://github.com/NabilKevin/SmartPark
```

#### 2. Backend Setup

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
```

Set environment variables (DB, APP_URL).

#### 3. Run Migration & Seeder

```bash
php artisan migrate --seed
```

#### 4. Start Backend Server

```bash
php artisan serve
```

---

#### 5. Frontend Setup

```bash
cd frontend
npm install
npm run dev
```

---

## Conclusion

SmartPark dirancang dengan prinsip **clean architecture**, **scalable API**, dan **maintainable code**. Seluruh keputusan teknis diambil untuk memastikan aplikasi mudah dikembangkan di masa depan dan tetap efisien dalam penggunaan sumber daya.
