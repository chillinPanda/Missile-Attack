#!/usr/bin/python
from BaseHTTPServer import BaseHTTPRequestHandler,HTTPServer
from attack import *

PORT_NUMBER = 8080
global execution_counter
execution_counter = 0

# Blank favicon - prevents silly 404s from occuring if no favicon is supplied
FAVICON_GIF = 'GIF89a\x01\x00\x01\x00\xf0\x00\x00\xff\xff\xff\x00\x00\x00!\xff\x0bXMP DataXMP\x02?x\x00!\xf9\x04\x05\x00\x00\x00\x00,\x00\x00\x00\x00\x01\x00\x01\x00@\x02\x02D\x01\x00;'


#This class will handles any incoming request from
#the browser 
class myHandler(BaseHTTPRequestHandler):
	
	
	# do the rocket launcher stuff
	def process_thunder_commands(self):
		if self.path == "/":
			self.wfile.write("accesing root: undefined action")
			return
		
		pathparts = self.path.split("/")
		if len(pathparts) == 3:
			# with parameter like !/right/500
			self.wfile.write("command: [" + pathparts[1] + "] with parameter: [" + pathparts[2] + "]")
			run_command(pathparts[1], pathparts[2])
		elif len(pathparts) == 2:
			# without parameter like !/right for continuous movement
			self.wfile.write("command: [" + pathparts[1] + "]")
			run_command(pathparts[1], -1)
		else:
			self.wfile.write("undefined action")
		return
			
	#Handler for the GET requests
	def do_GET(self):
		if '/favicon.ico' in self.path:
			self.send_response(200)
			self.send_header('Content-type','image/gif')
			self.send_header('Cache-Control','max-age=315360000')
			self.wfile.write(FAVICON_GIF)
			return
		global execution_counter
		execution_counter = execution_counter + 1
		self.send_response(200)
		self.send_header('Content-type','text/html')
		self.send_header('Access-Control-Allow-Origin','*')
		self.end_headers()

		# send_cmd(RIGHT)

		# Send the html message
		self.wfile.write("REST API | " + self.path + " | Counter: " + str(execution_counter) + " | ")
		
		self.process_thunder_commands()
		return

try:
        #registering rocket launcher
        print 'Setup usb device'
        setup_usb()

	#Create a web server and define the handler to manage the
	#incoming request
	server = HTTPServer(('', PORT_NUMBER), myHandler)
	print 'Started httpserver on port ' , PORT_NUMBER
	
	#Wait forever for incoming htto requests
	server.serve_forever()

except KeyboardInterrupt:
	print '^C received, shutting down the web server'
	server.socket.close()