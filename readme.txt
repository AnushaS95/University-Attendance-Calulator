1. configure Database.
	a. Create database with name of attendance_system
	b. import sql file in attendance_system. File Path - root/attendance_system.sql
2. Admin Credentials:
	username: admin@admin.com
	password: 123456
3. Add Website url in config file. 
	a. for changing of website url goto line number - 17
	
	Example:
	pre-defined ---------------- define('WEBSITE_URL', '');
	Change to ------------------ define('WEBSITE_URL', 'http://localhost/myproject');
	
	