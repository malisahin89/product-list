<p align="center">
    <h1 align="center">Simple Product List</h1>
</p>
<p align="center">
    <em>A system coded with a simple Laravel framework to list and filter your products by categories. The design is very basic because I can write backend code, but the backend itself is excellent :D</em>
</p>
<p align="center">
	<img src="https://img.shields.io/github/license/malisahin89/product-list?style=flat&color=0080ff" alt="license">
	<img src="https://img.shields.io/github/last-commit/malisahin89/product-list?style=flat&logo=git&logoColor=white&color=0080ff" alt="last-commit">
	<img src="https://img.shields.io/github/languages/top/malisahin89/product-list?style=flat&color=0080ff" alt="repo-top-language">
	<img src="https://img.shields.io/github/languages/count/malisahin89/product-list?style=flat&color=0080ff" alt="repo-language-count">
<p>
<p align="center">
		<em>Developed with the software and tools below.</em>
</p>
<p align="center">
	<img src="https://img.shields.io/badge/JavaScript-F7DF1E.svg?style=flat&logo=JavaScript&logoColor=black" alt="JavaScript">
	<img src="https://img.shields.io/badge/Sass-CC6699.svg?style=flat&logo=Sass&logoColor=white" alt="Sass">
	<img src="https://img.shields.io/badge/Bootstrap-7952B3.svg?style=flat&logo=Bootstrap&logoColor=white" alt="Bootstrap">
	<img src="https://img.shields.io/badge/PHP-777BB4.svg?style=flat&logo=PHP&logoColor=white" alt="PHP">
	<img src="https://img.shields.io/badge/Vite-646CFF.svg?style=flat&logo=Vite&logoColor=white" alt="Vite">
	<img src="https://img.shields.io/badge/Axios-5A29E4.svg?style=flat&logo=Axios&logoColor=white" alt="Axios">
	<img src="https://img.shields.io/badge/JSON-000000.svg?style=flat&logo=JSON&logoColor=white" alt="JSON">
</p>
<hr>
<p align="center">
  <img src="https://raw.githubusercontent.com/malisahin89/product-list/master/MAIN-PAGE.gif" width="%100" />
</p>



##  Getting Started

***Requirements***

Ensure you have the following dependencies installed on your system:

* **PHP**: `8.2`
Laravel 11.x requires a minimum PHP version


###  Installation

1. Clone the product-list repository:

```sh
git clone https://github.com/malisahin89/product-list
cd product-list
```

2. Create a new **.env** file and then enter your **MySQL** database information.

```sh
composer install
php artisan migrate
php artisan db:seed
npm install
npm run build
```

3. Create an account at 'yourprojectname.test/panel/register' address.
4. To prevent other users from creating new accounts, comment out the route in the 'Registration Routes' section in routes/auth.php.
5. Alternatively, uncomment the necessary parts for password reset and email-verified membership.
6. Laravel/UI and Auth have been used for these operations.

---
