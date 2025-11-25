# Product Catalogue Application 📦

A full-stack Single Page Application (SPA) designed to manage product inventories efficiently. This project was built as part of a technical skill assessment to demonstrate proficiency in Frontend development, Backend API creation, and Database management.

## 🚀 Features
* [cite_start]**Single Page Application (SPA):** Uses React.js to update the interface instantly without page reloads[cite: 14].
* [cite_start]**Responsive Design:** Fully responsive layout that adapts seamlessly between desktop, tablet, and mobile screens using Bootstrap 5[cite: 13].
* [cite_start]**Duplicate Prevention:** Strict backend and frontend validation to prevent products with duplicate names from being created[cite: 12].
* [cite_start]**Real-time Feedback:** Provides immediate success or error messages to the user upon form submission[cite: 11].
* **Modern UI:** Features a "Dark Mode" aesthetic with glassmorphism effects and animated interactions.

## 🛠️ Technologies Used
* **Frontend:** HTML5, CSS3, React.js (via CDN), Bootstrap 5
* [cite_start]**Backend:** PHP (REST API) [cite: 18]
* [cite_start]**Database:** MySQL [cite: 19]
* **HTTP Client:** Axios

## ⚙️ Setup & Installation
1.  **Database Setup:**
    * Create a MySQL database named `product_catalogue`.
    * Import the following SQL command to create the table:
    ```sql
    CREATE TABLE products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) UNIQUE NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

2.  **Backend Configuration:**
    * Ensure your local server (XAMPP/WAMP) is running.
    * Place the project folder in your `htdocs` directory.
    * Verify database credentials in `api/products.php`.

3.  **Run the App:**
    * Open your browser and navigate to `http://localhost/your-folder-name/index.html`.

## 📸 Screenshots
*(You can upload your screenshots to the repository and link them here later)*

## 📝 Design Choices
* **Architecture:** I chose a decoupled architecture where the React frontend communicates with a standalone PHP REST API. This ensures separation of concerns and maintainability.
* **UX/UI:** A dark-themed, card-based layout was selected to provide a modern, high-quality user experience that remains functional on smaller devices.
