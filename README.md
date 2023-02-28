# RoboRAVE Egypt

This is the official website for RoboRAVE Egypt, a competition that encourages STEM education and robotics development in Egypt.

## Getting Started

### Prerequisites

- PHP 8
- Composer
- MySQL or MariaDB

### Installation

1. Clone the repository
2. Install dependencies with `composer install`
3. Create a `.env` file in the root directory with the following environment variables:
   - `DB_HOST`: your database host
   - `DB_PORT`: your database port
   - `DB_DATABASE`: your database name
   - `DB_USERNAME`: your database username
   - `DB_PASSWORD`: your database password
4. Run the database migrations with `php artisan migrate`
5. (Optional) Seed the database with sample data with `php artisan db:seed`

### Usage

To run the project locally, use `php artisan serve` and open `http://localhost:8000` in your web browser.

### Contributing

Contributions are welcome! Please fork the project, create a new branch, commit your changes, and open a pull request.
