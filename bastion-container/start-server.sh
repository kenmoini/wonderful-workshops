#!/bin/bash

#ssh-keygen -A -f /opt/ssh
#/usr/sbin/sshd -D
/etc/init.d/sshd start
/usr/sbin/sshd -D
npm install --prefix /opt express
node /opt/server.js