import socket
import sys

HOST, PORT = '', 8888

#response
rsp = "Submitted! A shaynem dank!"

listen_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
listen_socket.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
listen_socket.bind((HOST, PORT))
listen_socket.listen(1)
print 'Serving HTTP on port %s ...' % PORT
while True:
    client_connection, client_address = listen_socket.accept()
    
    request = client_connection.recv(1024)
    print request

http_response = "HTTP/1.1 200 OK\r\nLocation: http://127.0.0.1:8888/index.html\nConnection: keep-alive\nContent-Type: text/html\nContent-Lenght: " + str(sys.getsizeof(rsp)) + "\r\n\r\n" + rsp + "\r\n"
client_connection.send(http_response)
client_connection.close()
