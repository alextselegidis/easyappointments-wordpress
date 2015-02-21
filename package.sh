#!/bin/bash
rm -rf dist
rm -f easyappointments-wp.zip
mkdir dist
cp -r src/** dist
cp LICENSE dist/LICENSE
cd dist
zip ../easyappointments-wp.zip *
cd ..
rm -rf dist