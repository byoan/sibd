#!/bin/bash
split -b 1000 /var/lib/mysql/sibd/horses.MYI trololo;
test = $(echo trololo*);
IFS=' ' read -a array <<< $test;
cat "${array[0]}"> /var/lib/mysql/sibd/horses.MYI;
run trololo;