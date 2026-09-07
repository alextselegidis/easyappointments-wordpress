#!/bin/bash

# Read version from plugin header
VERSION=$(grep -m1 '^\s*\*\s*Version:' easyappointments.php | sed 's/.*Version:\s*//' | tr -d '[:space:]')

ZIP_NAME="easyappointments-wordpress-${VERSION}.zip"

# Remove previous build artifacts
[ -e "$ZIP_NAME" ] && rm "$ZIP_NAME"

find . -name ".DS_Store" -delete

# Zip Files

# Ship only what WordPress actually runs.
#
# The assets directory holds the wordpress.org listing artwork (banner, screenshots, icon). Those
# live in the /assets/ directory of the plugin SVN repository, not in /trunk/, so shipping them here
# would only add a couple of megabytes to every download without WordPress ever reading them.
#
# The rest are repository housekeeping: community docs, editor and git config, this build script,
# and the root logo.png, which is a duplicate of admin/img/logo.png (the copy the admin page loads).
zip -r "$ZIP_NAME" . \
    -x '.git/*' \
    -x '.git' \
    -x '.gitignore' \
    -x 'assets/*' \
    -x 'assets' \
    -x '.github/*' \
    -x '.github' \
    -x '.editorconfig' \
    -x '.gitattributes' \
    -x 'build.sh' \
    -x 'logo.png' \
    -x 'composer.lock' \
    -x 'README.md' \
    -x '*.zip'
