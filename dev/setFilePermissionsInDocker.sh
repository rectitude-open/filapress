#!/bin/sh
set -e
cd /home/wwwroot/filapress || exit
chown -R www-data:www-data /home/wwwroot/filapress && \
find /home/wwwroot/filapress -type f -exec chmod 644 {} \; && \
find /home/wwwroot/filapress -type d -exec chmod 755 {} \; && \
chmod -R +777 /home/wwwroot/filapress/storage /home/wwwroot/filapress/bootstrap/cache && \
chmod -R +x /home/wwwroot/filapress/vendor/bin/ && \
chmod -R +x /home/wwwroot/filapress/dev/
