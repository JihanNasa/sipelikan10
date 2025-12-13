#!/bin/bash

# Script untuk upload source code ke GitHub dengan clean overwrite
# Repo: https://github.com/JihanNasa/sipelikan10

set -e

echo "================================================"
echo "Upload Source Code ke GitHub - Sipelikan"
echo "================================================"
echo ""

# Warna untuk output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Validasi Git terinstall
if ! command -v git &> /dev/null; then
    echo -e "${RED}Error: Git tidak terinstall. Install terlebih dahulu.${NC}"
    exit 1
fi

# Input GitHub Personal Access Token
echo -e "${YELLOW}Masukkan GitHub Personal Access Token (PAT):${NC}"
read -s GITHUB_TOKEN
echo ""

if [ -z "$GITHUB_TOKEN" ]; then
    echo -e "${RED}Error: Token tidak boleh kosong${NC}"
    exit 1
fi

# Konfigurasi repository
GITHUB_USER="JihanNasa"
GITHUB_REPO="sipelikan10"
GITHUB_URL="https://${GITHUB_TOKEN}@github.com/${GITHUB_USER}/${GITHUB_REPO}.git"
BRANCH="main"

echo -e "${GREEN}Repository: https://github.com/${GITHUB_USER}/${GITHUB_REPO}${NC}"
echo ""

# Handle .env file
echo "================================================"
echo "Konfigurasi File .env"
echo "================================================"
echo ""
echo "Pilih opsi untuk file .env:"
echo "1) Gunakan file .env yang sudah ada"
echo "2) Buat file .env baru (input manual)"
echo ""
read -p "Pilihan (1/2): " ENV_CHOICE

case $ENV_CHOICE in
    1)
        if [ ! -f .env ]; then
            echo -e "${RED}Error: File .env tidak ditemukan di direktori ini${NC}"
            exit 1
        fi
        echo -e "${GREEN}Menggunakan file .env yang sudah ada${NC}"
        ;;
    2)
        echo ""
        echo "Masukkan konfigurasi .env (tekan Enter setelah setiap input):"
        echo ""
        
        read -p "APP_NAME [Sipelikan]: " APP_NAME
        APP_NAME=${APP_NAME:-Sipelikan}
        
        read -p "APP_ENV [production]: " APP_ENV
        APP_ENV=${APP_ENV:-production}
        
        read -p "APP_DEBUG [false]: " APP_DEBUG
        APP_DEBUG=${APP_DEBUG:-false}
        
        read -p "APP_URL [https://silaing-dev.jabarprov.go.id/sipelikan]: " APP_URL
        APP_URL=${APP_URL:-https://silaing-dev.jabarprov.go.id/sipelikan}
        
        echo ""
        read -p "DB_HOST [mysql]: " DB_HOST
        DB_HOST=${DB_HOST:-mysql}
        
        read -p "DB_PORT [3306]: " DB_PORT
        DB_PORT=${DB_PORT:-3306}
        
        read -p "DB_DATABASE [sipelikan_db]: " DB_DATABASE
        DB_DATABASE=${DB_DATABASE:-sipelikan_db}
        
        read -p "DB_USERNAME [sipelikan_user]: " DB_USERNAME
        DB_USERNAME=${DB_USERNAME:-sipelikan_user}
        
        read -sp "DB_PASSWORD: " DB_PASSWORD
        echo ""
        
        if [ -z "$DB_PASSWORD" ]; then
            echo -e "${RED}Error: DB_PASSWORD tidak boleh kosong${NC}"
            exit 1
        fi
        
        # Buat file .env
        cat > .env << EOF
APP_NAME="${APP_NAME}"
APP_ENV=${APP_ENV}
APP_KEY=
APP_DEBUG=${APP_DEBUG}
APP_URL=${APP_URL}

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="\${APP_NAME}"

JWT_SECRET=
EOF
        
        echo -e "${GREEN}File .env berhasil dibuat${NC}"
        ;;
    *)
        echo -e "${RED}Pilihan tidak valid${NC}"
        exit 1
        ;;
esac

echo ""

# Pastikan .gitignore ada dan .env tercantum
echo "Memastikan .env masuk ke .gitignore..."

if [ ! -f .gitignore ]; then
    echo "# Laravel" > .gitignore
fi

if ! grep -q "^\.env$" .gitignore; then
    echo ".env" >> .gitignore
    echo -e "${GREEN}.env ditambahkan ke .gitignore${NC}"
else
    echo -e "${GREEN}.env sudah ada di .gitignore${NC}"
fi

# Pastikan file-file penting tidak masuk .gitignore
if ! grep -q "^\.gitignore$" .gitignore 2>/dev/null; then
    echo "!.gitignore" >> .gitignore
fi

echo ""

# Inisialisasi Git jika belum
if [ ! -d .git ]; then
    echo "Inisialisasi Git repository..."
    git init
    git config user.name "${GITHUB_USER}"
    git config user.email "${GITHUB_USER}@users.noreply.github.com"
fi

# Backup file lokal penting (tidak di-commit)
echo "Backup file penting..."
cp .env .env.backup 2>/dev/null || true

# Hapus remote lama jika ada
git remote remove origin 2>/dev/null || true

# Tambah remote baru
echo "Menambahkan remote origin..."
git remote add origin "$GITHUB_URL"

# Fetch data dari remote
echo "Mengambil data dari GitHub..."
git fetch origin

# Hapus branch lokal main jika ada
git branch -D main 2>/dev/null || true

# Buat branch baru yang orphan (tidak ada history)
echo "Membuat branch baru (clean overwrite)..."
git checkout --orphan main

# Stage semua file kecuali yang ada di .gitignore
echo "Menambahkan file ke staging..."
git add -A

# Commit
echo "Melakukan commit..."
git commit -m "Clean overwrite - $(date '+%Y-%m-%d %H:%M:%S')"

# Force push ke GitHub (hapus semua file lama)
echo ""
echo -e "${YELLOW}Melakukan force push ke GitHub...${NC}"
echo -e "${YELLOW}Ini akan menghapus SEMUA file lama di repository!${NC}"
read -p "Lanjutkan? (y/n): " CONFIRM

if [ "$CONFIRM" != "y" ] && [ "$CONFIRM" != "Y" ]; then
    echo -e "${RED}Upload dibatalkan${NC}"
    exit 1
fi

git push -f origin main

# Restore file backup
if [ -f .env.backup ]; then
    mv .env.backup .env
fi

echo ""
echo -e "${GREEN}================================================${NC}"
echo -e "${GREEN}Upload Berhasil!${NC}"
echo -e "${GREEN}================================================${NC}"
echo ""
echo "Repository: https://github.com/${GITHUB_USER}/${GITHUB_REPO}"
echo "Branch: ${BRANCH}"
echo ""
echo -e "${YELLOW}CATATAN PENTING:${NC}"
echo "- File .env TIDAK di-upload ke GitHub (sudah di .gitignore)"
echo "- Simpan file .env untuk deployment di server"
echo "- File .env berisi kredensial database yang TIDAK BOLEH di-commit"
echo ""
echo "Langkah selanjutnya:"
echo "1. Clone repository di server: ubuntu@DKP-Silaing:~$"
echo "2. Copy file .env ke direktori project"
echo "3. Jalankan docker-compose up -d"
echo "4. Jalankan perintah setup (lihat note dev.txt)"
echo ""