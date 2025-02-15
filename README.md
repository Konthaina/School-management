# DMS System

This project is a Document Management System (DMS) designed to help users manage and organize their documents efficiently. The system is built using PHP and Laravel framework.

## Features

- User Authentication
- Document Upload and Management
- Role-Based Access Control
- Document Search and Filtering
- Password Reset Functionality

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/yourusername/dms-system.git
    ```

2. Navigate to the project directory:
    ```sh
    cd dms-system
    ```

3. Install the dependencies:
    ```sh
    composer install
    ```

4. Copy the `.env.example` file to `.env`:
    ```sh
    cp .env.example .env
    ```

5. Generate the application key:
    ```sh
    php artisan key:generate
    ```

6. Set up your database configuration in the `.env` file.

7. Run the database migrations:
    ```sh
    php artisan migrate
    ```

8. Start the development server:
    ```sh
    php artisan serve
    ```

## Usage

- Register a new user or log in with existing credentials.
- Upload and manage your documents.
- Use the search and filtering options to find specific documents.
- Reset your password if you forget it.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request.

## License

This project is licensed under the MIT License.