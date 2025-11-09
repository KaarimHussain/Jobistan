create database job_website;
use job_website;
CREATE TABLE resumes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    job_title VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    linkedin VARCHAR(100),
    summary TEXT,
    education TEXT,
    skills TEXT,
    experience TEXT
);

select * from resumes;


create  table resume1(
id int auto_increment primary key,
full_name varchar(255),
job_title varchar(255),
email varchar(255), 
phone varchar(20), 
linkedin varchar(255), 
summary  varchar(255), 
education varchar(255),
skills varchar(255), 
experience varchar(255)
);


create table resumes002 (
id int auto_increment primary key, 
full_name varchar(255) ,
job_title varchar(255) ,
email varchar(255) ,
phone int ,
address varchar(255) ,
dob date ,
summary varchar(255) ,
job_title1 varchar(255), 
company_name varchar(255), 
job_duration_start date ,
job_duration_end date ,
job_description varchar(255), 
education_name varchar(255) ,
education_description text ,
education_name2 varchar(255), 
education_description2 varchar(255),
education_name3 varchar(255) ,
education_description3 varchar(255), 
skills varchar(255),
language_list varchar(255)
);

select * from resumes002;



create table resumes003 (
id int auto_increment primary key,
full_name varchar(255),
job_title varchar(255),
job_summary varchar(255),
email varchar(255),
phone int(20), 
locations varchar(255), 
linkedin varchar(255) ,
twitter varchar(255) ,
title_1 varchar(255) ,
company_name_1 varchar(255), 
job_duration_1 varchar(25) ,
job_description_1 varchar(255),
job_title_2 varchar(255), 
company_name_2 varchar(255), 
job_duration_2 varchar(25), 
job_description_2 varchar(255),
skills varchar(255),
languages varchar(255), 
Education1  varchar(255),
education_date1 date ,
Education2 varchar(255), 
education_date2 date
);

select * from resumes003;

CREATE TABLE resume004 (
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
    job_email_1 VARCHAR(100)
);
ALTER TABLE resume004
ADD COLUMN aboutme TEXT; 



select * from resume004;
