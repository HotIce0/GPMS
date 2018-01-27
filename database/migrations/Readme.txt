迁移操作
第一步 php artisan migrate --path=/database/migrations/table_creation
第二步 php artisan migrate --path=/database/migrations/forign_key_creation

回滚操作
第一步 php artisan migrate:rollback
第二步 php artisan migrate:rollback