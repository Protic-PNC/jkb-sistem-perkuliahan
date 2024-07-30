# Sistem Informasi Perkuliahan (SIPerkuliahan)

## Deskripsi Proyek
SIPerkuliahan adalah sistem informasi yang mengelola data perkuliahan termasuk daftar hadir (attendance list) dan jurnal kuliah (journal). Sistem ini memiliki tiga peran utama: mahasiswa, dosen, dan super admin.

## Fitur Utama
- **Manajemen Mahasiswa**
- **Manajemen Dosen**
- **Manajemen Program Studi**
- **Manajemen Kelas Mahasiswa**
- **Manajemen Posisi/Jabatan Dosen**
- **Manajemen Mata Kuliah**
- **Manajemen Daftar Hadir**
- **Manajemen Jurnal Kuliah**

## Teknologi yang Digunakan
- **Laravel**: Framework PHP untuk pengembangan aplikasi web
- **Laravel Breeze**: Untuk otentikasi
- **Laravel Spatie**: Untuk manajemen peran dan izin
- **MySQL**: Basis data relasional
- **Tailwind CSS**: Framework CSS untuk desain antarmuka

## Instalasi
1. Clone repositori:
    ```sh
    git clone https://github.com/Protic-PNC/jkb-sistem-perkuliahan.git
    ```
2. Masuk ke direktori proyek:
    ```sh
    cd jkb-sistem-perkuliahan
    ```
3. Install dependensi:
    ```sh
    composer install
    npm install
    npm run dev
    ```
4. Salin file `.env`:
    ```sh
    cp .env.example .env
    ```
5. Generate key aplikasi:
    ```sh
    php artisan key:generate
    ```
6. Konfigurasi file `.env` sesuai dengan lingkungan pengembangan Anda.
7. Migrasi dan seeder database:
    ```sh
    php artisan migrate --seed
    ```
8. Jalankan server pengembangan:
    ```sh
    php artisan serve
    ```

## Penggunaan
### Peran
- **Mahasiswa**
  - Melihat daftar hadir
  - Mengonfirmasi kehadiran
- **Dosen**
  - Memasukkan data kehadiran mahasiswa
  - Mengonfirmasi jurnal kuliah
- **Super Admin**
  - Mengelola data mahasiswa, dosen, program studi, kelas mahasiswa, posisi, dan mata kuliah
  - Mengirimkan konfirmasi ke head departemen pada daftar hadir dan jurnal

## Login
- Menggunakan Laravel Breeze untuk otentikasi.
- Menggunakan Laravel Spatie untuk manajemen peran dan izin.
- Super admin dibuat menggunakan seeder.

## ERD (Entity Relationship Diagram)
Berikut adalah diagram hubungan antar tabel dalam sistem ini:

