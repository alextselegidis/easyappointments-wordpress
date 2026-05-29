#!/bin/bash

# Read version from plugin header
VERSION=$(grep -m1 '^\s*\*\s*Version:' easyappointments.php | sed 's/.*Version:\s*//' | tr -d '[:space:]')

ZIP_NAME="easyappointments-wordpress-${VERSION}.zip"

# Remove previous build artifacts
[ -e "$ZIP_NAME" ] && rm "$ZIP_NAME"

find . -name ".DS_Store" -delete

# Zip Files

zip -r "$ZIP_NAME" . \
    -x '.git/*' \
    -x '.git' \
    -x '.gitignore' \
    -x 'composer.lock' \
    -x 'README.md' \
    -x '*.zip'
