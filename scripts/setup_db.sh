#!/bin/sh
php spark migrate
php spark db:seed ImportSqlSeeder
echo "Database setup finished."
