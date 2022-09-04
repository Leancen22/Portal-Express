. create-backup.sh

rm -rf web/sites/default/files/*
tar -xf backups/prod/files.tar.gz -C ./

echo " >> Borrando base de datos"
drush sql-drop --yes

echo " >> Cargando base de datos"
drush sqlq --file=/var/www/html/backups/prod/db.sql
drush cr

echo " >> Ejecutando updates"
drush updb --yes
drush locale-check
drush locale-update
drush cr




