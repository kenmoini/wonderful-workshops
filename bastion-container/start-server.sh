#!/bin/bash

/usr/sbin/sshd -D
cd /opt && npm install express
node /opt/server.js