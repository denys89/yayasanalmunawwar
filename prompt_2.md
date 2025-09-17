You are an expert Laravel + React developer and UI/UX designer.  
Please build the **Parent Portal** using **Laravel (backend API)** and **React with Vite (frontend)** with the following requirements:

---

## ⚙️ Tech Stack
- **Backend**: Laravel (latest version) as API service
- **Frontend**: React + Vite with Tailwind CSS
- **UI Components**: Use modern libraries such as shadcn/ui, Radix UI, or Headless UI for accessibility
- **Icons**: lucide-react or Heroicons
- **Database**: MySQL (shared with CMS & Main Website)
- **Deployment**: Must run under subdomain `parents.school.com`
- **Auth**: Parents login using account created in CMS

---

## 📂 Project Structure

### Laravel Backend (API)
app/
├── Http/
│ ├── Controllers/
│ │ └── ParentPortal/ # API Controllers for parent portal
routes/
├── api_parent.php # API routes for parent portal
parents-frontend/
├── src/
│ ├── components/ # Reusable UI (Navbar, Sidebar, Card, Table, Modal)
│ ├── pages/ # Dashboard, Profile, Student, Payment, etc
│ ├── layouts/ # Base layouts (MainLayout, AuthLayout)
│ ├── services/ # API integration
│ ├── App.jsx
│ └── main.jsx
---

## 🎨 UI/UX Guidelines
1. **Clean Dashboard Layout**
   - Sidebar navigation with icons (Dashboard, Students, Payments, Announcements, Settings).
   - Topbar with parent profile & notification bell.
   - Card-based layout for key info (attendance, payments, announcements).

2. **Responsive Design**
   - Mobile-first approach.
   - Collapsible sidebar on mobile.
   - Sticky header for quick access.

3. **Visual Branding**
   - Color scheme aligned with school branding (blue, green, or custom).
   - Typography: Sans-serif, legible font (e.g., Inter).
   - Consistent spacing and rounded corners for a friendly look.

4. **Data Visualization**
   - Use charts (via Recharts or Chart.js) for:
     - Attendance overview
     - Payment history trends
     - Grade distribution

5. **Accessibility**
   - Contrast-checked colors.
   - Keyboard navigation support.
   - ARIA labels for screen readers.

---

## 📊 Parent Portal Features

### 1. Authentication
- Modern login page with school logo, illustration, and gradient background.
- JWT or Laravel Sanctum token for authentication.
- "Forgot Password" recovery with email reset.

### 2. Dashboard
- Quick overview cards:
  - Student attendance %.
  - Next payment due date.
  - Latest grade update.
  - New announcements.

### 3. Student Information
- Student profile with photo.
- Class & teacher details.
- Attendance history table + monthly attendance chart.
- Downloadable report card (PDF).

### 4. Payment & Billing
- Billing overview with **status badges** (Paid, Pending, Overdue).
- Online payment gateway integration (optional).
- Downloadable invoices.
- Payment history with filter/search.

### 5. Announcements
- Card/grid-based list with category tags.
- Detail view with images/attachments.
- Highlight urgent announcements with red accent.

### 6. Communication
- Simple messaging system (optional).
- Notification center (bell icon in topbar).

### 7. Settings
- Parent profile management.
- Multi-student support.
- Change password.

---

## 🔑 Features
1. **Role-based Access**: Only parents can login.
2. **Responsive SPA** with React Router.
3. **Reusable Components** for cards, tables, modals, charts.
4. **Dark Mode Support** (toggle in navbar).
5. **Dynamic Data** from CMS database via Laravel API.

---

## 🎯 Task
Generate:
1. Laravel API endpoints (`routes/api_parent.php`) for authentication, student data, payments, grades, announcements.
2. React components for Dashboard, Student Info, Payment, Announcements, Settings with **modern card-based UI**.
3. Sidebar + Topbar layout with responsive design.
4. Data visualization components (charts for attendance & payment).
5. API integration using Axios with interceptors for auth.
6. Dark mode toggle with Tailwind dark classes.
7. Form validation for login & profile updates.
8. Error handling with user-friendly messages.