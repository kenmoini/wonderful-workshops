'use strict';

// Simple Kubernetes/OpenShift Readiness/Liveliness Probe Server

const express = require('express');
const fs = require('fs')

// Constants
const PORT = 8989;
const HOST = '0.0.0.0';
const path = '/tmp/bad_health';

// App
const app = express();

app.get('/', (req, res) => {
  res.send('Hello world');
});

app.get('/health-check',(req,res)=> {
    fs.access(path, fs.F_OK, (err) => {
        if (err) {
          res.send ("ok");
          return
        }
        res.status(500).send('unhealthy');
      })
});

app.get('/bad-health',(req,res)=> {
    res.status(500).send('unhealthy');
});

app.listen(PORT, HOST);

console.log("Running on http://" + HOST + ":" + PORT);