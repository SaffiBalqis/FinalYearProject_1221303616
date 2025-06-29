# Final-Year-Project-1221303616
KongsiMakan: A Web-Based Platform for Community Food Sharing

**KongsiMakan** is a Laravel-based web application developed as a Final Year Project (FYP) to address the issue of food waste through community food sharing. The platform allows individuals and food businesses to list surplus food items, while receivers can browse, claim, and safely access these resources. Focused on the Cyberjaya region, KongsiMakan aims to build a culture of sharing and reduce food wastage in a user-friendly, secure, and sustainable way.

## 🔧 Built With

- **Laravel 10 (PHP Framework)**
- **MySQL** – Relational database
- **HTML5/CSS3 & Bootstrap** – Frontend styling
- **JavaScript (AJAX)** – For dynamic filtering
- **Apache (XAMPP Stack)** – Local and server hosting
- **Azure Virtual Machine** – Deployed environment
- **SSL/TLS (PositiveSSL)** – Secure access over HTTPS

## 🌐 Live Site

🔗 [https://kongsimakan.com](https://kongsimakan.com)

## 📌 Key Features

- 📸 **Food Listing Management** – Donors can upload food listings with images, allergy alerts, and expiry dates.
- 🧾 **Auto-Expiry Status Update** – Food listings are automatically marked as expired based on their expiry date.
- 🔍 **Claimed/Unclaimed Filtering** – Receivers can easily filter listings based on status using AJAX.
- 📊 **Graphical Dashboard** – Shows claimed vs. unclaimed statistics to promote transparency.
- 🧑‍🤝‍🧑 **Community Forum** – Users can share recipes, tips, and engage in discussions.
- 🔐 **Secure Platform** – All communications are encrypted via HTTPS with SSL.

Installation & Setup
 1. Clone the Repository
    git clone https://github.com/SaffiBalqis/Final-Year-Project-1221303616.git

    cd Final-Year-Project-1221303616

3. Install PHP dependencies using Composer
   composer install
   npm install && npm run dev

4. Create a .env file
  cp .env.example .env

5. Generate application key
  php artisan key:generate

6. Set up the database
  Create a new MySQL database (e.g., kongsimakan)
  Update the .env file with your DB name, username, and password

7. Run database migrations
   php artisan migrate

8. Start the Laravel development server
  php artisan serve

9. open http://localhost:8000 in your browser to view the application.


  Author:
    Saffi Balqis Binti Othman,
    Final Year Project, Faculty of Computing & Informatics
    Multimedia University, Cyberjaya
    1221303616@student.mmu.edu.my
