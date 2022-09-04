./vendor/bin/drush cex --yes

DIR=backups/local/$(date '+%d-%m-$Y__%H-%M-%S')
mkdir -p $DIR

./vendor/bin/drush sql:dump > ${DIR}/db.sql
tar -zcf ${DIR}/files.tar.gz web/sites/default/files
