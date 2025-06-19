# 🧠 Smart Content Writer – AI-Powered Content Generator

Smart Content Writer is an intelligent Arabic content generation tool built using **Laravel 12**, **Vue 3**, **Inertia.js**, and **OpenAI GPT-3.5**.  
It allows users to generate high-quality content (articles, product descriptions, Instagram posts, etc.) in seconds.

---

## 🚀 Features

- 📝 Generate different types of content:
  - Articles
  - Instagram posts
  - Product descriptions
- 🌐 Arabic language support
- ✨ Clean, responsive UI using TailwindCSS
- ⚡️ Fast performance with Vue 3 + Inertia.js
- 🔐 Secure API integration with OpenAI GPT-3.5
- 🧠 Custom prompt templates for content types
- 📦 Easily extendable architecture

---

## 🛠️ Built With

| Tech          | Description                              |
|---------------|------------------------------------------|
| **Laravel 12**    | PHP backend framework for API, routing, logic |
| **Vue 3**         | Reactive front-end JavaScript framework     |
| **Inertia.js**    | Seamless SPA experience (Vue + Laravel)     |
| **TailwindCSS**   | Utility-first modern CSS framework           |
| **HTML / CSS**    | UI structure and styling basics             |
| **OpenAI API**    | GPT-3.5 Turbo used for content generation   |
| **Vite**          | Lightning-fast frontend build tool          |

---

## 📷 Screenshots

> (Add your app screenshots or GIF previews here)

---

## 📦 Installation

```bash
git clone https://github.com/Asmaa-izz/smart-content-writer
cd smart-content-writer

# Backend dependencies
composer install

# Frontend dependencies
npm install && npm run dev

# Environment setup
cp .env.example .env
php artisan key:generate

# Add your OpenAI API key to the .env file
OPENAI_API_KEY=your_openai_api_key

# Start the development server
php artisan serve
