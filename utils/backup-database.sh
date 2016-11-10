#!/bin/bash

$(mysqldump -B dbideias -proot > /var/tmp/backup/banco-de-ideias.sql)

