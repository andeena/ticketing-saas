# SaaS Helpdesk / Ticketing System Multi-Tenant

## Deskripsi Proyek
Proyek ini merupakan implementasi **Software as a Service (SaaS)** berupa **Helpdesk / Ticketing System** yang dirancang dan dibangun untuk mendukung proses pelaporan serta penanganan masalah atau permintaan bantuan teknis. Sistem ini berjalan secara **on-premise** menggunakan **sistem operasi Linux** dan memanfaatkan **platform open-source**.

Aplikasi dirancang dengan konsep **multi-tenancy**, di mana satu platform dapat digunakan oleh banyak organisasi (tenant) secara bersamaan dengan **isolasi data yang aman** antar tenant. Setiap laporan direpresentasikan sebagai *ticket* yang memiliki status dan dapat dikelola oleh admin atau petugas IT.

---

## Tujuan Proyek
Tujuan dari proyek ini adalah:
- Menerapkan konsep **cloud computing** dalam bentuk SaaS
- Mengimplementasikan **multi-tenancy** pada aplikasi berbasis web
- Mengintegrasikan **pipeline CI/CD open-source** untuk otomasi pengembangan
- Menjalankan aplikasi secara **on-premise** sesuai standar arsitektur cloud
- Memberikan pemahaman praktis terkait DevOps dan cloud architecture

---

## Fitur Utama
- Registrasi dan login tenant
- Manajemen user dengan role (Admin dan User)
- Pembuatan dan pengelolaan ticket
- Status ticket (Open, In Progress, Closed)
- Dashboard user dan admin
- Isolasi data antar tenant
- Otomatisasi build dan deployment melalui CI/CD

---

## Konsep Multi-Tenancy
Sistem menggunakan pendekatan **shared database dengan tenant isolation**, di mana setiap data disimpan dengan identitas tenant (`tenant_id`).  
Hal ini memastikan bahwa:
- Data antar organisasi tidak saling tercampur
- Setiap tenant hanya dapat mengakses data miliknya sendiri
- Sistem tetap efisien dan mudah dikembangkan

---

## Arsitektur Sistem
Arsitektur sistem terdiri dari:
- Aplikasi web (backend dan frontend)
- Database terpusat
- Container runtime menggunakan Docker
- CI/CD pipeline untuk otomatisasi build dan deployment

Sistem dirancang mengikuti prinsip **Cloud Computing Reference Architecture (CCRA - NIST)**.

---

## Teknologi yang Digunakan
- **Sistem Operasi**: Linux
- **Backend**: Laravel / Node.js (disesuaikan implementasi)
- **Database**: PostgreSQL
- **Containerization**: Docker & Docker Compose
- **CI/CD**: Jenkins (open-source) atau Github Action (?)
- **Version Control**: Git

---

## CI/CD Pipeline
Pipeline CI/CD diintegrasikan untuk mendukung proses pengembangan berkelanjutan dengan alur sebagai berikut:
1. Developer melakukan push kode ke repository
2. Jenkins secara otomatis menjalankan pipeline
3. Aplikasi dibangun menjadi Docker image
4. Container dideploy ulang ke environment on-premise

Pipeline ini memastikan proses deployment berjalan **otomatis, konsisten, dan minim kesalahan**.

---

## Cara Menjalankan Aplikasi (Secara Umum)
1. Pastikan Docker dan Docker Compose terinstal
2. Clone repository proyek
3. Jalankan perintah:
   ```bash
   docker compose up --build
