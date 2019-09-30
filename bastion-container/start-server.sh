#!/bin/bash

/usr/sbin/sshd -D
npm install --prefix /opt express
node /opt/server.js