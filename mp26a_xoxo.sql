-- Active: 1747336191893@@localhost@3309@autos_xoxo26


gunzip -c /mnt/c/Users/Dell/Downloads/BD_30_abril/autos_xoxo26_250430.gz | ./vendor/bin/sail exec -T mysql mysql -u root autos_xoxo26


DROP TABLE `c_intereses`, `c_nivel`, `c_status_usuario`;

