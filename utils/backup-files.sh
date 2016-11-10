#!/bin/bash

DIR='/usr/share/nginx/html/banco-de-ideias/*'

echo $(zip -r /var/tmp/backup/banco-de-ideias.zip /usr/share/nginx/html/banco-de-ideias/ 2>&1 > /dev/null)
