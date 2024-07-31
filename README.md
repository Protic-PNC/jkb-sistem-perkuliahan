# Sistem Informasi Perkuliahan JKB

## Overview

Sistem Informasi Perkuliahan JKB is a comprehensive academic management system designed to streamline the process of managing course attendance, journals, and other academic data for higher education institutions.

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

## Database Structure

The system uses a relational database with the following main tables:

- users
- study_programs
- student_classes
- positions
- courses
- students
- lecturers
- course_lecturers
- lecturer_positions
- course_classes
- attendence_lists
- attendence_list_details
- journals
- journal_details

For a detailed view of the database structure, please refer to the DBML file in the repository.

## ERD

![ERD SIPerkuliahan](https://github.com/user-attachments/assets/98e3c74f-1865-4246-95fb-cf2e313b80af)


## Installation

[Include installation instructions here]

## Usage

[Provide basic usage instructions or link to more detailed documentation]

## Contributing

[Include guidelines for contributing to the project]

## License

[Specify the license under which this project is released]

## Contact

[Provide contact information for the project maintainers]
