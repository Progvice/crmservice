#!/bin/bash
set -e

CONFIG_FILE="/var/www/html/app/config.json"
EXAMPLE_FILE="/var/www/html/app/config-example.json"

# Create config.json only if missing
if [ ! -f "$CONFIG_FILE" ]; then
    cp "$EXAMPLE_FILE" "$CONFIG_FILE"
    echo "Created config.json from example."

    until php -r "new PDO('mysql:host=$DB_HOST;dbname=$DB_NAME', '$DB_USER', '$DB_PASS');" 2>/dev/null; do
        echo "Database not ready yet. Waiting 2 seconds..."
        sleep 2
    done


    php /var/www/html/jjcli.php generatesql
fi

# Replace shell with Apache in foreground (PID 1)
exec apache2-foreground