# Bite Rate

A simple web application built with Laravel, GraphQL, and Livewire for rating foods and restaurants, and commenting on
them.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [GraphQL Endpoints](#graphql-endpoints)
- [Livewire Components](#livewire-components)

## Features

- Rate restaurants and specific food items.
- Leave comments on restaurants and food items.
- Interact via a GraphQL API.
- Real-time interaction with Livewire components.
- Secure user authentication with Laravel Passport.

## Installation

1. **Clone the repository**:
   ```
   git clone https://github.com/yourusername/bite-rate.git
   cd bite-rate
   ```
2. **Install dependencies**:
   ```
   composer install
   ```
3. **Set up environment**:
   ```
   cp .env.example .env
   php artisan key:generate
   ```
4. **Configure your database in .env**
5. **Run migrations and seeders (optional)**:
   ```
   php artisan migrate --seed
    ```
6. **Install Passport**:
   ```
   php artisan install:api --passport
    ```
7. **Serve the application**:
   ```
   php artisan serve
    ```

## Usage

Access the application at `http://localhost:8000`.

### GraphQL Endpoints

Use the GraphQL API to manage restaurants, food items, ratings, and comments.

- **GraphQL Playground**: `http://localhost:8000/graphiql`

Example queries:

- **Query Restaurants** :
  ```graphql
  query {
    restaurants {
      id
      name
      averageRating
      comments {
        user {
          name
        }
        content
      }
    }
  }

- **Rate a Food Item** :
  ```
  mutation addNewRating($food_id: Int!, $rate: Float!, $comment: String) {
    StoreRating (food_id: $food_id, rate: $rate, comment: $comment) {
      rate
      user {
        name
        email
      }
      food {
        name
        restaurant {
          name
          average_rating
        }
      }
    }
  ```

## Livewire Components

Use Livewire for real-time interaction without page reloads.

- **Rating Component**: Rate a restaurant or food item.
- **Comments Component**: Add and view comments in real-time.

Include components in Blade views:

```

<livewire:rating :restaurantId="$restaurant->id" />
<livewire:comments :foodId="$food->id" />

```
