#!/bin/bash

rm /var/www/html/backup/*.tar.gz

fn=$(echo $RANDOM | md5sum | head -c 20).tar.gz

tar -cvzf /var/www/html/backup/$fn $( find $1 -name "*.php") $@


chown www-data:www-data /var/www/html/backup/*
chmod 755 /var/www/html/backup/*
