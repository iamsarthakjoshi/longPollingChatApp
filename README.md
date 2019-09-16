For localhost please change database credentials going to following files:

api/connect.php

config/config.php

SQL file can be found in the root folder as "database.sql" 

User Credentials:

For ADMIN:
Username: test
Userkey: test
Role: staff

For USERS:
Username: test
Userkey: test
Role: staff
Semester:


Username: sarthak
Userkey: l6s2
Role: Student
Semester: BSCIT_L6S2


Username: sagar
Userkey: l6s2
Role: Student
Semester: BSCIT_L6S2

Username: sachetpun
Userkey: l6s1
Role: Student
Semester: BSCIT_L6S1

Username: bplv
Userkey: l6s1
Role: Student
Semester: BSCIT_L6S1
____________________________
Assignment Production Project Part 2 : Product
Submitted by: Sarthak Joshi
ID: 77146774
BSCIT L6S2
The British College
Leeds Beckket University
____________________________

Thank you
----------------------------

Type of users:

Admin - Staff
Teahers - Staff
Normal users - Students

_________________________________________________

Features: 

Private chat: This feature is only for the students. But student of same semester or class can only have private chat with each other. 

Public chat: This feature is for all the students of all the faculty or classes or semester and even for Admin and Teachers.

Foul messages are filtered through custom javascript functions.

Admin user/Teachers - Staff can check the user informations, add new user, change user details as per the need, upload files and notices(feeds/news/routines), also can be deleted. They have prilivige to delete all the chat history as per the need.

Each users are given username and userkey by the admin/teachers but if necessary they have access to change their username and password/userkey as per the need and also for security reasons.

Prepared statements are mostly used to execute query to make sure no sql injection or any hacks would get the application out of order.

All the online users are displayed in chat pages.

_________________________________________________

How the Chat system works?

Well, it's done using Ajax Long Polling method.

When user hits Send button then the message along with timestamp, user id, username are saved to database but at the same time, these data are written to the text file in such a way that it could directly be append to the html element. This means that, I am not fetching data directly from database at the real time but data are first saved to database and then fetched so that it could be written to the text file. This way there is very less load on the server. This method is applied for all the chat system and even for displaying online users in real time.

Behind the scene:

In ajax part following steps happen..

1. First of, it sends a request to the server (without a timestamp parameter)
2. Then it waits for an answer from server.php, server_priv.php and user_online.php (which can take forever)
3. If server.php, server_priv.php and user_online.php responds (whenever), put data_from_file into #chatBox(ul html element)
4. and call the function again


In server side part following steps happen..
(This file is an infinitive loop. Seriously.)

1. It gets the file's last-changed timestamp, checks if this is larger than the timestamp of the
2. AJAX-submitted timestamp (time of last ajax request), and if so, it sends back a JSON with the data from
	file (and a timestamp). If not, it waits for one seconds and then start the next while step.
