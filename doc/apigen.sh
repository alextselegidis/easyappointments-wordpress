#!/bin/bash
rm -rf "apigen"
php apigen.phar generate -s "../src" -d "apigen" --exclude "*ea-src*" --todo --template-theme "bootstrap"