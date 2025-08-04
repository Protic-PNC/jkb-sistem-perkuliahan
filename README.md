# JKB Lecture Information System

## Overview

JKB Lecture Information System is a comprehensive academic management system designed to streamline the process of managing course attendance, journals, and other academic data for higher education institutions.

## Features

### User Roles

The system supports three distinct user roles:

1. Superadmin
2. Dosen (Lecturer)
3. Mahasiswa (Student)

### Role-specific Functionalities

#### 1. Superadmin

- Can manage all data within the system, except for attendance lists (daftar hadir) and journals
- Responsible for user management, including:
  - Creating new user accounts
  - Assigning roles (Dosen or Mahasiswa) to users

#### 2. Dosen (Lecturer)

- Manage attendance lists (daftar hadir)
- Create and edit journals
- Approve attendance lists and journals

#### 3. Mahasiswa (Student)

- View their own attendance records
- Approve attendance lists and journals

## ERD
<img width="1769" height="1878" alt="ERD SIPerkuliahan JKB" src="https://github.com/user-attachments/assets/510efff6-c06f-4d16-bb51-0d40bdb680d5" />


## Key Features

- The system supports soft deletes (deleted_at column) for most entities, allowing for data recovery and historical tracking.
- Timestamps (created_at, updated_at) are used across all tables for auditing purposes.
- The structure supports complex relationships between courses, lecturers, and students, allowing for flexible academic management.
- Attendance and journaling systems are tightly integrated with the course and student management aspects of the database.

This database structure provides a robust foundation for managing academic programs, courses, student enrollment, attendance, and related academic activities in a higher education setting.

## Installation

1. Clone the repository:
```
git clone https://github.com/Protic-PNC/jkb-sistem-perkuliahan.git](https://github.com/Protic-PNC/jkb-sistem-perkuliahan.git)
cd jkb-sistem-perkuliahan
```
2. Install dependencies:
```
composer install
npm install
npm run dev
```
3. Set up the environment:

Copy the .env copy file to .env and update the necessary environment variables.
```
php artisan key:generate
```
4. Run database migrations and Seed the database:
```
php artisan migrate --seed

OR

import file dump-siperkuliahan-202508041917.sql on dbeaver/phpmyadmin
```
5. Start the development server:
```
php artisan serve
```


## Usage

After completing the installation steps, you can access the application by navigating to http://localhost:8000 in your web browser. Log in with the credentials created during the seeding process.

The application uses Laravel Breeze for authentication. You can log in with the default super admin credentials:

- Email: adisa@admin.com
- Password: 12345678


## Contributing

We welcome contributions to this project! Please follow these steps to contribute:

Fork the repository:

1. Click the "Fork" button at the top right corner of this page to create a copy of this repository under your GitHub account.

2. Clone your forked repository:
```
git clone https://github.com/your-username/jkb-sistem-perkuliahan.git
cd jkb-sistem-perkuliahan
```
3. Create a new branch:
```
git checkout -b feature/your-feature-name
```
4. Make your changes and commit them:
```
git add .
git commit -m "Add a detailed description of your changes"
```
5. Push to your forked repository:
```
git push origin feature/your-feature-name
```
6. Create a pull request:

Open your forked repository on GitHub, select the new branch you created, and click "New pull request." Provide a clear description of your changes.

## Contact
For any questions or concerns, please contact the project maintainers at:

Email: adisalaras41@gmail.com
<br>
GitHub: Protic-PNC
