#!/bin/bash

cd /www/dev/

git pull

psql -h $DB_HOST -U $DB_USER -d $DB_NAME < ./data/db.sql