CREATE DATABASE job_website;

USE job_website;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('job_seeker', 'employer') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO
    users(username, email, password, role, created_at)
VALUES
    (
        'Ubiad',
        'ubiad@gmail.com',
        '67890',
        'job_seeker',
        now()
    );

-- User Profiles Table (common fields)
CREATE TABLE profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(255),
    phone VARCHAR(20),
    address TEXT,
    profile_picture LONGBLOB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Job Seeker Profiles Table
CREATE TABLE resume_data(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    resume VARCHAR(255),
    skills TEXT,
    experience TEXT,
    education TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Employer Profiles Table
CREATE TABLE employer_profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    company_name VARCHAR(255),
    company_description TEXT,
    company_culture TEXT,
    company_benefits TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Job Listings Table
CREATE TABLE job_listings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employer_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    requirements TEXT,
    location VARCHAR(255),
    job_type ENUM('full-time', 'part-time', 'remote') NOT NULL,
    experience_level VARCHAR(255),
    salary_range VARCHAR(255),
    tags VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employer_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Applications Table
CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_seeker_id INT NOT NULL,
    job_listing_id INT NOT NULL,
    status ENUM(
        'applied',
        'viewed',
        'interviewing',
        'hired',
        'rejected'
    ) DEFAULT 'applied',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (job_seeker_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (job_listing_id) REFERENCES job_listings(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Messages Table
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    messages TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Job Alerts Table
CREATE TABLE job_alerts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_seeker_id INT NOT NULL,
    alert_criteria TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (job_seeker_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Resume Builder Templates Table
CREATE TABLE resume_templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    template_name VARCHAR(255) NOT NULL,
    template_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Interview Scheduler Table
CREATE TABLE interview_schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_seeker_id INT NOT NULL,
    employer_id INT NOT NULL,
    job_listing_id INT NOT NULL,
    interview_date DATETIME NOT NULL,
    status ENUM('scheduled', 'completed', 'cancelled') DEFAULT 'scheduled',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (job_seeker_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (employer_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (job_listing_id) REFERENCES job_listings(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Feedback Table
CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    feedback TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Applied_jobs
CREATE TABLE applied_jobs (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_id INT NOT NULL,
    job_id INT NOT NULL,
    applied_at DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (job_id) REFERENCES job_listings(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Analytics Table
CREATE TABLE analytics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    metric_name VARCHAR(255) NOT NULL,
    metric_value VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Third-Party Integrations Table
CREATE TABLE third_party_integrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    provider VARCHAR(255) NOT NULL,
    access_token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- AI Image Detection Table (Optional)
CREATE TABLE ai_image_detection (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    detection_result TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    notification_type VARCHAR(50) NOT NULL,
    content TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE savedPost(
    id int auto_increment not null primary key,
    job_listing_id int not null,
    user_id int not null,
    FOREIGN KEY (job_listing_id) REFERENCES job_listings(id) ON UPDATE CASCADE ON DELETE CASCADE,
    foreign key (user_id) references users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE recoveryEmail(
    id int auto_increment not null primary key,
    user_id int not null,
    otp varchar(6) not null,
    conformed bool default false,
    foreign key (user_id) references users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE contact_support(
    id int auto_increment not null primary key,
    email varchar(300) not null,
    subject varchar(100) not null,
    message text not null
);

CREATE TABLE users_additional_info(
    info_id int auto_increment not null primary key,
    user_id int not null,
    user_description text default null,
    user_interest varchar(100) default null,
    user_hobbies varchar(100) default null,
    user_main_profession VARCHAR(100) DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE user_skills(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    skill VARCHAR(100) NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE user_projects_links(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    project_name VARCHAR(255) NOT NULL,
    project_description TEXT NOT NULL,
    project_link TEXT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE user_portfolio_links(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    portfolio_link TEXT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE user_work_experience(
    work_id int primary key not null auto_increment,
    user_id int not null,
    job_title VARCHAR(100) NOT NULL,
    company_name varchar(255) not null default 'Undefined',
    work_description text default null,
    company_start_date DATE DEFAULT current_timestamp,
    company_end_date DATE DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE userSavedImagesForDetection (
    img_id int primary key auto_increment not null,
    user_id int not null,
    savedImage blob default null,
    enabled bool default false,
    foreign key (user_id) references users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE two_fact_auth (
    id int primary key not null auto_increment,
    user_id int not null,
    is_enabled bool default false
);

CREATE TABLE profile_views (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    company_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (company_id) REFERENCES employer_profiles(user_id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Backup tables
CREATE TABLE backup_profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(255),
    phone VARCHAR(20),
    address TEXT,
    profile_picture LONGBLOB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- To track deletion time
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE backup_resume_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    resume VARCHAR(255),
    skills TEXT,
    experience TEXT,
    education TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE backup_employer_profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    company_name VARCHAR(255),
    company_description TEXT,
    company_culture TEXT,
    company_benefits TEXT,
    company_logo LONGBLOB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE backup_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_seeker_id INT NOT NULL,
    job_listing_id INT NOT NULL,
    status ENUM(
        'applied',
        'viewed',
        'interviewing',
        'hired',
        'rejected'
    ) DEFAULT 'applied',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (job_seeker_id) REFERENCES users(id),
    FOREIGN KEY (job_listing_id) REFERENCES job_listings(id)
);

CREATE TABLE backup_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    message TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE backup_user_work_experience (
    work_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    company_name VARCHAR(255) NOT NULL DEFAULT 'Undefined',
    work_description TEXT,
    company_start_date DATE NOT NULL,
    company_end_date DATE NOT NULL DEFAULT NOW(),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE companies_applied_jobs(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    users_id INT NOT NULL,
    job_id INT NOT NULL,
    employers_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (users_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (job_id) REFERENCES job_listings(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (employers_id) REFERENCES employer_profiles(id) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE workers_resume(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_id INT NOT NULL,
    resume_file longblob NOT NULL,
    visibility BOOLEAN NOT NULL DEFAULT true,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE community_post(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    post_content TEXT NOT NULL,
    post_image LONGBLOB DEFAULT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE community_post_likes(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    like_type BOOL NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES community_post(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE community_post_comments (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    comment_text VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES community_post(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE external_user_resume(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    job_title VARCHAR(100) NOT NULL,
    job_experience VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE backup_companies_applied_jobs(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    users_id INT NOT NULL,
    job_id INT NOT NULL,
    employers_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE backup_workers_resume(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_id INT NOT NULL,
    resume_file LONGBLOB NOT NULL,
    visibility BOOLEAN NOT NULL DEFAULT true
);

CREATE TABLE backup_external_user_resume(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    job_title VARCHAR(100) NOT NULL,
    job_experience VARCHAR(50) NOT NULL
);
CREATE TABLE backup_users_additional_info (
    info_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    user_description TEXT DEFAULT NULL,
    user_interest VARCHAR(100) DEFAULT NULL,
    user_hobbies VARCHAR(100) DEFAULT NULL,
    user_main_profession VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (info_id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE scheduledInterviews(
	 id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
     user_id INT NOT NULL,
     job_id INT NOT NULL,
     interviewedUser VARCHAR(255) NOT NULL,
     interviewedEmail VARCHAR(255) NOT NULL,
     job_title VARCHAR(255) NOT NULL,
     interviewed_description TEXT DEFAULT NULL,
     interviewed_date DATE DEFAULT NOW(),
     interviewed_time TIME DEFAULT NOW(),
     created_at DATETIME NOT NULL DEFAULT NOW(),
     interviewStatus ENUM('pending','interview_on','interview_off') NOT NULL DEFAULT 'pending',
     FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
     FOREIGN KEY (job_id) REFERENCES job_listings(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE UsersInbox(
	id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    messages TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE UsersInbox ADD seen TINYINT(1) DEFAULT 0;
ALTER TABLE employer_profiles ADD COLUMN actions ENUM('rejected', 'pending', 'approved') NOT NULL DEFAULT 'pending';
ALTER TABLE job_listings ADD COLUMN job_status ENUM('open','close') NOT NULL DEFAULT 'open';
ALTER TABLE job_listings ADD COLUMN required_candidate INT NOT NULL DEFAULT 1;

-- TRIGGERS
-- Trigger for profiles table
DELIMITER / / CREATE TRIGGER tr_delete_user_backup_profiles
AFTER
    DELETE ON users FOR EACH ROW BEGIN
INSERT INTO
    backup_profiles (user_id, name, phone, address, profile_picture)
SELECT
    user_id,
    name,
    phone,
    address,
    profile_picture
FROM
    profiles
WHERE
    user_id = OLD.id;

DELETE FROM
    profiles
WHERE
    user_id = OLD.id;

END / / DELIMITER;

-- Trigger for resume_data table
DELIMITER / / CREATE TRIGGER tr_delete_user_backup_resume_data
AFTER
    DELETE ON users FOR EACH ROW BEGIN
INSERT INTO
    backup_resume_data (user_id, resume, skills, experience, education)
SELECT
    user_id,
    resume,
    skills,
    experience,
    education
FROM
    resume_data
WHERE
    user_id = OLD.id;

DELETE FROM
    resume_data
WHERE
    user_id = OLD.id;

END / / DELIMITER;

-- Trigger for employer_profiles table
DELIMITER //
CREATE TRIGGER tr_delete_user_backup_employer_profiles
AFTER
    DELETE ON users FOR EACH ROW BEGIN
INSERT INTO
    backup_employer_profiles (
        user_id,
        company_name,
        company_description,
        company_culture,
        company_benefits,
        company_logo
    )
SELECT
    user_id,
    company_name,
    company_description,
    company_culture,
    company_benefits,
    company_logo
FROM
    employer_profiles
WHERE
    user_id = OLD.id;

DELETE FROM
    employer_profiles
WHERE
    user_id = OLD.id;

END / / DELIMITER;

-- Trigger for applications table
DELIMITER / / CREATE TRIGGER tr_delete_user_backup_applications
AFTER
    DELETE ON users FOR EACH ROW BEGIN
INSERT INTO
    backup_applications (job_seeker_id, job_listing_id, status)
SELECT
    job_seeker_id,
    job_listing_id,
    status
FROM
    applications
WHERE
    job_seeker_id = OLD.id;

DELETE FROM
    applications
WHERE
    job_seeker_id = OLD.id;

END / / DELIMITER;

-- Trigger for messages table
DELIMITER / / CREATE TRIGGER tr_delete_user_backup_messages
AFTER
    DELETE ON users FOR EACH ROW BEGIN
INSERT INTO
    backup_messages (sender_id, receiver_id, message)
SELECT
    sender_id,
    receiver_id,
    message
FROM
    messages
WHERE
    sender_id = OLD.id
    OR receiver_id = OLD.id;

DELETE FROM
    messages
WHERE
    sender_id = OLD.id
    OR receiver_id = OLD.id;

END / / DELIMITER;

-- Trigger for user_work_experience table
DELIMITER // 
CREATE TRIGGER tr_delete_user_backup_user_work_experience
AFTER
    DELETE ON users FOR EACH ROW BEGIN
INSERT INTO
    backup_user_work_experience (
        user_id,
        company_name,
        work_description,
        company_start_date,
        company_end_date
    )
SELECT
    user_id,
    company_name,
    work_description,
    company_start_date,
    company_end_date
FROM
    user_work_experience
WHERE
    user_id = OLD.id;

DELETE FROM
    user_work_experience
WHERE
    user_id = OLD.id;

END 
DELIMITER //;

ALTER TABLE
    users
MODIFY
    username VARCHAR(255) NOT NULL;

ALTER TABLE
    users
ADD
    COLUMN account_visibility BOOLEAN DEFAULT TRUE;

alter table
    profiles
modify
    column profile_picture longblob;

Alter table
    users
modify
    column username VARCHAR(255) NOT NULL;

alter table
    employer_profiles
add
    column company_logo longblob;

ALTER TABLE
    job_listings
Modify
    Column job_type enum (
        'full-time',
        'part-time',
        'remote',
        'contract',
        'intern'
    );

ALTER TABLE
    notifications
ADD
    COLUMN message_from varchar(255) not null default 'System';

alter table
    user_work_experience
add
    column company_start_date date not null;

alter table
    user_work_experience
add
    column company_end_date date not null default NOW();

alter table
    user_work_experience
modify
    column company_end_date date not null;

ALTER TABLE
    resume_data
add
    column resume_visibility bool not null default true;

ALTER TABLE
    users
MODIFY
    COLUMN role enum('worker', 'recruiter') default 'worker';

ALTER TABLE
    companies_applied_jobs DROP FOREIGN KEY companies_applied_jobs_ibfk_1;

ALTER TABLE
    companies_applied_jobs
ADD
    CONSTRAINT companies_applied_jobs_ibfk_1 FOREIGN KEY (users_id) REFERENCES users(id) ON DELETE CASCADE;

ALTER TABLE
    backup_messages CHANGE COLUMN message messages TEXT;

SELECT
    employer_profiles.id as company_id,
    employer_profiles.company_name,
    employer_profiles.company_description,
    employer_profiles.company_logo,
    employer_profiles.company_benefits,
    employer_profiles.company_culture,
    users.id as user_id,
    users.username
FROM
    employer_profiles
    INNER JOIN users ON employer_profiles.user_id = users.id
WHERE
    employer_profiles.user_id = 23;

select
    users.*,
    profiles.*
From
    profiles
    INNER JOIN users ON profiles.user_id = users.id
where
    user_id = 20;

SELECT
    job_listings.id AS job_id,
    job_listings.title,
    job_listings.description,
    job_listings.requirements,
    job_listings.location,
    job_listings.job_type,
    job_listings.experience_level,
    job_listings.salary_range,
    job_listings.tags,
    job_listings.created_at,
    employer_profiles.id AS employer_profile_id,
    employer_profiles.user_id,
    employer_profiles.company_name,
    employer_profiles.company_description,
    employer_profiles.company_culture,
    employer_profiles.company_benefits,
    employer_profiles.company_logo
FROM
    job_listings
    INNER JOIN employer_profiles ON job_listings.employer_id = employer_profiles.user_id;

SELECT
    job_listings.*,
    employer_profiles.*
FROM
    job_listings
    INNER JOIN employer_profiles ON job_listings.employer_id = employer_profiles.user_id;

SELECT
    *
FROM
    users;

SELECT
    *
FROM
    job_listings;

SELECT
    *
FROM
    job_listings
WHERE
    salary_range > 20000
LIMIT
    4;

CREATE TABLE resumes (
    user_id int not null,
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    job_title VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    linkedin VARCHAR(100),
    summary TEXT,
    education TEXT,
    skills TEXT,
    experience TEXT,
    foreign key (user_id) references users(id)
);

-- select * from resumes;
create table resume1(
    user_id int not null,
    id int auto_increment primary key,
    full_name varchar(255),
    job_title varchar(255),
    email varchar(255),
    phone varchar(20),
    linkedin varchar(255),
    summary varchar(255),
    education varchar(255),
    skills varchar(255),
    experience varchar(255),
    foreign key (user_id) references users(id)
);

create table resumes2 (
    user_id int not null,
    id int auto_increment primary key,
    full_name varchar(255),
    job_title varchar(255),
    email varchar(255),
    phone int,
    address varchar(255),
    dob date,
    summary varchar(255),
    job_title1 varchar(255),
    company_name varchar(255),
    job_duration_start date,
    job_duration_end date,
    job_description varchar(255),
    education_name varchar(255),
    education_description text,
    education_name2 varchar(255),
    education_description2 varchar(255),
    education_name3 varchar(255),
    education_description3 varchar(255),
    skills varchar(255),
    language_list varchar(255),
    foreign key (user_id) references users(id)
);
-- select * from resumes002;
create table resumes3 (
    user_id int not null,
    id int auto_increment primary key,
    full_name varchar(255),
    job_title varchar(255),
    job_summary varchar(255),
    email varchar(255),
    phone int(20),
    locations varchar(255),
    linkedin varchar(255),
    twitter varchar(255),
    title_1 varchar(255),
    company_name_1 varchar(255),
    job_duration_1 varchar(25),
    job_description_1 varchar(255),
    job_title_2 varchar(255),
    company_name_2 varchar(255),
    job_duration_2 varchar(25),
    job_description_2 varchar(255),
    skills varchar(255),
    languages varchar(255),
    Education1 varchar(255),
    education_date1 date,
    Education2 varchar(255),
    education_date2 date,
    foreign key (user_id) references users(id)
);

-- select * from resumes003;
CREATE TABLE resume4 (
    user_id int not null,
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    job_title VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100) NOT NULL,
    address VARCHAR(255),
    expertise TEXT,
    languages TEXT,
    hobbies TEXT,
    about_me TEXT,
    job_title_1 VARCHAR(100),
    company_name_1 VARCHAR(100),
    joblocation1 VARCHAR(100),
    job_duration_start1 DATE,
    job_duration_end1 DATE,
    job_description_1 TEXT,
    job_title_2 VARCHAR(100),
    company_name_2 VARCHAR(100),
    joblocation2 VARCHAR(100),
    job_duration_start2 DATE,
    job_duration_end2 DATE,
    job_description_2 TEXT,
    Education_name1 VARCHAR(100),
    Education_passoutdate1 DATE,
    Education_discription1 TEXT,
    Education_name2 VARCHAR(100),
    Education_passoutdate2 DATE,
    Education_discription2 TEXT,
    r_name VARCHAR(100),
    job_position_1 VARCHAR(100),
    r_company_name_1 VARCHAR(100),
    job_phone_1 VARCHAR(20),
    job_email_1 VARCHAR(100),
    foreign key (user_id) references users(id)
);

ALTER TABLE
    resume4
ADD
    COLUMN aboutme TEXT;

select
    *
from
    resume4;

ALTER TABLE
    resume4
ADD
    COLUMN job_title_experience VARCHAR(255) NOT NULL DEFAULT 'fresher';

ALTER TABLE
    resumes3
ADD
    COLUMN job_title_experience VARCHAR(255) NOT NULL DEFAULT 'fresher';

ALTER TABLE
    resumes2
ADD
    COLUMN job_title_experience VARCHAR(255) NOT NULL DEFAULT 'fresher';

ALTER TABLE
    resumes
ADD
    COLUMN job_title_experience VARCHAR(255) NOT NULL DEFAULT 'fresher';
    
CREATE TABLE hired_history (
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    job_id INT NOT NULL,
    emp_id INT NOT NULL,
    hired_at DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (job_id) REFERENCES job_listings(id) ON DELETE CASCADE,
    FOREIGN KEY (emp_id) REFERENCES employer_profiles(user_id) ON DELETE CASCADE
)
