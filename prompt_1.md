# Prompt 1: Develop CMS for School Website

You are an expert Laravel developer.  
Please build a **Content Management System (CMS)** for a school website using the following requirements:

---

## ⚙️ Tech Stack
- **Framework**: Laravel (latest version)
- **Database**: MySQL
- **Frontend (CMS)**: Laravel Blade + Bootstrap template
- **Deployment**: Must support subdomain `cms.school.com`

---

## 📂 Project Structure
app/
├── Http/
│ ├── Controllers/
│ │ ├── CMS/ # CMS controllers
│ │ └── Auth/
│ ├── Middleware/
│ └── Kernel.php
resources/
├── views/
│ └── cms/ # CMS Blade templates
routes/
├── cms.php # CMS routes
└── web.php # Global routes
public/
├── assets/cms/

---

## 📊 Database Schema (MySQL)

### 1. users
- id (PK)
- name
- email
- password
- role (`admin`, `editor`)
- created_at, updated_at

### 2. pages
- id (PK)
- title
- slug
- content (HTML)
- type (`about`, `vision_mission`, `career`, `faq`, etc.)
- status (`draft`, `published`)
- created_at, updated_at

### 3. programs
- id (PK)
- name
- slug
- description (HTML)
- curriculum
- brochure_url
- created_at, updated_at

### 4. explores
- id (PK)
- title
- slug
- category (`facility`, `extracurricular`, `achievement`, `school_life`, `islamic_life`, `virtual_tour`)
- content (HTML)
- image_url
- created_at, updated_at

### 5. news
- id (PK)
- title
- slug
- content (HTML)
- category (`news`, `event`, `coverage`)
- image_url
- published_at
- status (`draft`, `published`)
- created_at, updated_at

### 6. admissions
- id (PK)
- name
- email
- phone
- level (`paud`, `sd`, `smp`, `sma`)
- document_url
- status (`pending`, `verified`, `rejected`)
- created_at, updated_at

### 7. media
- id (PK)
- file_name
- file_url
- type (`image`, `video`, `pdf`)
- created_at, updated_at

### 8. faqs
- id (PK)
- question
- answer
- created_at, updated_at

### 9. settings
- id (PK)
- key (e.g., `school_name`, `logo_url`, `contact_email`, `facebook_url`)
- value

---

## 🔑 CMS Features
1. **Dashboard**
   - Show statistics: news count, upcoming events, recent admissions.
2. **Page Management**
   - CRUD for static pages (About, Vision, Mission, Careers, FAQ).
3. **Program Management**
   - CRUD for school programs (PAUD, SD, SMP, SMA).
4. **Explore Management**
   - CRUD for facilities, extracurriculars, achievements, Islamic life, school life, virtual tours.
5. **News & Events Management**
   - CRUD for news, events, and coverage.
   - Calendar view for events.
6. **Admissions Management**
   - View and verify applicants.
   - Upload/download admission documents.
7. **Media Management**
   - Upload and manage images, videos, PDFs.
8. **FAQ Management**
   - Add/edit frequently asked questions.
9. **Settings**
   - Manage logo, social links, contact info, SEO metadata.
10. **User & Role Management**
    - Admin, Editor roles.
11. **Content Workflow**
    - Draft vs Published states.
12. **SEO**
    - Meta title, description, keywords for each content type.

---

## 🔐 Authentication
- Use **Laravel Breeze** or **Jetstream** for authentication.
- Role-based access:
  - **Admin** → full access to all modules.
  - **Editor** → limited to pages, news, events.

---

## 🎯 Task
Generate:
1. Database migrations for all tables.
2. Models with relationships.
3. CMS routes (`routes/cms.php`) with middleware protection.
4. Controllers for CRUD in each module.
5. Blade templates for CMS dashboard and forms.
6. Authentication with role-based access.
7. Settings management (logo, contact, social links, SEO).