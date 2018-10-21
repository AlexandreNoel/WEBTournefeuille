#!/bin/bash

cd /www/master/

git pull

psql -h ${db_host} -u ${db_user} -d ${db_table} < ./data/db.sql