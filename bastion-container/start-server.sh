#!/bin/bash

#ssh-keygen -A -f /opt/ssh
#/usr/sbin/sshd -D
echo -e ",s/1234321/`id -u`/g\\012 w" | ed -s /etc/passwd && \
mkdir -p /home/ossh/.ssh && \
touch /home/ossh/.ssh/authorized_keys && \
chmod 700 /home/ossh/.ssh && \
chmod 600 /home/ossh/.ssh/authorized_keys && \
#/etc/init.d/sshd start && \
ssh-keygen -A && \
/usr/sbin/sshd -D && \
npm install --prefix /opt express && \
node /opt/server.js