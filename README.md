# Sistem Informasi Koperasi Simpan Pinjam

**Project kelompok 10** Mata Kuliah Front  End & Back End

## Repository

https://github.com/aprilia213/koperasi-simpan-pinjam

## Teknologi

- Laravel 12
- PHP
- SQLite
- Vite

## Cara Menjalankan Project

### 1. Clone repository

```bash
git clone https://github.com/aprilia213/koperasi-simpan-pinjam.git
```

### 2. Masuk ke folder project

```bash
cd koperasi-simpan-pinjam
```

### 3. Install dependency

```bash
composer install
```

### 4. Salin file environment

Windows:

```bash
copy .env.example .env
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Jalankan server

```bash
php artisan serve
```

## Aturan Branch

| Anggota | Branch | Fitur |
|---------|--------|-------|
| Rahma | feat/auth | Login & Register |
| Anggota 2 | feat/crud-anggota | CRUD Anggota |
| Anggota 3 | feat/pinjaman | Transaksi Pinjaman |

## Workflow Git

1. Clone repository.
2. Buat branch fitur, misalnya:

```bash
git checkout -b feat/auth
```

3. Kerjakan fitur.
4. Commit perubahan.

```bash
git add .
git commit -m "Menambahkan fitur autentikasi"
```

5. Push branch.

```bash
git push -u origin feat/auth
```

6. Buat Pull Request dari branch `feat/...` ke `main`.

## Catatan

- Branch `main` hanya digunakan sebagai branch utama.
- Setiap fitur wajib dikerjakan pada branch masing-masing.
- Setelah fitur selesai, buat Pull Request ke `main`.