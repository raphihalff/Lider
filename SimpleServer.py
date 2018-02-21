#!/usr/bin/env python
import SimpleHTTPServer
import SocketServer
import logging
import cgi
import os
from page_maker import refresh
import analyzer as a
import urllib 
import nltk

def create_poem(poet_eng, poet_yid, month, date, year, title_eng, title_yid,
translator, reader, con, bio, poet_links, poem_links, con_links, poem_eng, poem_yid,
rec, poet_img, con_img):
	#does this poet exist?
	path = "./" + poet_eng
	p_date = month + " " + date + ", " + year if month != "NA" else year
	links = poet_links + "\n\n" + poem_links + "\n\n" + con_links
	
	
	if(not os.path.isdir(path)):
		#make new poet dir
		os.mkdir(path)
		os.chmod(path, 0775)
		#make .lider file
		dot_lider_f = open(path + "/.lider", "w")
		p_num = 0
		code = poet_eng.lower().strip().replace(" ", "_").replace(".","") + "_" + str(p_num)
		p_num += 1
		dot_lider_f.write(poet_yid + "\n" + 
			str(p_num) + "\n\n" +
			title_eng + "\n" + 
			title_yid + "\n" +
			code + "\n" +
			p_date)
		dot_lider_f.close()
	else: 
		dot_lider_f = open(path + "/.lider", "r")
		dot_lider = dot_lider_f.readlines()
		dot_lider_f.close()
		
		p_num = int(dot_lider[1].strip())
		code = poet_eng.lower().strip().replace(" ", "_") + "_" + str(p_num)
		p_num += 1
		
		dot_lider[1] = str(p_num) + '\n'
		dot_lider_f = open(path + "/.lider", "w")
		dot_lider_f.writelines(dot_lider)
		dot_lider_f.write("\n" +
			title_eng + "\n" + 
			title_yid + "\n" +
			code + "\n" +
			p_date + '\n')
		dot_lider_f.close()
		
	#make sup file
	sup_f = open(path + "/" + code + "_sup.txt", "w")
	sup_f.write(translator + "\n" +
		reader + "\n" + 
		con + "\n\n\n" + 
		bio +"\n\n\n" +
		links)
	sup_f.close()
	
	#make poem eng file
	poem_eng_f = open(path + "/" + code + "_poem_eng.txt", "w")
	poem_eng_f.write(poem_eng)
	poem_eng_f.close()
	
	#make poem yid file
	poem_yid_f = open(path + "/" + code + "_poem_yid.txt", "w")
	poem_yid_f.write(poem_yid)
	poem_yid_f.close()
	
	
	#make rec file 
	ext = "mp3"
	if (rec.filename):
		ext = rec.filename[-3:]
	rec_f = open(path + "/" + code + "_rec." + ext, "w")
	rec_f.write(rec.value)
	rec_f.close()
		
	#make poet img file
	ext = "jpg"
	if (poet_img.filename):
		ext = poet_img.filename[-3:]
	p_img_f = open(path + "/" + code + "_poetimg." + ext, "w")
	p_img_f.write(poet_img.value)
	p_img_f.close()
	
	#make con img file
	ext = "jpg"
	if (con_img.filename):
		ext = con_img.filename[-3:]
	c_img_f = open(path + "/" + code + "_conimg." + ext, "w")
	c_img_f.write(con_img.value)
	c_img_f.close()
	

PORT = 8888

class ServerHandler(SimpleHTTPServer.SimpleHTTPRequestHandler):

	def do_GET(self):
#        logging.error(self.headers)
		query = self.path[self.path.index('?') + 1:]
		query_seg = dict(part.split("=") for part in query.split("&"))
	
		functions = [a.freqbydate, 
					a.freqbypoets, 
					a.freqinpoem, 
					a.freqbypoet, 
					a.freqbypoetbydate]
		tokens = ""
		tokens = urllib.unquote(query_seg['tokens']).decode('utf8').split()
		if int(query_seg['func'])-1 < 2:
			print urllib.unquote(query_seg['tokens']).decode('utf8')
			functions[int(query_seg['func'])-1](tokens)
		else:
			print urllib.unquote(query_seg['tokens']).decode('utf8')
			functions[int(query_seg['func'])-1](a.codetofn(query_seg['poem'], True), tokens)
		
		self.send_response(301)
		self.send_header('Location','http://www.columbia.edu/~rah2183/Lider/')
		self.end_headers()


	def do_POST(self):
#       logging.error(self.headers)
		form = cgi.FieldStorage(
			fp=self.rfile,
			headers=self.headers,
			environ={'REQUEST_METHOD':'POST',
					'CONTENT_TYPE':self.headers['Content-Type'],
					})
         
		#consolidating links
		poet_links = form.getvalue('poetlink') + "\n" + form.getvalue('poetlink_title')
		poem_links = form.getvalue('poemlink') + "\n" + form.getvalue('poemlink_title')
		con_links = form.getvalue('conlink') + "\n" + form.getvalue('conlink_title')

		for i in range(0,2):
			l_type = "poetlink"
			if i == 1:
				l_type = "poemlink"
			elif i == 2:
				l_type = "conlink"
			
			count = 1
			link = ""
			while (form.getvalue(l_type + str(count),"")):
				link = "\n" + link + form.getvalue(l_type + str(count)) + "\n" + form.getvalue(l_type + "_title" + str(count)) 
				count += 1
			
			if i == 0: 
				poet_links = poet_links + link
			elif i == 1:
				poem_links = poem_links + link
			else:
				con_links = con_links + link
		
		#create the poem entry
		create_poem(form.getvalue('poet_eng'), 
			form.getvalue('poet_yid'),
			form.getvalue('month'),
			form.getvalue('date'),
			form.getvalue('year'),
			form.getvalue('title_eng'),
			form.getvalue('title_yid'),
			form.getvalue('translator'),
			form.getvalue('reader'),
			form.getvalue('con'),
			form.getvalue('bio'),
			poet_links,
			poem_links,
			con_links,
			form.getvalue('poem_eng'),
			form.getvalue('poem_yid'),
			form["rec"],
			form["poet_img"],
			form["con_img"])
			
		refresh()
		self.send_response(200)
		self.send_header('Content-type', 'text/html')
		self.end_headers()
		thanks= '<html><head><meta http-equiv="refresh" content="3;url=http://www.columbia.edu/~rah2183/Lider/" /></head><body><h1>Thank You!!<br>Redirecting in 3 seconds...</h1></body></html>'
		self.wfile.write(thanks)

Handler = ServerHandler

httpd = SocketServer.TCPServer(("", PORT), Handler)

print "serving at port", PORT
httpd.serve_forever()
