EEMS - Education & School Management System
Description

EEMS is a web-based application designed to manage school operations efficiently.
It allows administration of students, teachers, parents, classes, subjects, and academic activities.

This project was developed as part of a Software Engineering course project.

Technologies Used
PHP (Backend)
MySQL (Database)
HTML, CSS, JavaScript (Frontend)
XAMPP (Local Development Environment)
Git & GitHub (Version Control)

Project Structure
eems/
│
├── admin/        # Admin panel
├── teacher/      # Teacher panel
├── parent/       # Parent panel
│
├── api/          # API endpoints (e.g. QR scan)
├── config/       # Configuration files (db.php)
├── database/     # SQL file (eemsdb.sql)
│
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
│
├── resources/    # Additional resources
├── tests/        # Testing files
│
├── index.php     # Main entry point
└── README.md

Installation & Setup
Clone the repository:
git clone https://github.com/EldaAllgjata/EEMS-Platform.git
Move the project to:
C:\xampp\htdocs\
Start XAMPP:
Apache 
MySQL 
Import the database:
Open phpMyAdmin
Create a database named eemsdb
Import database/eemsdb.sql
Run the project:
http://localhost/eems

Main Features

Admin
Manage students
Manage teachers
Manage classes and subjects
Manage payments
View activities and system data

Teacher
Manage grades
Track attendance
View assigned classes
Parent
View student's grades
View attendance
Receive notifications
Database Design

The database includes tables such as:

students
parents
teachers
classes
subjects
grades
attendance
payments
schedule
