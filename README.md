# ML-Desktop: An Interactive Machine Learning Environment

A web application that simulates a desktop environment to provide an interactive and engaging platform for learning fundamental machine learning concepts.

[![Build Status](https://img.shields.io/badge/build-passing-brightgreen)](https://github.com/[your-username]/[your-repo])
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20.svg?style=flat&logo=laravel)](https://laravel.com/)

## Table of Contents

- [About The Project](#about-the-project)
- [Key Features](#key-features)
- [Tech Stack](#tech-stack)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation & Build](#installation--build)
- [Contributing](#contributing)
- [License](#license)
- [Contributors](#contributors)

## About The Project

Learning machine learning can be daunting. The **ML-Desktop** project was created to simplify this by presenting core concepts in a familiar, interactive desktop environment. This project was developed as our first full-stack web application, marking our initial journey into the Laravel framework, database management, and collaborative development.

This application provides a centralized, web-based platform where users can:

- **Interact** with "applications" that each teach a different ML concept.
- **Learn** at their own pace in a sandboxed, intuitive environment.

The goal is to provide a user-friendly experience that makes complex topics more approachable and fun.

## Key Features

- 🖥️ **Simulated Desktop UI:** A familiar interface with clickable "apps" that open in windows, simulating a real desktop.
- 👤 **User Authentication:** Secure user registration and login system to manage personal progress, powered by Laravel.
- 🃏 **Flashcard 'App':** An application for learning and reviewing key machine learning terms and definitions in an easy-to-use flashcard format.
- 💡 **Concept Explorer 'App':** Interactive modules and visual explainers for core machine learning topics like Bias vs. Variance and Overfitting.

## Tech Stack

This project is a web application developed using the Laravel framework.

| Component             | Technology / Library                                                                                                                                                                                                                                                                                                             |
| :-------------------- | :------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Backend Framework** | ![Laravel](https://img.shields.io/badge/Laravel-FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)                                                                                                                                                                                                                     |
| **Backend Language**  | ![PHP](https://img.shields.io/badge/PHP-777BB4.svg?style=for-the-badge&logo=php&logoColor=white)                                                                                                                                                                                                                                 |
| **Database**          | ![MySQL](https://img.shields.io/badge/MySQL-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)                                                                                                                                                                                                                           |
| **Frontend**          | ![HTML5](https://img.shields.io/badge/HTML5-E34F26.svg?style=for-the-badge&logo=html5&logoColor=white) ![CSS3](https://img.shields.io/badge/CSS3-1572B6.svg?style=for-the-badge&logo=css3&logoColor=white) ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E.svg?style=for-the-badge&logo=javascript&logoColor=black) |

## Getting Started

To get a local copy up and running, follow these simple steps.

### Prerequisites

- PHP >= 8.1
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) & NPM
- A local MySQL server

### Installation & Build

1.  **Clone the repository:**

    ```sh
    git clone https://github.com/Rp0115/LML.git
    ```

2.  **Navigate into the project directory:**

    ```sh
    cd LML/LML
    ```

3.  **Install PHP dependencies:**

    ```sh
    composer install
    ```

4.  **Install NPM dependencies:**

    ```sh
    npm install
    ```

5.  **Build the frontend assets:**

    ```sh
    npm run build
    ```

6.  **Create your environment file:**

    - Copy the example `.env` file.

    ```sh
    cp .env.example .env
    ```

7.  **Configure your database connection:**

    - Open the newly created `.env` file.
    - Find these lines and add your local MySQL details. `DB_USERNAME` is typically `root`.

    ```sh
    DB_USERNAME=[your username]
    DB_PASSWORD=[your password]
    ```

8.  **Run database migrations:**

    - This will create all the necessary tables in your database.

    ```sh
    php artisan migrate
    ```

9.  **Start the development server:**
    ```sh
    php artisan serve
    ```
    - The application will be available at `http://127.0.0.1:8000`.

## Contributing

Contributions are welcome! If you have suggestions for improving the app, please feel free to fork the repo and create a pull request.

1.  Fork the Project
2.  Create your Feature Branch (`git checkout -b feature/NewConcept`)
3.  Commit your Changes (`git commit -m 'Add some NewConcept'`)
4.  Push to the Branch (`git push origin feature/NewConcept`)
5.  Open a Pull Request

## License

Distributed under the MIT License. See `LICENSE` file for more information.

## Contributors

- Riju Pant - https://github.com/Rp0115
- Alisa Sumwalt - https://github.com/iggyw1g
- Andrew ZiYu Wang - https://github.com/20wangaz2

Project Link: https://github.com/Rp0115/LML.git
