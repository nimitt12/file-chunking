

var express = require('express');
var app = express();
var fs = require('fs');

var multipart = require('connect-multiparty');
var multipartMiddleware = multipart();

app.get('/', function (req, res) {
	res.send('hello lovefc');
});

app.post('/upload', multipartMiddleware, function (req, res, next) {

	res.header("Access-Control-Allow-Origin", "*");
	res.header("Access-Control-Allow-Headers", "X-Requested-With");
	res.header("Access-Control-Allow-Methods", "PUT,POST,GET,DELETE,OPTIONS");

	res.header("Content-Type", "text/html;charset=utf-8");
	

	var file_data = req.files.file_data.path; 

	var file_name = req.body.file_name; 

	var file_total = req.body.file_total; 

	var file_index = req.body.file_index; 
	
	var file_md5 = req.body.file_md5; 
	
	var file_size = req.body.file_size; 

	var dstPath = '../upload/' + file_name; 

	console.log(file_data);

	

	if (fs.existsSync(dstPath) && fs.statSync(dstPath).isFile()) {
		fs.readFile(file_data, 'utf8', function (err, data) {
			fs.appendFile(dstPath, data, function (err) {
				if (err) {
					res.send('failed: ' + err);
					console.log('failed: ' + err);
				} else {
					res.send('success');
					console.log('success');
				}
			});
		});
    }	else {
		fs.readFile(file_data, 'utf8', function (err, data) {
			fs.appendFile(dstPath, data, function (err) {
				if (err) {
					res.send('failed: ' + err);
					console.log('failed: ' + err);
				} else {
					res.send('success');
					console.log('success');
				}
			});
		});
	}
});

var server = app.listen(8888, function () {
		var host = server.address().address;
		var port = server.address().port;

		console.log('listening at http://%s:%s', host, port);
	});
