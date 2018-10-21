#!/bin/bash

cd /www/master/

git pull

psql -h ${db_host} -U ${db_user} -d ${db_table} < ./data/db.sql