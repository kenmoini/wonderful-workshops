#!/bin/bash

/usr/sbin/sshd -D
npm install express
node /opt/server.js