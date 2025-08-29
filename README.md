# ML-Desktop: An Interactive Machine Learning Environment

A web application that simulates a familiar desktop environment to serve as an interactive and engaging platform for learning fundamental machine learning concepts.

This project was developed by a team of three as our first full-stack web application, marking our initial journey into the Laravel framework, database management, and collaborative development.

### Preview

_( Note: You should replace the text above with a real screenshot of your application's main "desktop" view! )_

## Core Features

- Interactive Desktop UI: A familiar, user-friendly interface with clickable "apps" that open in windows, simulating a real desktop experience.

- User Authentication: Secure user registration and login system powered by Laravel to manage personal progress and data.

- Flashcard 'App': An application for learning and reviewing key machine learning terms and definitions in an easy-to-use flashcard format.

- Concept Explorer 'App': Interactive modules and visual explainers for core machine learning topics like Bias vs. Variance, Overfitting, and more.

## Our Learning Journey

As our first collaborative web application, this project was a significant learning experience. Our primary goals were to:

Understand the fundamentals of the Laravel framework and the MVC (Model-View-Controller) pattern.

Gain practical experience with HTML, CSS, and JavaScript to build a dynamic frontend.

Learn how to design and manage a MySQL database with migrations and models.

Practice collaborative development using Git and GitHub.

We are proud of what we accomplished and the foundational skills we developed throughout this process.

## Tech Stack

- Backend: Laravel, PHP

- Frontend: HTML5, CSS3, Vanilla JavaScript

- Database: MySQL

## Getting Started

Follow these instructions to get a local copy of the project up and running on your machine for development and testing purposes.

### Prerequisites

- PHP >= 8.1

- Composer

- Node.js & NPM

- A local MySQL server

### Installation

1. Clone the repository:

> git clone https://github.com/Rp0115/LML.git
> cd LML

2. Install PHP dependencies:

> composer install

3. Install NPM dependencies:

> npm install

4. Create your environment file:

> cp .env.example .env

5. Generate an application key:

> php artisan key:generate

6. Configure your .env file:
   Open the .env file and set up your database connection details (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

7. Run database migrations:
   This will create all the necessary tables in your database.

> php artisan migrate

8. Compile frontend assets:

> npm run dev

9. Start the development server:

> php artisan serve

You can now visit http://127.0.0.1:8000 in your browser to see the application!

## Contributors

Riju Pant

Alisa Sumwalt

Andrew Ziyu Wange

This project was a valuable step in our journey as developers. We hope you find it interesting!
