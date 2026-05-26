# Database setup after cloning

1. Export your existing MySQL database to `database/seed.sql`.
   - Using mysqldump:

     mysqldump -u username -p database_name > database/seed.sql

   - Or export via phpMyAdmin and save as `database/seed.sql`.

2. Place `database/seed.sql` in the repository root `database/` folder.

3. Run migrations (if you have migrations already in `app/Database/Migrations`):

```bash
php spark migrate
```

4. Run the seeder to import the SQL dump:

```bash
php spark db:seed ImportSqlSeeder
```

5. (Optional) On Windows you can run `scripts/setup_db.bat` to perform steps 3–4.

Notes:

- This project includes `app/Database/Seeds/ImportSqlSeeder` which reads `database/seed.sql` and executes SQL statements.
- For full reproducibility it's best to provide both migrations (schema) and seed SQL (data). If you want, provide DB credentials and I can attempt to generate migrations from your live database.