```mermaid
erDiagram
    USERS {
        id INT PK
        name VARCHAR
        avatar VARCHAR
        email VARCHAR
        email_verified_at TIMESTAMP
        password VARCHAR
        remember_token VARCHAR
        created_at TIMESTAMP
        updated_at TIMESTAMP
    }
    LECTURERS {
        id INT PK
        name VARCHAR
        number_phone INT
        address VARCHAR
        nidn INT
        nip INT
        user_id INT FK
        course_id INT FK
        position_id INT FK
        created_at TIMESTAMP
        updated_at TIMESTAMP
        deleted_at TIMESTAMP
    }
    STUDENTS {
        id INT PK
        nim INT
        name VARCHAR
        address VARCHAR
        number_phone INT
        user_id INT FK
        student_class_id INT FK
        created_at TIMESTAMP
        updated_at TIMESTAMP
        deleted_at TIMESTAMP
    }
    STUDY_PROGRAMS {
        id INT PK
        name VARCHAR
        created_at TIMESTAMP
        updated_at TIMESTAMP
        deleted_at TIMESTAMP
    }
    STUDENT_CLASSES {
        id INT PK
        name VARCHAR
        academic_year VARCHAR
        study_program_id INT FK
        created_at TIMESTAMP
        updated_at TIMESTAMP
        deleted_at TIMESTAMP
    }
    POSITIONS {
        id INT PK
        name VARCHAR
        created_at TIMESTAMP
        updated_at TIMESTAMP
        deleted_at TIMESTAMP
    }
    COURSES {
        id INT PK
        code VARCHAR
        name VARCHAR
        sks INT
        hours INT
        student_class_id INT FK
        created_at TIMESTAMP
        updated_at TIMESTAMP
        deleted_at TIMESTAMP
    }
    ATTENDENCE_LISTS {
        id INT PK
        code_al VARCHAR
        has_finished BOOLEAN
        has_acc_head_departement BOOLEAN
        lecturer_id INT FK
        course_id INT FK
        student_class_id INT FK
        created_at TIMESTAMP
        updated_at TIMESTAMP
        deleted_at TIMESTAMP
    }
    ATTENDENCE_LIST_DETAILS {
        id INT PK
        attendence_student VARCHAR
        course_status VARCHAR
        has_acc_student BOOLEAN
        has_acc_lecturer BOOLEAN
        student_id INT FK
        attendence_list_id INT FK
        created_at TIMESTAMP
        updated_at TIMESTAMP
        deleted_at TIMESTAMP
    }
    JOURNALS {
        id INT PK
        has_finished BOOLEAN
        has_acc_head_departement BOOLEAN
        lecturer_id INT FK
        course_id INT FK
        student_class_id INT FK
        created_at TIMESTAMP
        updated_at TIMESTAMP
        deleted_at TIMESTAMP
    }
    JOURNAL_DETAILS {
        id INT PK
        material VARCHAR
        has_acc_student BOOLEAN
        has_acc_lecturer BOOLEAN
        attendence_list_detail_id INT FK
        journal_id INT FK
        created_at TIMESTAMP
        updated_at TIMESTAMP
        deleted_at TIMESTAMP
    }

    USERS ||--|{ LECTURERS : has_one
    USERS ||--|{ STUDENTS : has_one
    LECTURERS }o--|| USERS : belongs_to
    LECTURERS }o--|| COURSES : belongs_to
    LECTURERS }o--|| POSITIONS : belongs_to
    STUDENTS }o--|| USERS : belongs_to
    STUDENTS }o--|| STUDENT_CLASSES : belongs_to
    STUDENT_CLASSES }o--|| STUDY_PROGRAMS : belongs_to
    COURSES }o--|| STUDENT_CLASSES : belongs_to
    ATTENDENCE_LISTS }o--|| LECTURERS : belongs_to
    ATTENDENCE_LISTS }o--|| COURSES : belongs_to
    ATTENDENCE_LISTS }o--|| STUDENT_CLASSES : belongs_to
    ATTENDENCE_LIST_DETAILS }o--|| ATTENDENCE_LISTS : belongs_to
    ATTENDENCE_LIST_DETAILS }o--|| STUDENTS : belongs_to
    JOURNALS }o--|| LECTURERS : belongs_to
    JOURNALS }o--|| COURSES : belongs_to
    JOURNALS }o--|| STUDENT_CLASSES : belongs_to
    JOURNAL_DETAILS }o--|| ATTENDENCE_LIST_DETAILS : belongs_to
    JOURNAL_DETAILS }o--|| JOURNALS : belongs_to
```

## Flowchart

Flowchart di bawah ini memberikan gambaran tentang alur kerja dalam Sistem Informasi Perkuliahan (SIPerkuliahan). Diagram ini menunjukkan bagaimana pengguna dengan peran berbeda (mahasiswa, dosen, dan super admin) berinteraksi dengan sistem dan mengelola data yang relevan.

```mermaid
flowchart TD
    A[Login] --> B[Dashboard]
    B --> C[Mahasiswa]
    B --> D[Dosen]
    B --> E[Super Admin]

    C --> F[Lihat Daftar Hadir]
    C --> G[Konfirmasi Kehadiran]

    D --> H[Masukkan Data Kehadiran]
    D --> I[Konfirmasi Jurnal Kuliah]

    E --> J[Kelola Data Mahasiswa]
    E --> K[Kelola Data Dosen]
    E --> L[Kelola Program Studi]
    E --> M[Kelola Kelas Mahasiswa]
    E --> N[Kelola Posisi/Jabatan Dosen]
    E --> O[Kelola Mata Kuliah]
    E --> P[Konfirmasi Kehadiran dan Jurnal]
```

## Kontribusi

Kami sangat mengapresiasi kontribusi dari komunitas untuk membuat proyek ini lebih baik. Jika Anda ingin berkontribusi, silakan ikuti langkah-langkah berikut:

1. Fork repositori ini.
2. Buat branch fitur baru (`git checkout -b fitur-anda`).
3. Commit perubahan Anda (`git commit -am 'Menambahkan fitur ABC'`).
4. Push ke branch (`git push origin fitur-anda`).
5. Buat Pull Request di GitHub.

Pastikan untuk menulis deskripsi yang jelas tentang perubahan yang Anda lakukan agar kami dapat memahami dan mengevaluasi kontribusi Anda dengan lebih baik. Jangan ragu untuk mendiskusikan ide atau masalah yang Anda hadapi di bagian Issues.

## Lisensi

Proyek ini dilisensikan di bawah MIT License. Untuk informasi lebih lanjut, silakan baca file [LICENSE](LICENSE).

