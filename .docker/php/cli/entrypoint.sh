#!/usr/bin/env bash
APP_ENV=${APP_ENV:-prod}
rm ~/.bashrc
ln -s /var/www/.bashrc ~/.bashrc
source ~/.bashrc

if [[ -e /usr/local/etc/php/conf.d/xdebug.ini ]]; then
    rm -f /usr/local/etc/php/conf.d/xdebug.ini
fi

touch /var/log/supervisor/supervisord.log
/usr/bin/supervisord