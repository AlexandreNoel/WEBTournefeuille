#!/bin/bash

echo Copy frontend files...
rsync -v -r --delete-after $TRAVIS_BUILD_DIR/front/dist/ ensiie@51.38.237.240:/var/www/html/

echo Copy backend files...
rsync -v $TRAVIS_BUILD_DIR/back/vendor/autoload.php ensiie@51.38.237.240:/var/www/api/vendor/
rsync -v -r --delete-after $TRAVIS_BUILD_DIR/back/vendor/composer/ ensiie@51.38.237.240:/var/www/api/vendor/composer/
rsync -v -r --delete-after $TRAVIS_BUILD_DIR/back/public/ ensiie@51.38.237.240:/var/www/api/public/
rsync -v -r --delete-after $TRAVIS_BUILD_DIR/back/src/ ensiie@51.38.237.240:/var/www/api/src/

echo Copy sql file...
rsync -v $TRAVIS_BUILD_DIR/data/db.sql ensiie@51.38.237.240:/tmp/

echo Install db script
ssh ensiie@51.38.237.240 psql -f /tmp/db.sql
