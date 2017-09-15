#!/usr/bin/env python
import SimpleHTTPServer
import SocketServer
import logging
import cgi

PORT = 8888

class ServerHandler(SimpleHTTPServer.SimpleHTTPRequestHandler):

    def do_GET(self):
#        logging.error(self.headers)
        SimpleHTTPServer.SimpleHTTPRequestHandler.do_GET(self)


    def do_POST(self):
#        logging.error(self.headers)
        form = cgi.FieldStorage(
            fp=self.rfile,
            headers=self.headers,
            environ={'REQUEST_METHOD':'POST',
                     'CONTENT_TYPE':self.headers['Content-Type'],
                     })
#        for item in form.list:
#            print item

	# pulling the item values...
	poem_yid = form.getvalue('poem_yid')
	poem_eng = form.getvalue('poem_eng')	
	rec = form.getvalue('rec')
	poet_img = form.getvalue('poet_img')
	con_img = form.getvalue('con_img')

	#.lider
	poet_yid = form.getvalue('poet_yid')
	title_eng = form.getvalue('title_eng')
	title_yid = form.getvalue('title_yid')


	

        print form.getvalue('title_eng')
        SimpleHTTPServer.SimpleHTTPRequestHandler.do_GET(self)


Handler = ServerHandler

httpd = SocketServer.TCPServer(("", PORT), Handler)

print "serving at port", PORT
httpd.serve_forever()
