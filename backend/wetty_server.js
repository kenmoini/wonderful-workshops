var http = require('http');
var querystring = require('querystring');

import { Terminal } from 'xterm';

function processPost(request, response, callback) {
    var queryData = "";
    if(typeof callback !== 'function') return null;

    if(request.method == 'POST') {
        request.on('data', function(data) {
            queryData += data;
            if(queryData.length > 1e6) {
                queryData = "";
                response.writeHead(413, {'Content-Type': 'text/plain'}).end();
                request.connection.destroy();
            }
        });

        request.on('end', function() {
            request.post = querystring.parse(queryData);
            callback();
        });

    } else {
        response.writeHead(405, {'Content-Type': 'text/plain'});
        response.end();
    }
}

http.createServer(function(request, response) {
    if(request.method == 'POST') {
        processPost(request, response, function() {
            console.log(request.post);
            console.log(request.post['hostname']);
            // Use request.post here
            wetty
                .on('exit', ({ code, msg }) => {
                    console.log(`Exit with code: ${code} ${msg}`);
                })
                .on('spawn', msg => console.log(msg));
            wetty.start({ sshhost: request.post['sshhost'] }).then(() => {
                console.log('server running');
                /* code you want to execute */
            });

            response.writeHead(200, "OK", {'Content-Type': 'text/plain'});
            response.end();
        });
    } else {
        response.writeHead(200, "OK", {'Content-Type': 'text/plain'});
        response.end();
    }

}).listen(3030);