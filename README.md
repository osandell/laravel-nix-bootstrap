# Laravel Nix Bootstrap

## Overview
The `laravel-nix-bootstrap` repository provides a convenient and streamlined way to run older Laravel projects that require legacy versions of PHP, specifically PHP 7.3 in this case. It uses Nix flakes to manage dependencies and ensure a consistent development environment.

## Why Local Composer Installation?
This setup includes a local installation of Composer, the PHP dependency manager. The local installation is necessary because using a globally installed Composer could inadvertently use a more recent PHP version installed on your system. By installing Composer locally within the project, we ensure it uses the PHP version specified by the Nix flake, which in this case is PHP 7.3.

## Getting Started

### Prerequisites
- Ensure you have [Nix](https://nixos.org/download.html) installed with flake support enabled.
- [Direnv](https://direnv.net/docs/installation.html) is required for automatically loading and unloading environment variables.

### Setup
1. **Clone the Repository:**
   ```
   git clone https://github.com/osandell/laravel-nix-bootstrap
   cd laravel-nix-bootstrap
   ```

2. **Copy `.envrc` and `flake.nix` to Your Laravel Project Directory:**
   - Copy the `.envrc` and `flake.nix` files from this repository to the root directory of your Laravel project.
   - This will set up the necessary environment and dependencies for your project.

3. **Configure Direnv:**
   - Navigate to your Laravel project directory where you copied the files.
   - Allow the `.envrc` file to load the environment automatically:
     ```
     direnv allow
     ```
   - If you make changes to `flake.nix`, remember to reload the environment:
     ```
     direnv reload
     ```

   **Note**: Always stage `flake.nix` before running `direnv allow` or `direnv reload`. Otherwise the initiation process will fail for some reason.

4. **Install Dependencies:**
   - PHP will be installed and set up automatically through the Nix flake.

5. **Local Composer Installation:**
   - A local version of Composer is installed automatically when you enter the directory (thanks to `.envrc`). It's located under `./composer/bin`.
   - The local Composer installation ensures that the correct PHP version is used for managing dependencies.

### Running the Project
- Use Composer to install Laravel project dependencies:
  ```
  composer install
  ```
- Start your development servers (like PHP built-in server, MySQL, etc.) as per your project requirements.

### Notes
- The provided `flake.nix` is pre-configured for PHP 7.3, making it suitable for older Laravel projects that are not compatible with more recent PHP versions.
- Adjustments can be made to the `flake.nix` or `.envrc` files for customization or upgrading components.

## Direct Laravel Request Script

### Overview
In the repository, you'll find a file named `DirectLaravelRequest.php`. This script is designed to facilitate direct requests to the Laravel application without the need for a full web server setup like Nginx or Apache. It's particularly useful for testing, debugging, or handling internal requests in environments where setting up a complete server stack is not feasible.

### Purpose
- **Testing & Debugging**: Simplifies the process of testing specific routes or functionalities in your Laravel application by bypassing the web server layer.
- **Internal Requests**: Ideal for scenarios where you need to execute internal requests to your Laravel application, such as cron jobs or scripts that interact with Laravel's functionality directly.

### How It Works
`DirectLaravelRequest.php` operates by simulating the server environment variables that Laravel expects in a typical web request. It manually sets these variables, bootstraps the Laravel application, and creates a request instance. This setup allows you to invoke Laravel's routing and controllers as if the application was being accessed via a standard web request.

### Usage
1. Place `DirectLaravelRequest.php` in your Laravel project's root directory.
2. Modify the script to set the desired route and other necessary `$_SERVER` variables.
3. Run the script via the command line with PHP:
   ---
   php DirectLaravelRequest.php
   ---
4. The script will execute a request to your Laravel application and output the response.

### Customization
You can edit `DirectLaravelRequest.php` to suit your specific needs, such as changing the request method, URI, or other server variables. This makes it a versatile tool for various testing and internal request scenarios.


## Integration with Web Development Environment Setup

### Comprehensive Environment for Web Projects
For a more comprehensive setup, especially when working on web development projects beyond Laravel, you might find the [web-dev-environment](https://github.com/osandell/web-dev-environment) repository useful. This repository is designed to provide a complete environment setup using Nix Flakes and Direnv, tailored for web development with services like MySQL, Redis, and Nginx.

### Why Integrate with Web Dev Environment?
- Extended Services: Offers a full stack development environment including MySQL, Redis, and Nginx, ideal for projects that require more than just PHP.
- Consistent Environment Across Projects: Ensures consistency and reproducibility of your development environment, which is crucial for team collaboration and avoiding the "it works on my machine" problem.
- Easy Setup: With the integration of Nix and Direnv, setting up your development environment becomes a breeze, allowing you to focus more on development rather than environment setup.

### How to Use
1. Visit the [web-dev-environment](https://github.com/osandell/web-dev-environment) repository.
2. Follow the instructions provided in the README to set up the full web development environment.
3. Utilize this environment for more extensive web development needs, leveraging the various services and tools it provides.

### Compatibility with Laravel Nix Bootstrap
While `laravel-nix-bootstrap` focuses on bootstrapping older Laravel projects, the `web-dev-environment` extends the capabilities to a broader range of web development requirements. Integrating both setups can be highly beneficial for a more holistic development workflow.
