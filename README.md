# bid13_test

A test project demonstrating **data visualization and analysis** using PHP. The project loads CSV data, generates scatter plots, and extracts meaningful insights.

---

## Overview

This project is divided into two main tasks:

1. **Fraud Detection using the Telesign Phone ID API**  
   A PHP function that integrates with the Telesign API to detect potential fraud based on phone number data.

2. **Data Visualization with Scatter Plots**  
   A PHP function that loads CSV data, processes it, and generates scatter plot visualizations to extract meaningful insights.

---

## Question 1: Fraud Detection with Telesign API

### Features
- Integrates with the Telesign Phone ID API for fraud detection.
- Requires Telesign API credentials: `$customer_id` and `$api_key`.
- Uses the API endpoint: `https://rest-ww.telesign.com/v1/phoneid/`.
- Ensures the phone number being tested is in the allowed numbers list. If not, the number must be added and verified.

### Setup Instructions

#### Requirements
- PHP (with CURL enabled).

#### Steps
1. Log in to your Telesign Developer Dashboard.
2. Generate your API credentials (`$customer_id` and `$api_key`).
3. Verify that the phone number you want to test is in the allowed numbers list.
4. Use the provided PHP function to interact with the Telesign API.

---

## Question 2: Data Visualization with Scatter Plots

### Features
- Loads and processes CSV data.
- Generates scatter plot visualizations using the PHP GD library.
- Analyzes the data to extract meaningful insights.

### Setup Instructions

#### Requirements
- PHP (with necessary extensions like GD for image processing).

#### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/bid13_test.git
   cd bid13_test