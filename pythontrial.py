import mysql.connector
mydb = mysql.connector.connect(host="localhost",user="root",passwd="aressam1999",database="instmgtsys");
print("hello")
mycursor = mydb.cursor();
mycursor.execute("SELECT * FROM teacher");
for i in mycursor:
	print(i)