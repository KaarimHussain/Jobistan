# Jobistan - Advanced Job Portal & Recruitment Platform

Jobistan is a comprehensive web-based job portal designed to bridge the gap between job seekers (Workers) and recruiters (Companies). Built with native PHP and modern web technologies, it features a robust application tracking system, AI-powered assistance, and secure image-based verification.

## 🚀 Features

### Core Functionalities
- **User Roles & Management**:
  - **Workers**: Create professional profiles, build resumes, search and apply for jobs, follow companies, and manage applications.
  - **Recruiters**: Create company profiles, post job listings, manage applications, view candidate profiles, and schedule interviews.
  - **Admin Panel**: Comprehensive dashboard to manage users, companies, jobs, and view platform analytics.

### Key Highlights
- **AI-Powered Chatbot**: Integrated "JET BOT" powered by Google Gemini AI to assist users with queries and navigation.
- **Image-Based Verification**: Advanced security feature allowing users to log in or verify their identity using image comparison technology.
- **Resume Builder**: Built-in tools for users to create and manage their resumes, or upload external resume files.
- **Smart Job Search**: Advanced filtering by salary, location, job type, and experience level.
- **Social Community**: A professional feed where users can post updates, like, and comment on industry news and insights.
- **Communication System**: Internal messaging system for direct communication between recruiters and candidates.
- **Notifications**: Email notifications for account activities and application updates via PHPMailer.

## 🛠️ Technology Stack

- **Backend**: Native PHP (Object-Oriented Architecture)
- **Frontend**: HTML5, CSS3, JavaScript (jQuery), Bootstrap
- **Database**: MySQL
- **Dependencies (Composer)**:
  - `phpmailer/phpmailer`: Email services
  - `twilio/sdk` & `andreasnij/an-sms`: SMS & OTP services
  - `sapientpro/image-comparator`: Image verification logic
- **AI Integration**: Google Generative AI (Gemini Model)

## 📂 Directory Structure

```
├── Classes/            # Core PHP logic and Business Layer (Database, Auth, AI, etc.)
├── Scripts/            # Frontend JavaScript files (AJAX, Chatbot logic, UI interactions)
├── Styles/             # CSS Stylesheets
├── SQL/                # Database schema and export files
├── Includes/           # Helper scripts (Database connection, Session management)
├── ImageDetection/     # Storage for image verification files
├── UserUploads/        # Storage for user profile pictures and documents
├── Resume/ & UserResume/ # Resume generation and storage
├── Interfaces/         # PHP Interfaces (if any)
└── vendor/             # Composer dependencies
```

## ⚙️ Installation & Setup

### Prerequisites
- PHP 8.0 or higher
- MySQL Database
- Composer (Dependency Manager for PHP)
- A Web Server (Apache/Nginx/XAMPP/WAMP)

### Steps

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/yourusername/jobistan.git
    cd jobistan
    ```

2.  **Install Dependencies**
    Run the following command in the root directory to install required PHP packages:
    ```bash
    composer install
    ```

3.  **Database Setup**
    - Create a new MySQL database named `job_website`.
    - Import the provided SQL dump file located at `SQL/export.sql` into your database.

4.  **Configure Database Connection**
    - Open `Includes/db.php`.
    - Update the database credentials to match your local environment:
      ```php
      $dbname = "job_website";
      $host = "localhost";
      $user = "root"; // Your MySQL Username
      $pass = "";     // Your MySQL Password
      ```

5.  **Environment Configuration**
    - The project uses an `.env` file (or `Classes/Base.php` / `Scripts/chatbot.mjs` directly in some cases) for API keys.
    - Ensure you have valid API keys for:
      - **Google Gemini AI**: Update in `Scripts/chatbot.mjs`.
      - **Twilio**: Update credentials where `twilio/sdk` is initialized (likely `Classes/mailing.php` or `handleSMS.php`).

6.  **Run the Application**
    - Place the project folder in your web server's root directory (e.g., `htdocs` for XAMPP).
    - Access the application via your browser:
      ```
      http://localhost/jobistan/index.php
      ```

## 📖 Usage Guide

### For Job Seekers (Workers)
1.  **Sign Up**: Register as a "Worker".
2.  **Profile**: Complete your profile, add skills, experience, and education.
3.  **Resume**: Use the "Build Resume" feature or upload a PDF.
4.  **Find Jobs**: Browse the home page or use filters to find relevant listings.
5.  **Apply**: Click "Apply" on job details. Track status in your dashboard.

### For Recruiters (Companies)
1.  **Sign Up**: Register as a "Recruiter".
2.  **Company Profile**: Set up your company page with logo, description, and culture.
3.  **Post Jobs**: Create detailed job listings with requirements and salary range.
4.  **Manage**: View applicants in the "Dashboard", download their resumes, and schedule interviews.

### Admin Access
- Access `adminPanel.php` (Requires Admin credentials in the `users` table) to oversee the entire platform usage.

## 🤝 Contributing
Contributions are welcome! Please fork the repository and submit a pull request for any enhancements or bug fixes.

---
**Jobistan** - Connecting Talent with Opportunity.
