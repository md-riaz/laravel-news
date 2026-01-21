#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
TEMP_DIR="${ROOT_DIR}/.laravel-tmp"

if [[ -f "${ROOT_DIR}/artisan" || -f "${ROOT_DIR}/composer.json" ]]; then
  echo "Laravel application already exists in ${ROOT_DIR}."
  echo "Install dependencies and required packages instead."
  exit 0
fi

if [[ -d "${TEMP_DIR}" ]]; then
  rm -rf "${TEMP_DIR}"
fi

mkdir -p "${TEMP_DIR}"

composer create-project laravel/laravel "${TEMP_DIR}" "^11.0"

for path in docs scripts; do
  if [[ -d "${ROOT_DIR}/${path}" ]]; then
    rm -rf "${TEMP_DIR:?}/${path}"
    cp -R "${ROOT_DIR}/${path}" "${TEMP_DIR}/${path}"
  fi
done

cp "${ROOT_DIR}/README.md" "${TEMP_DIR}/README.md"

rm -rf "${ROOT_DIR:?}"/*
shopt -s dotglob
mv "${TEMP_DIR}"/* "${ROOT_DIR}/"
shopt -u dotglob
rmdir "${TEMP_DIR}"

composer require filament/filament \
  spatie/laravel-medialibrary \
  spatie/laravel-responsecache \
  spatie/laravel-sitemap \
  spatie/schema-org \
  spatie/laravel-feed \
  laravel/scout \
  artesaos/seotools

composer require spatie/laravel-analytics --dev

echo "Laravel application bootstrapped. Update .env and run migrations."
